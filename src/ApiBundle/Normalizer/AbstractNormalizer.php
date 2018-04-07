<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 17:14
 */

namespace ApiBundle\Normalizer;


abstract class AbstractNormalizer implements NormalizerInterface
{
    protected $exceptionTypes;

    public function __construct(array $exceptionTypes)
    {
        $this->exceptionTypes = $exceptionTypes;
    }

    public function supports(\Exception $exception)
    {
        return in_array(get_class($exception), $this->exceptionTypes);
    }
}