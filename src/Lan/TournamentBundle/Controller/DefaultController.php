<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        $tournament->addParticipant($user->getPersonalTeam());

        if(!$tournament->getInscription())
        {
            $session->getFlashBag()->add('warning', 'Ce tournoi a ses inscriptions fermées');
            return $this->redirect($this->generateUrl('lan_tournament_default_show', array("id" => $id)));
        }

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

}
