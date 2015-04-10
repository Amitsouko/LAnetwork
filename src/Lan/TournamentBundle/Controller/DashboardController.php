<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/tournament/dashboard")
 * @Template()
 */
class DashboardController extends Controller
{
    private $tournament;
    private $user;
    private $em;

    public function init($id)
    {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getEntityManager();
        $this->tournament =  $this->em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
        if(!$this->tournament) throw $this->createNotFoundException('Le tournoi n\'existe pas');
        $this->isModertor($this->user,$this->tournament);
    }

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {        
        $this->init($id);

        return array("tournament"=> $this->tournament );     
    }

    /**
     * @Route("/{id}/open-inscription")
     * @Template()
     */
    public function openInscriptionAction($id)
    {
        $this->init($id);
        $session = $this->container->get('session');
        
        $this->tournament->setInscription(true);
        $this->em->persist($this->tournament);
        $this->em->flush();
        $session->getFlashBag()->add('success', 'Les inscriptions pour le tournoi sont ouvertes');
        return $this->redirect($this->generateUrl('lan_tournament_dashboard_show', array("id" => $id)));
    }

    /**
     * @Route("/{id}/close-inscription")
     * @Template()
     */
    public function closeInscriptionAction($id)
    {
        $this->init($id);
        $session = $this->container->get('session');

        $this->tournament->setInscription(false);
        $this->em->persist($this->tournament);
        $this->em->flush();
        $session->getFlashBag()->add('success', 'Les inscriptions pour le tournoi sont fermées');
        return $this->redirect($this->generateUrl('lan_tournament_dashboard_show', array("id" => $id)));
    }

    /**
     * @Route("/{id}/random-generate")
     * @Template()
     */
    public function randomeGenerateAction()
    {
        $this->init($id);
    }

    private function isModertor($user, $tournament)
    {
        if(!$tournament->getModerators()->contains($user))
        {
            throw $this->createNotFoundException('Vous n\'êtes pas modérateur du tournoi');
        }
    }

    /**
     * @Route("/{id}/generate")
     * @Template()
     */
    public function generateAction($id)
    {
        $this->init($id);

        $this->tournament->setInscription(false);
        $this->em->persist($this->tournament);
        $this->em->flush();

        return array("tournament" => $this->tournament);
    }

}
