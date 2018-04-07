<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 14/03/18
 * Time: 09:35
 */

namespace ApiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExceptionNormalizerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $exceptionListenerDefinition = $container->findDefinition('app.exception_subscriber');
        $normalizers = $container->findTaggedServiceIds('app.normalizer');

        foreach ($normalizers as $id => $tags) {
            $exceptionListenerDefinition->addMethodCall('addNormalizer', [new Reference($id)]);
        }
    }
}