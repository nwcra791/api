<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;

    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        '_wdt' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:toolbarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_wdt',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_home' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:homeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_search' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_search_bar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchBarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search_bar',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_phpinfo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/phpinfo',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_search_results' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchResultsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/search/results',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_open_file' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:openAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/open',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_router' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.router:panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/router',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_exception' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.exception:showAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/exception',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_profiler_exception_css' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.exception:cssAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/exception.css',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_twig_error_test' => array (  0 =>   array (    0 => 'code',    1 => '_format',  ),  1 =>   array (    '_controller' => 'twig.controller.preview_error:previewErrorPageAction',    '_format' => 'html',  ),  2 =>   array (    'code' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => '_format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'code',    ),    2 =>     array (      0 => 'text',      1 => '/_error',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domains_show' => array (  0 =>   array (    0 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\DomainController::showAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domains_show_one' => array (  0 =>   array (    0 => 'name',    1 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\DomainController::showOneAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]++',      3 => 'name',    ),    2 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domains_post' => array (  0 =>   array (    0 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\DomainController::postOneAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_langs_show' => array (  0 =>   array (    0 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\LangController::showAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'text',      1 => '/api/langs',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domain_lang_delete' => array (  0 =>   array (    0 => 'domainName',    1 => 'lang_code',    2 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\LangController::DeleteTranslationAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]++',      3 => 'lang_code',    ),    2 =>     array (      0 => 'text',      1 => '/langs',    ),    3 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'domainName',    ),    4 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domain_translation_delete' => array (  0 =>   array (    0 => 'domainName',    1 => 'translation_id',    2 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\TranslationController::DeleteTranslationAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]++',      3 => 'translation_id',    ),    2 =>     array (      0 => 'text',      1 => '/translations',    ),    3 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'domainName',    ),    4 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domain_translation_create' => array (  0 =>   array (    0 => 'name',    1 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\TranslationController::createAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'text',      1 => '/translations',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    3 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domain_translation_put' => array (  0 =>   array (    0 => 'domainName',    1 => 'translation_id',    2 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\TranslationController::addOrModifTransToLangAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]++',      3 => 'translation_id',    ),    2 =>     array (      0 => 'text',      1 => '/translations',    ),    3 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'domainName',    ),    4 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domain_translations' => array (  0 =>   array (    0 => 'name',    1 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\TranslationController::showDomainTranslationsAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'text',      1 => '/translations',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    3 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_domain_translations_lang' => array (  0 =>   array (    0 => 'name',    1 => 'lang_code',    2 => 'format',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\TranslationController::showDomainTranslationsLangsAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '.',      2 => '[^/]++',      3 => 'format',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]++',      3 => 'lang_code',    ),    2 =>     array (      0 => 'text',      1 => '/langs',    ),    3 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    4 =>     array (      0 => 'text',      1 => '/api/domains',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_user_show' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\UserController::userAction',    'format' => 'json',  ),  2 =>   array (    'id' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/api/users',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'app_user_create' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'ApiBundle\\Controller\\UserController::createAction',    'format' => 'json',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/api/users/create',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'test_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'TestBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/test/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'test_transtolang' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'TestBundle\\Controller\\DefaultController::translationAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/test/trans',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
