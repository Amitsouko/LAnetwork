<?php

namespace Lan\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lan\ProfileBundle\Entity\Cover;
use Symfony\Component\HttpFoundation\Request;
class EditController extends Controller
{
    /**
     * @Route("/profile/edit-cover", name="editCover")
     * @Template()
     */
    public function editCoverAction(Request $request)
    {
        
        $em = $this->get('doctrine')->getManager();
        $user = $this->getUser();
        $cover = $user->getCover();

        $form = $this->createFormBuilder($cover)
            ->add("hash", "hidden",array("data" => sha1(date('Y-m-d H:i:s')) ))
            ->add("file")
            ->getForm();

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) { 
                
                $em->persist($cover);
                $em->flush();
                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }

        return array("form"=>$form->createView());

    }

}
