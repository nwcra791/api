<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Domain;
use AppBundle\Entity\Lang;
use AppBundle\Entity\Translation;
use AppBundle\Entity\TransToLang;
use AppBundle\Entity\User;

class DefaultController extends Controller
{

//    /**
//     * @Route("/{classname}", name="api_get_classAll", requirements={"classname" = "users|langs|translations"})
//     *
//     */
//    public function getAllAction($classname)
//    {
//        $name = ucfirst(substr($classname, 0, -1));
////        echo $name; die();
//        $em = $this->getDoctrine()->getManager();
//        $objects = $em->getRepository('AppBundle\Entity\\'.$name)->findAll();
//        $data = $this->get('jms_serializer')->serialize($objects, 'json');
//
//        $response = new Response($data);
//        $response->headers->set('Content-Type', 'application/json');
//
//        return $response;
//    }

//    /**
//     * @Route("/user/create", name="api_user_create")
//     */
//    public function createAction(Request $request)
//    {
//        $data = $request->getContent();
//        $user = $this->get('jms_serializer')->deserialize($data, 'ApiBundle\Entity\User', 'json');
//
//        echo $user->getUsername();
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($user);
//        $em->flush();
//
//        return new Response('', Response::HTTP_CREATED);
//    }

//    /**
//     * @Route("/users/{id}", name="api_user_id")
//     */
//    public function getUserAction(User $user)
//    {
//        $data = $this->get('jms_serializer')->serialize($user, 'json');
//
//        $response = new Response($data);
//        $response->headers->set('Content-Type', 'application/json');
//
//        return $response;
//    }


}
