<?php

namespace Lan\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
/**
 * @Route("/tournament/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/{id}/users")
     * @Template()
     */
    public function getUsersAction($id)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $response = new JsonResponse();
       $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
       if(!$tournament) return $response->setData(array("error" => "Tournament does not exist"));
        $serializer = $this->getSerializer();
       $arrayResponse = array();

       foreach($tournament->getParticipants() as $p)
       {
           if($u = $p->getPersonalUser())
           {
            $user["id"] = $u->getId();
            $user["username"] = $u->getUsername();
            $user["url"] = $this->generateUrl('profile', array("username" => $u->getUsername()));
           }else{
                foreach($p->getUsers() as $u)
               {
                 $user["id"] = $u->getId();
                 $user["username"] = $u->getUsername();
                 $user["url"] = $this->generateUrl('profile', array("username" => $u->getUsername()));
               } 
           }
           $arrayResponse[] = $user;
       }


       return $response->setData(array("success" => true,"data" => $arrayResponse));
    }

    /**
     * @Route("/{id}/teams")
     * @Template()
     */
    public function getTeamsAction($id)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $response = new JsonResponse();
       $tournament =  $em->getRepository("LanTournamentBundle:Tournament")->findOneById($id);
       if(!$tournament) return $response->setData(array("error" => "Tournament does not exist"));
        $serializer = $this->getSerializer();
       $arrayResponse = array();

       foreach($tournament->getParticipants() as $p)
       {
           if($u = $p->getPersonalUser())
           {
            $team["id"] = $u->getId();
            $team["name"] = $u->getUsername();
            $team["url"] = $this->generateUrl('profile', array("username" => $u->getUsername()));
           }else{

              $team["id"] = $p->getId();
              $team["name"] = $p->getName();
              $team["url"] = "";
               foreach($p->getUsers() as $u)
              {
                $user["id"] = $u->getId();
                $user["username"] = $u->getUsername();
                $user["url"] = $this->generateUrl('profile', array("username" => $u->getUsername()));
                $team["users"][] = $user;
              } 

           }
           $arrayResponse[] = $team;
       }

       
       return $response->setData(array("success" => true,"data" => $arrayResponse));
    }


    private function getSerializer()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        return $serializer;
    }

}
