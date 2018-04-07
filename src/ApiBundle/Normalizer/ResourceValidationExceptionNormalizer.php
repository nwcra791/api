<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 17:16
 */

namespace ApiBundle\Normalizer;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Exception\ResourceValidationException;

class ResourceValidationExceptionNormalizer extends AbstractNormalizer
{
    public function normalize(\Exception $exception)
    {
        $result['code'] = Response::HTTP_BAD_REQUEST;

        $datas = array(
            'excepted_format' => 'json'
        );

        $result['body'] = [
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => $exception->getMessage(),
            'datas' =>  $exception->getDatas()
        ];

        return $result;
    }
}