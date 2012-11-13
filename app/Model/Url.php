<?php

/**
 * Description of Url
 *
 * @author dozen
 */
App::import('Vendor', 'Basen');
App::import('Vendor', 'Validate');

class Url extends AppModel {

    /**
     * URLの登録
     * @param string $url
     * @return string 変換後のURLの一部（サブドメイン部分）
     */
    function register($url) {
        $url = Validate::isURL($url);
        if ($url === false) {
            return false;
        }
        $data = $this->find('first', array('conditions' => array('url' => $url)));
        if ($data === false) {    //登録されてなかったら登録作業をする。
            $count = $this->find('count');
            Basen::setCharFile();
            $basen = Basen::encode($count);
            $data = array('char' => $basen, 'url' => $url); //登録するデータ
            $result = $this->save($data);
            if ($result === false) {
                //DBへの登録が失敗した時
                return false;
            }
            $char = $basen;
        } else { //もうデータがあったらそれを返す。
            $char = Hash::get($data, 'Url.char');
        }
        return $char;
    }

    /**
     * 文字からURLを探す
     * 
     * @return string URL
     */
    function findUrl($url) {
        require_once('Net/IDNA2.php');
        $idna = Net_IDNA2::getInstance();
        $urlArr = explode('.', $url);
        $puny_code = $urlArr[0];
        $subdomain = $idna->decode($puny_code);
        $result = $this->find('first', array('conditions' => array('char' => $subdomain)));
        if ($result === false) {
            //DBに結果がなかった時になにかする
        }
        return $result;
    }

}
