<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Lang;
use AppBundle\Entity\User;
use AppBundle\Entity\Translation;
use AppBundle\Entity\TransToLang;
use AppBundle\Entity\Domain;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        $domains = $em->getRepository('AppBundle:Domain')->findAll();
        $langs = $em->getRepository('AppBundle:Lang')->findAll();
        $translations = $em->getRepository('AppBundle:Translation')->findAll();


        $params = array(
            'users' => $users,
            'domains' => $domains,
            'langs' => $langs,
            'translations' => $translations
        );

        return $this->render('@Test/Default/index.html.twig', $params);
    }


    public function translationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $translations = $em->getRepository('AppBundle:Translation')->find($id);
        $params = array(
            'transtolangs' => $translations->getLang()
        );

        return $this->render('@Test/Default/trans.html.twig', $params);
    }
}
