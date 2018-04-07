<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 13:07
 */

namespace AppBundle\Exception;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends \Exception
{
    public function __construct($message) {

        parent::__construct($message , Response::HTTP_NOT_FOUND ,null);
    }
}