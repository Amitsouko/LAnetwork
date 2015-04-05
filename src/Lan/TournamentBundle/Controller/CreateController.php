<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Lan\TournamentBundle\Entity\Tournament;
/**
 * @Route("/tournament")
 */
class CreateController extends Controller
{

    /**
     * @Route("/create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $tournament = new Tournament();

        $form = $this->createFormBuilder($tournament)
            ->add("name")
            ->add("description")
            ->add("type", "choice", array(
                'choices'   => array(
                        '0'     => 'Joueur vs joueur',
                        '1'     => 'par équipe',
                        '2'     => 'mixte'
                    )
            ))
            ->getForm();

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) { 
                $tournament->addModerator($this->getUser());
                $em->persist($tournament);
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
            );    
    }

}
