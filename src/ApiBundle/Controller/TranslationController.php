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

class TranslationController extends FOSRestController
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
     * @Rest\Delete(
     *    path = "/domains/{domainName}/translations/{translation_id}.{format}",
     *    name = "app_domain_translation_delete"
     * )
     *
     * @Rest\View(StatusCode = 200)
     */
    public function DeleteTranslationAction(Request $request, $domainName, $translation_id, $format)
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


        $translation = $em->getRepository('AppBundle\Entity\Translation')->findOneBy(array(
            'id' => $translation_id
        ));

        if (($translation == null) || ($translation->getDomain() != $domain))
            throw new NotFoundException("This translation don't exist or isn't associated with this domain");

        $em->remove($translation);
        $em->flush();

        $tab = array('id' => $translation_id);

        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $tab
        );
        return $response;
    }


    /**
     * @Rest\Post(
     *    path = "/domains/{name}/translations.{format}",
     *    name = "app_domain_translation_create"
     * )
     *
     * @Rest\View(StatusCode = 201,
     *     serializerGroups = {"showDomainTranslations"}
     *     )
     */
    public function createAction(Request $request, $name, $format)
    {
        $user = $this->user_authorization(getallheaders());

        if ($format != 'json')
            throw new ResourceValidationException('invalid_format');
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('AppBundle\Entity\Domain')->findOneBy(array(
            'slug' => $name
        ));

        if ($domain == null)
            throw new ResourceValidationException('null_object', array('error' => "Domain '" . $name . "' don't exist."));
        if ($domain->getUser() != $user)
            throw new PersonalizedException("Access Forbidden, this domain isn't yours", 403);

        $req = $request->request->all();
        if ((!array_key_exists('code', $req) || !array_key_exists('trans', $req)) || ($req['code'] == "" || !is_array($req['trans'])))
            throw new ResourceValidationException('invalid_data',
                array('expected_data' => array('code' => 'string',
                    'trans' => array('lang_iso' => 'translation'))));
        $translat = $em->getRepository('AppBundle\Entity\Translation')->findOneBy(array(
            'code' => $req['code']
        ));
        if ($translat != null)
            throw new ResourceValidationException('constraint_integrity', array('error' => "Translation '" . $req['code'] . "' already exist."));
        $translation = new Translation();
        $translation->setCode($req['code']);
        $translation->setDomain($domain);
        $em->persist($translation);

        foreach ($req['trans'] as $key => $value) {
            $language = $em->getRepository('AppBundle:Lang')->findOneBy(array('code' => $key));
            if ($language == null)
                throw new ResourceValidationException('null_object', array('error' => "Lang '" . $key . "' don't exist."));

            $transToLang = new TransToLang();
            $translation->addLang($transToLang);
            $transToLang->setLang($language);
            $transToLang->setTrans($value);
            $em->persist($transToLang);
        }
        $em->flush();

        $this->generateTranslationsTab($translation);
        $response = array(
            'code' => 201,
            'message' => 'success',
            'datas' => $translation
        );

        return $response;
    }

    /**
     * @Rest\Put(
     *    path = "/domains/{domainName}/translations/{translation_id}.{format}",
     *    name = "app_domain_translation_put"
     * )
     *
     * @Rest\View(StatusCode = 200,
     *     serializerGroups = {"showDomainTranslations"}
     *     )
     */
    public function addOrModifTransToLangAction(Request $request, $domainName, $translation_id, $format)
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

        $req = $request->request->all();
        if (!array_key_exists('trans', $req) || !is_array($req['trans']))
            throw new ResourceValidationException('invalid_data',
                array('expected_data' => array(
                    'trans' => array('lang_iso' => 'translation'))));
        $translation = $em->getRepository('AppBundle\Entity\Translation')->findOneBy(array(
            'id' => $translation_id
        ));

        if (($translation == null) || ($translation->getDomain() != $domain))
            throw new NotFoundException("This translation don't exist or isn't associated with this domain");

        foreach ($req['trans'] as $key => $value) {
            $language = $em->getRepository('AppBundle:Lang')->findOneBy(array('code' => $key));
            if ($language == null)
                throw new ResourceValidationException('null_object', array('error' => "Lang '" . $key . "' don't exist."));

            $transToLang = $em->getRepository('AppBundle\Entity\TransToLang')->findOneBy(array(
                'lang' => $language,
                'translation' => $translation
            ));
            if ($transToLang == null) {
                $transToLang = new TransToLang();
                $translation->addLang($transToLang);
                $transToLang->setLang($language);
                $em->persist($transToLang);
            }
            $transToLang->setTrans($value);
        }
        $em->flush();

        $this->generateTranslationsTab($translation);
        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $translation
        );
        return $response;
    }


    /**
     *
     * @Get(
     *     path = "/domains/{name}/translations.{format}",
     *     name = "app_domain_translations",
     *
     *     )
     * @Rest\View(
     *     statusCode = 200,
     *     serializerGroups = {"showDomainTranslations"}
     * )
     * @QueryParam(
     *     name="code",
     *     description="Sort order (asc or desc)"
     * )
     */
    public function showDomainTranslationsAction($name, $format, $code)
    {
//        dump($code); die();
        if ($format != 'json')
            throw new ResourceValidationException('invalid_format');

        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('AppBundle\Entity\Domain')->findOneBy(array(
            'slug' => $name
        ));
        if ($domain == null)
            throw new ResourceValidationException('null_object', array('error' => "Domain '" . $name . "' don't exist."));
        $translations = $em->getRepository('AppBundle\Entity\Translation')->findWithSearch($domain, $code);
        foreach ($translations as $translation) {
            $this->generateTranslationsTab($translation);
        }

        $domain->reformatLang();
        $response = array(
            'code' => 200,
            'message' => 'success',
            'datas' => $translations
        );

        return $response;
    }

    private function generateTranslationsTab(Translation $t)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\TransToLang');
        $array = array();
        $domain = $t->getDomain();
        foreach ($domain->getLang() as $lang) {
            $transToLang = $repository->findOneBy(array(
                'translation' => $t,
                'lang' => $lang
            ));
            if (!empty($transToLang)) {
                $array[$transToLang->getLang()->getCode()] = $transToLang->getTrans();
            } else {
                $array[$lang->getCode()] = $t->getCode();
            }

        }
        $t->setTabLangs($array);
    }


    /**
     *
     * @Get(
     *     path = "/domains/{name}/langs/{lang_code}.{format}",
     *     name = "app_domain_translations_lang",
     *
     *     )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function showDomainTranslationsLangsAction($name, $format, $lang_code)
    {
//        dump($code); die();
        if ($format != 'json' && $format != 'xliff')
            throw new ResourceValidationException('invalid_format');

        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('AppBundle\Entity\Domain')->findOneBy(array(
            'slug' => $name
        ));
        if ($domain == null)
            throw new ResourceValidationException('null_object', array('error' => "Domain '" . $name . "' don't exist."));

        $lang = $em->getRepository('AppBundle\Entity\Lang')->findOneBy(array(
            'code' => $lang_code
        ));
        if ($lang == null)
            throw new ResourceValidationException('null_object', array('error' => "Lang '" . $lang_code . "' don't exist."));

        $translations = $em->getRepository('AppBundle\Entity\TransToLang')->findWithDomain($domain, $lang);
        $tab = array();
        foreach ($translations as $trans) {
            array_push($tab, array('source' => $trans->getTranslation()->getCode(), 'target' => $trans->getTrans()));
        }
        $path = $this->get('api.xliffconverter')->createXliffFile($tab, $lang->getCode(),$domain->getName());
        if ($format == 'json') {
            $response = array(
                'code' => 200,
                'message' => 'success',
                'datas' => $tab
            );
        } else {
            $file = fopen($path, "r");
            $filename = $path;
            if (file_exists($path)) {
                $response = new Response();
                // Set headers
                $response->headers->set('Cache-Control', 'private');
                $response->headers->set('Content-type', "application/xmlns");
                //mime_content_type($filename));
                $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($filename) . '";');
                $response->headers->set('Content-length', filesize($filename));
                // Send headers before outputting anything
                $response->sendHeaders();
                $response->setContent(file_get_contents($filename));
            } else
                throw new PersonalizedException('Problème création du fichier', 500);
        }
        return $response;
    }

}
