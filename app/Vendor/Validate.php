<?php

/**
 * Description of cURL
 *
 * @author dozen
 */
class Validate {

    public static function isUrl($url) {
        require_once('Net/IDNA2.php');
        $idna = Net_IDNA2::getInstance();
        $url = $idna->encode($url);
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_NOBODY => true
        ));
        curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        if ($info['http_code'] === 0) {
            return false;
        }
        return true;
    }

}
