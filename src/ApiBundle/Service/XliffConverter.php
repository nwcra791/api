<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 03/04/18
 * Time: 11:07
 */

namespace ApiBundle\Service;


class XliffConverter
{
    private $rootDir;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir . '/tmp/';
        if (!is_dir($this->rootDir))
            mkdir($this->rootDir);
    }

    public function getRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    public function createXliffFile($tab, $lang_code, $domain_name)
    {
        $xml = new \SimpleXMLElement('<xliff/>');
        $header = $xml->addChild('header');
        $header->addChild('target_lang', $lang_code);
        $body = $xml->addChild('body');

        foreach ($tab as $t) {
            $transunit = $body->addChild('transunit');
            $transunit->addChild('source', $t['source']);
            $transunit->addChild('target', $t['target']);
        }
        Header('Content-type: text/xml');
//        print($xml->asXML());
        $now = new \DateTime();
        $filename = $domain_name . $now->format('-Ymd-His') . '.xliff';

        $path = $this->rootDir . $filename;
        file_put_contents($path, $xml->asXML());
        return ($path);
    }
}