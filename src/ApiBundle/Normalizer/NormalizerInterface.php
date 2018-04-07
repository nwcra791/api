<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 17:13
 */

namespace ApiBundle\Normalizer;

interface NormalizerInterface
{
    public function normalize(\Exception $exception);

    public function supports(\Exception $exception);
}