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

class LangController extends FOSRestController
{
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

    /**
     *
     * @Get(
     *     path = "/langs.{format}",
     *     name = "app_langs_show",
     *
     *     )
     * @Rest\View(
     *     statusCode = 200,
     *     serializerGroups={"showLang"}
     * )
     * @QueryParam(
     *     name="sort",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @QueryParam(
     *     name="page",
     *
     *     default=0,
     *     description="offset"
     * )
     * @QueryParam(
     *     name="per_page",
     *
     *     default=100,
     *     description="limit"
     * )
     */
    public function showAction($format, $sort, $page, $per_page)
    {
        if (!preg_match('/^[0-9]{1,4}$/', $page))
            throw new PersonalizedException('argument page = ' . $page . ' is invalid.', '400');
        if (!preg_match('/^[0-9]{1,4}$/', $per_page))
            throw new PersonalizedException('argument per_page = ' . $per_page . ' is invalid.', '400');
        if ($format != 'json')
            throw new ResourceValidationException('invalid_format');

        $em = $this->getDoctrine()->getManager();
        $langs = $em->getRepository('AppBundle\Entity\Lang')->findBy(array(), array("code" => $sort), $per_page, $page);

        $tab = array();
        foreach ($langs as $item) {
            $tab[] = $item->getCode();
        }

        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $tab
        );

        return $response;
    }

    /**
     * @Rest\Delete(
     *    path = "/domains/{domainName}/langs/{lang_code}.{format}",
     *    name = "app_domain_lang_delete"
     * )
     *
     * @Rest\View(
     *     StatusCode = 200,
     *     serializerGroups={"showOne"}
     *     )
     */
    public function DeleteTranslationAction($domainName, $lang_code, $format)
    {
        $user = $this->user_authorization(getallheaders());

        if ($format != 'json')
            throw new ResourceValidationException('invalid_format');
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('AppBundle\Entity\Domain')->findOneBy(array(
            'slug' => $domainName
        ));

        if ($domain == null)
            throw new ResourceValidationException('null_object', array('error' => "Domain '" . $domainName . "' don't exist."));
        if ($domain->getUser() != $user)
            throw new PersonalizedException("Access Forbidden, this domain isn't yours", 403);


        $lang = $em->getRepository('AppBundle\Entity\Lang')->findOneBy(array(
            'code' => $lang_code
        ));

        if ($lang == null)
            throw new NotFoundException("This lang \"" . $lang_code . "\" don't exist");

        if ($domain->getLang()->contains($lang))
            $domain->removeLang($lang);
        else
            throw new PersonalizedException("This domain isn't associated to this lang", 400);
        $em->flush();

        $domain->reformatLang();
        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $domain
        );
        $view = $this->view($response, 200);
        if ($user != false && $domain->getUser() == $user) {
            $context = new Context();
            $context->addGroup('new');
            $view->setContext($context);
        }
        return $view;
    }
}
