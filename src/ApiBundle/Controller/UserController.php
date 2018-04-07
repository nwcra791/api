<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Domain;
use AppBundle\Entity\Lang;
use AppBundle\Entity\Translation;
use AppBundle\Entity\TransToLang;
use AppBundle\Entity\User;

class UserController extends FOSRestController
{
    /**
     *
     * @Get(
     *     path = "/users/{id}",
     *     name = "app_user_show",
     *     requirements = {"id"="\d+"}
     *     )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function userAction(User $user)
    {
        return $user;
    }


    /**
     * @Rest\Post(
     *    path = "/users/create",
     *    name = "app_user_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function createAction(User $user)
    {
        $errors = $this->get('validator')->validate($user);

        if (count($errors)) {
            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();

        return $this->view(
            $user,
            Response::HTTP_CREATED,
            ['Location' => $this->generateUrl(
                'app_user_show',
                ['id' => $user->getId(),
                    UrlGeneratorInterface::ABSOLUTE_URL])]);
    }


}
