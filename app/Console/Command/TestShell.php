<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('HttpSocket', 'Network/Http');
App::uses('HttpResponse', 'Network/Http');
APP::import('Vendor', 'Basen');
APP::import('Vendor', 'Validate');

/**
 * CakePHP urlTestShell
 * @author dozen
 */
class TestShell extends AppShell {

    public $uses = array();
    public $task = array();

    public function main() {
        Basen::setCharFile();
        for ($i = 0; $i < 10; $i++) {
            $j = mt_rand(0, 999999999999999990);
            $base = Basen::encode($j);
            echo $j . ': ' . $base . PHP_EOL;
        }
    }

    public function url() {
        $url = 'http://google.com';
        require_once('Net/IDNA2.php');
        $idna = Net_IDNA2::getInstance();
        $url = $idna->encode($url);
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_NOBODY => true
        ));
        $hoge = curl_exec($ch);
        var_dump($hoge);
        $info = curl_getinfo($ch);
        var_dump($info);
        curl_close($ch);
    }
    
    function isSafe() {
        $url = 'http://beeg.com/';
        var_dump(Validate::isSafe($url));
    }

    public function puny() {
        require_once('Net/IDNA2.php');
        $idna = Net_IDNA2::getInstance();
        var_dump($idna->encode('http://yahoo.co.jp/'));
    }

    function basen() {
        Basen::setCharFile();
        echo Basen::$base . '長さ' . PHP_EOL;
        echo mb_substr(Basen::$char, 0, 1);
    }

}
