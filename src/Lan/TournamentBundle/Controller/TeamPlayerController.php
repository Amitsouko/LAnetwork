<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Lan\TournamentBundle\Entity\TeamPlayer;
/**
 * @Route("/team")
 */
class TeamPlayerController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $teams = $em->getRepository("LanTournamentBundle:TeamPlayer")->findAll();
        return array(
                "teams" => $teams
            );      
    }

    /**
     * @Route("/create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $teamPlayer = new TeamPlayer();

        $form = $this->createFormBuilder($teamPlayer)
            ->add("name")
            ->getForm();

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) { 
                $user = $this->getUser();
                $teamPlayer->addUser($user);
                $teamPlayer->addModerator($user);
                $em->persist($teamPlayer);
                $em->flush();
                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }

        return array("form"=>$form->createView());  
    }

    /**
     * @Route("/edit")
     * @Template()
     */
    public function editAction()
    {
        return array(
                // ...
            );    }

}
