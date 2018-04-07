<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 11/03/18
 * Time: 13:07
 */

namespace AppBundle\Exception;
use Symfony\Component\HttpFoundation\Response;

class ResourceValidationException extends \Exception
{
    protected $datas = array();
    public function __construct($error, $datas = array(), $msg = '') {
        $code = Response::HTTP_BAD_REQUEST;
        $this->datas = $datas;
        switch($error)
        {
            case 'invalid_format':
                $message = "This format is invalid";
                $this->datas = array(
                  'expected_format' => 'json'
                );
                break;
            case 'null_object':
                $message = "This resource doesn't exist";
                break;
                case 'invalid_data':
                $message = "Your datas are invalids";
                break;
            case 'custom':
                $message = $msg;
                break;
            case 'constraint_integrity':
                $message = 'Constraint integrity have been violated.';
                break;
            default:
                $message = 'Invalid request';
                break;
        }

        parent::__construct($message , $code ,null);
    }

    public function getDatas()
    {
        return $this->datas;
    }
}