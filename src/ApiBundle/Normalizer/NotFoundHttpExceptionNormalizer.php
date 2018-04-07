<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 17:16
 */

namespace ApiBundle\Normalizer;
use Symfony\Component\HttpFoundation\Response;

class NotFoundHttpExceptionNormalizer extends AbstractNormalizer
{
    public function normalize(\Exception $exception)
    {
        $result['code'] = Response::HTTP_NOT_FOUND;

        $result['body'] = [
            'code' => Response::HTTP_NOT_FOUND,
            'message' => $exception->getMessage()
        ];

        return $result;
    }
}