<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Lan\TournamentBundle\Entity\Team;
/**
 * @Route("/tournament")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/team-subscribe")
     * @Template()
     */
    public function teamsubscribeAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $session = $this->container->get('session');
        //if user not logged
        if(!$user)
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        
        //check if tournament exists
        $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($request->request->get("id_tournament"));
        if(!$tournament) throw $this->createNotFoundException('Le tournoi n\'existe pas');

        //check if tournament has open subscription
        if(!$tournament->getInscription())
        {
            $session->getFlashBag()->add('warning', 'Ce tournoi a ses inscriptions fermées, vous ne pouvez plus vous désinscrire.');
            return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $id)));
        }

        // logic by type
        if($request->get("team") == "personalTeam")
        {
            // if it's a solo subscription
            if(!$tournament->getParticipants()->contains($user->getPersonalTeam()))
            {
                $tournament->addParticipant($user->getPersonalTeam());
                $session->getFlashBag()->add('success', 'Vous êtes bien inscrit au tournoi '.$tournament->getName());
            }else{
                $session->getFlashBag()->add('notice', 'Vous êtes déjà inscrit au tournoi '.$tournament->getName());
            }
            
        }else{
            //team subscription
            $teamPlayer = $em->getRepository("LanTournamentBundle:TeamPlayer")->findOneById($request->request->get("team"));
            
            //check if the team is already in the tournament
            foreach($tournament->getParticipants() as $p)
            {
                if($p->getParentTeam() == $teamPlayer)
                {
                    $session->getFlashBag()->add('notice', 'L\'équipe est déjà inscrite au tournoi '.$tournament->getName());
                    return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $request->request->get("id_tournament"))));
                }
            }

            $team = $this->copyTeam($teamPlayer);

            $em->persist($team);
            $tournament->addParticipant($team);
            $session->getFlashBag()->add('success', 'Vous avez inscrit l\'équipe  '.$team->getName().' au tournoi.');
        }




        $em->persist($tournament);
        $em->flush();

        
        return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $request->request->get("id_tournament"))) );
    }

    /**
     * @Route("/team-unsubscribe/{idTournament}/{idTeam}")
     * @Template()
     */
     public function teamUnsubscribeAction($idTournament, $idTeam)
     {   
        $em = $this->getDoctrine()->getEntityManager();
        $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($idTournament);
        $session = $this->container->get('session');
        if(!$tournament) throw $this->createNotFoundException('Le tournoi n\'existe pas');

        $team = $em->getRepository("LanTournamentBundle:Team")->findOneById($idTeam);
        if(!$team) throw $this->createNotFoundException('L\'équipe n\'existe pas');

        $user = $this->getUser();
        if(!$team->getParentTeam()->getModerators()->contains($user))
        {
            throw $this->createNotFoundException("Vous n'êtes pas modérateur de l'équipe");
        }

        $tournament->removeParticipant($team);
        $em->persist($tournament);
        $em->flush();
        $session->getFlashBag()->add('success', 'Vous avez désinscrit l\'équipe  '.$team->getName().' du tournoi.');
        return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $idTournament)) );  
     }

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine();
        $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
        if(!$tournament) throw $this->createNotFoundException('Le tournoi n\'existe pas');
        return array("tournament" => $tournament);
    }

    /**
     * @Route("/{id}/subscribe")
     * @Template()
     */
    public function subscribeAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $session = $this->container->get('session');
        if(!$user)
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        
        $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
        if(!$tournament) throw $this->createNotFoundException('Le tournoi n\'existe pas');

        if(!$tournament->getInscription())
        {
            $session->getFlashBag()->add('warning', 'Ce tournoi a ses inscriptions fermées');
            return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $id)));
        }
        $tournament->addParticipant($user->getPersonalTeam());

        $em->persist($tournament);
        $em->flush();

        $session->getFlashBag()->add('success', 'Vous êtes bien inscrit au tournoi '.$tournament->getName());
        return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $id)));

    }

    /**
     * @Route("/{id}/unsubscribe")
     * @Template()
     */
    public function unsubscribeAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $session = $this->container->get('session');
        if(!$user)
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        
        $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
        if(!$tournament) throw $this->createNotFoundException('Le tournoi n\'existe pas');

        if(!$tournament->getInscription())
        {
            $session->getFlashBag()->add('warning', 'Ce tournoi a ses inscriptions fermées, vous ne pouvez plus vous désinscrire.');
            return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $id)));
        }


        $tournament->removeParticipant($user->getPersonalTeam());


        $em->persist($tournament);
        $em->flush();

        $session->getFlashBag()->add('success', 'Vous êtes bien désinscrit du tournoi '.$tournament->getName());
        return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $id)));
    }

    /**
     * @Route("/{id}/embedd/subsciption")
     * @Template()
     */
    public function getlinkAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
        $user = $this->getUser();
        $arrayTeamsInscrites = array();
        $personalTeam = $user->getPersonalTeam();

        if($tournament->getParticipants()->contains($personalTeam))
        {
            $personalTeam->setName("En tant que joueur");

            $arrayTeamsInscrites[] = $personalTeam; 
        }

        foreach($tournament->getParticipants() as $p)
        {
            if($user->getTeamPlayer()->contains($p->getParentTeam()))
            {
                $arrayTeamsInscrites[] = $p;
            }
        }



        return array("teams" => $arrayTeamsInscrites, "tournamentId" => $tournament->getId());
    }




    private function copyTeam($teamPlayer)
    {
        $team = new Team();
        $team->setName($teamPlayer->getName());
        foreach($teamPlayer->getUsers() as $u)
        {
            $team->addUser($u);
        }
        $team->setParentTeam($teamPlayer);
        
        return $team;
    }

}
