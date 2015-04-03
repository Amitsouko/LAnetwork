<?php

namespace Lan\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/user/{username}", name="profile")
     * @Template("LanProfileBundle:Profile:Show.html.twig")
     */
    public function indexAction($username)
    {
        $em = $this->getDoctrine();
        $user =  $em->getRepository("LanProfileBundle:User")->findOneByUsername($username);
        return array('user' => $user);
    }
}
