<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 13:07
 */

namespace AppBundle\Exception;
use Symfony\Component\HttpFoundation\Response;

class PersonalizedException extends \Exception
{
    protected $datas;

    public function __construct($msg, $code, $datas = "") {
        $this->datas = $datas;

        parent::__construct($msg , $code ,null);
    }

    public function getDatas()
    {
        return $this->datas;
    }
}