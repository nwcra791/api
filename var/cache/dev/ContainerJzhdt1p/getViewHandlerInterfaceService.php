<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'FOS\RestBundle\View\ViewHandlerInterface' shared service.

include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/View/ViewHandlerInterface.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/View/ConfigurableViewHandlerInterface.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/View/ViewHandler.php';

$this->services['FOS\RestBundle\View\ViewHandlerInterface'] = $instance = new \FOS\RestBundle\View\ViewHandler(${($_ = isset($this->services['router']) ? $this->services['router'] : $this->getRouterService()) && false ?: '_'}, ${($_ = isset($this->services['fos_rest.serializer']) ? $this->services['fos_rest.serializer'] : $this->getFosRest_SerializerService()) && false ?: '_'}, ${($_ = isset($this->services['templating']) ? $this->services['templating'] : $this->load(__DIR__.'/getTemplatingService.php')) && false ?: '_'}, ${($_ = isset($this->services['request_stack']) ? $this->services['request_stack'] : $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack()) && false ?: '_'}, array('json' => false, 'xml' => false, 'html' => true), 400, 204, false, array('html' => 302), 'twig');

$instance->setSerializeNullStrategy(true);

return $instance;
