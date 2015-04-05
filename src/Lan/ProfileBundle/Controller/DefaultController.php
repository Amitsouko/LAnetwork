<?php

namespace Lan\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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


    /**
     * @Route("/embed/login", name="embed-login")
     * @Template("LanProfileBundle:Security:login-embed.html.twig")
     */
    public function loginEmbedAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        // $session = $request->getSession();

        // // get the error if any (works with forward and redirect -- see below)
        // if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
        //     $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        // } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
        //     $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        //     $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        // } else {
        //     $error = null;
        // }

        // if (!$error instanceof AuthenticationException) {
        //     $error = null; // The value does not come from the security component.
        // }

        // // last username entered by the user
        // $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        $csrfToken = $this->has('form.csrf_provider')
            ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return (array(
            // 'last_username' => $lastUsername,
            // 'error'         => $error,
            'csrf_token' => $csrfToken,
        ));
    }
}
