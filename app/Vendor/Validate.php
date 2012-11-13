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
        return $info['url'];
    }

    public static function isSafe($url) {
        $apiKey = Configure::read('SafeBrowsingAPI.key');
        $url = 'https://sb-ssl.google.com/safebrowsing/api/lookup?client=api&apikey=' . $apiKey . '&appver=1.0&pver=3.0&url=' . $url;
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
        ));
        $body = curl_exec($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);
        $httpStatus = $header['http_code'];
        switch ($httpStatus) {
            case 204:
                return true;
                break;
            case 200:
                return false;
                break;
            default:
                return 'error';
                break;
        }
    }

}
