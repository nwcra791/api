<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Domain;
use AppBundle\Entity\Lang;
use AppBundle\Entity\Translation;
use AppBundle\Entity\TransToLang;
use AppBundle\Entity\User;
use AppBundle\Exception\ResourceValidationException;
use AppBundle\Exception\PersonalizedException;
use AppBundle\Exception\NotFoundException;
use FOS\RestBundle\Context\Context;

class DomainController extends FOSRestController
{

    /**
     *
     * @Get(
     *     path = "/domains.{format}",
     *     name = "app_domains_show",
     *
     *     )
     * @Rest\View(
     *     statusCode = 200,
     *     serializerGroups = {"show"}
     * )
     * @QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     */
    public function showAction($format, $order)
    {
        if ($format != 'json' && $format != 'xml')
            throw new ResourceValidationException('invalid_format');

        $em = $this->getDoctrine()->getManager();
        $domains = $em->getRepository('AppBundle\Entity\Domain')->findAllSort($order);

        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $domains
        );

        $view = $this->view($response, 200);
        if ($format == 'xml')
            $view->setFormat('xml');
        return $view;
    }

    /**
     *
     * @Get(
     *     path = "/domains/{name}.{format}",
     *     name = "app_domains_show_one",
     *
     *     )
     * @Rest\View(
     *     statusCode = 200,
     *     serializerGroups = {"showOne"}
     * )
     */
    public function showOneAction($name, $format)
    {
//        $user = $this->user_authorization(getallheaders());
        if ($format != 'json')
            throw new ResourceValidationException('invalid_format');

        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('AppBundle\Entity\Domain')->findOneBy(array(
            'slug' => $name
        ));
        if ($domain == null)
            throw new PersonalizedException("this resource don't exist", 404);

        $domain->reformatLang();
        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $domain
        );
        $view = $this->view($response, 200);
        $user = $this->user_authentified(getallheaders());
        if ($user != false && $domain->getUser() == $user)
        {
            $context = new Context();
            $context->addGroup('new');
            $view->setContext($context);
        }
        return $view;
    }

    /**
     *
     * @Rest\Post(
     *     path = "/domains.{format}",
     *     name = "app_domains_post",
     *
     *     )
     * @Rest\View(
     *     statusCode = 201,
     *     serializerGroups = {"showOne", "new"}
     * )
     */
    public function postOneAction(Request $request, $format)
    {
        $user = $this->user_authorization(getallheaders());
        if ($format != 'json')
            throw new ResourceValidationException('invalid_format');
        $req = $request->request->all();
//        return $req;
        if (((!array_key_exists('name', $req) || $req['name'] == "") || !array_key_exists('lang', $req)) || !is_array($req['lang']))
            throw new ResourceValidationException('invalid_data',
                array('expected_data' => array('code' => 'string',
                    'trans' => array('lang_iso' => 'translation'))));

        $em = $this->getDoctrine()->getManager();
        $slug = $req['name'];
        $count = 1;
        do {
            $dom = $em->getRepository('AppBundle\Entity\Domain')->findOneBy(array(
                'slug' => $slug
            ));
            if ($dom != null)
            {
                $slug = $req['name'].'_'.$count;
                $count++;
            }
        } while ($dom != null);

        $domain = new Domain();
        if (array_key_exists('description', $req))
            $domain->setDescription($req['description']);
        else
            $domain->setDescription("");

        $domain->setName($req['name']);
        $domain->setSlug($slug);
        foreach($req['lang'] as $lang)
        {
            $language = $em->getRepository('AppBundle:Lang')->findOneBy(array('code' => $lang));
            if ($language == null)
                throw new ResourceValidationException('null_object', array('error' => "Lang '" . $lang . "' don't exist."));
            $domain->addLang($language);
        }
        $domain->setUser($user);
        $em->persist($domain);
        $em->flush();

        $domain->reformatLang();
        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $domain
        );
        return $response;
    }

    public function user_authentified($headers)
    {
        $error = new PersonalizedException('Access Denied, you need a valid authorization.', 401);
        if (array_key_exists('Authorization', $headers))
            $authorization = $headers['Authorization'];
        else
            return false;
        $user = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\User')->findOneBy(array('password' => $authorization));
        if ($user == null)
            return false;
        else
            return $user;

    }
    public function user_authorization($headers)
    {
        $error = new PersonalizedException('Access Denied, you need a valid authorization.', 401);
        if (array_key_exists('Authorization', $headers))
            $authorization = $headers['Authorization'];
        else
            throw $error;
        $user = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\User')->findOneBy(array('password' => $authorization));
        if ($user == null)
            throw $error;
        else
            return $user;

    }

}
