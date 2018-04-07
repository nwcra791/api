<?php

namespace ApiBundle;

use ApiBundle\DependencyInjection\Compiler\ExceptionNormalizerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ExceptionNormalizerPass());
    }
}
