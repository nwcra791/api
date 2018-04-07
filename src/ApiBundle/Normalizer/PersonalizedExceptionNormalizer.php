<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 17:16
 */

namespace ApiBundle\Normalizer;
use Symfony\Component\HttpFoundation\Response;

class PersonalizedExceptionNormalizer extends AbstractNormalizer
{
    public function normalize(\Exception $e)
    {
        $result['code'] = $e->getCode();

        $result['body'] = [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
        ];
        if ($e->getDatas() != "")
        {
            $result['body']['datas'] = $e->getDatas();
        }

        return $result;
    }
}