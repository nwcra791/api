<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if (substr($pathinfo, -1) !== '/') {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        elseif (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/domains')) {
                // app_domains_show
                if (preg_match('#^/api/domains(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_app_domains_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domains_show')), array (  '_controller' => 'ApiBundle\\Controller\\DomainController::showAction',  'format' => 'json',));
                }
                not_app_domains_show:

                // app_domains_show_one
                if (preg_match('#^/api/domains/(?P<name>[^/\\.]++)(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_app_domains_show_one;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domains_show_one')), array (  '_controller' => 'ApiBundle\\Controller\\DomainController::showOneAction',  'format' => 'json',));
                }
                not_app_domains_show_one:

                // app_domains_post
                if (preg_match('#^/api/domains(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('POST' !== $canonicalMethod) {
                        $allow[] = 'POST';
                        goto not_app_domains_post;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domains_post')), array (  '_controller' => 'ApiBundle\\Controller\\DomainController::postOneAction',  'format' => 'json',));
                }
                not_app_domains_post:

                // app_domain_lang_delete
                if (preg_match('#^/api/domains/(?P<domainName>[^/]++)/langs/(?P<lang_code>[^/\\.]++)(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('DELETE' !== $canonicalMethod) {
                        $allow[] = 'DELETE';
                        goto not_app_domain_lang_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domain_lang_delete')), array (  '_controller' => 'ApiBundle\\Controller\\LangController::DeleteTranslationAction',  'format' => 'json',));
                }
                not_app_domain_lang_delete:

                // app_domain_translation_delete
                if (preg_match('#^/api/domains/(?P<domainName>[^/]++)/translations/(?P<translation_id>[^/\\.]++)(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('DELETE' !== $canonicalMethod) {
                        $allow[] = 'DELETE';
                        goto not_app_domain_translation_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domain_translation_delete')), array (  '_controller' => 'ApiBundle\\Controller\\TranslationController::DeleteTranslationAction',  'format' => 'json',));
                }
                not_app_domain_translation_delete:

                // app_domain_translation_create
                if (preg_match('#^/api/domains/(?P<name>[^/]++)/translations(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('POST' !== $canonicalMethod) {
                        $allow[] = 'POST';
                        goto not_app_domain_translation_create;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domain_translation_create')), array (  '_controller' => 'ApiBundle\\Controller\\TranslationController::createAction',  'format' => 'json',));
                }
                not_app_domain_translation_create:

                // app_domain_translation_put
                if (preg_match('#^/api/domains/(?P<domainName>[^/]++)/translations/(?P<translation_id>[^/\\.]++)(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('PUT' !== $canonicalMethod) {
                        $allow[] = 'PUT';
                        goto not_app_domain_translation_put;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domain_translation_put')), array (  '_controller' => 'ApiBundle\\Controller\\TranslationController::addOrModifTransToLangAction',  'format' => 'json',));
                }
                not_app_domain_translation_put:

                // app_domain_translations
                if (preg_match('#^/api/domains/(?P<name>[^/]++)/translations(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_app_domain_translations;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domain_translations')), array (  '_controller' => 'ApiBundle\\Controller\\TranslationController::showDomainTranslationsAction',  'format' => 'json',));
                }
                not_app_domain_translations:

                // app_domain_translations_lang
                if (preg_match('#^/api/domains/(?P<name>[^/]++)/langs/(?P<lang_code>[^/\\.]++)(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_app_domain_translations_lang;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_domain_translations_lang')), array (  '_controller' => 'ApiBundle\\Controller\\TranslationController::showDomainTranslationsLangsAction',  'format' => 'json',));
                }
                not_app_domain_translations_lang:

            }

            // app_langs_show
            if (0 === strpos($pathinfo, '/api/langs') && preg_match('#^/api/langs(?:\\.(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_app_langs_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_langs_show')), array (  '_controller' => 'ApiBundle\\Controller\\LangController::showAction',  'format' => 'json',));
            }
            not_app_langs_show:

            if (0 === strpos($pathinfo, '/api/users')) {
                // app_user_show
                if (preg_match('#^/api/users/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_app_user_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_user_show')), array (  '_controller' => 'ApiBundle\\Controller\\UserController::userAction',  'format' => 'json',));
                }
                not_app_user_show:

                // app_user_create
                if ('/api/users/create' === $pathinfo) {
                    if ('POST' !== $canonicalMethod) {
                        $allow[] = 'POST';
                        goto not_app_user_create;
                    }

                    return array (  '_controller' => 'ApiBundle\\Controller\\UserController::createAction',  'format' => 'json',  '_route' => 'app_user_create',);
                }
                not_app_user_create:

            }

        }

        elseif (0 === strpos($pathinfo, '/test')) {
            // test_homepage
            if ('/test' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'TestBundle\\Controller\\DefaultController::indexAction',  '_route' => 'test_homepage',);
                if (substr($pathinfo, -1) !== '/') {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'test_homepage'));
                }

                return $ret;
            }

            // test_transtolang
            if (0 === strpos($pathinfo, '/test/trans') && preg_match('#^/test/trans/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'test_transtolang')), array (  '_controller' => 'TestBundle\\Controller\\DefaultController::translationAction',));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
