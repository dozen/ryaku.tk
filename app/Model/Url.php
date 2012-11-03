<?php

/**
 * Description of Url
 *
 * @author dozen
 */
App::import('Vendor', 'Basen');

class Url extends AppModel {

    /**
     * URLの登録
     * @param string $url
     * @return string 変換後のURLの一部（サブドメイン部分）
     */
    function register($url) {
        $url = $this->find('first', array('conditions' => array('url' => $url)));
        if ($url === false) {    //登録されてなかったら登録作業をする。
            $count = $this->find('count');
            $basen = Basen::encode($count);
            $data = array('char' => $basen, 'url' => $url); //登録するデータ
            $this->save($data);
            $result = $basen;
        } else { //もうデータがあったらそれを返す。
            $result = $url['Url']['basen'];
        }
        return $result;
    }

    /**
     * 文字からURLを探す
     * @return string URL
     */
    function findUrl() {
        require_once('Net/IDNA2.php');
        $idna = Net_IDNA2::getInstance();
        preg_match('/^xn--.[0-7a-zA-Z]{0,}/', $this->params['url']['char'], $match);
        $puny_code = $match[0];
        $basen = $idna->decode($puny_code);
        $result = $this->find('first', array('conditions' => array('char' => $basen)));
        if ($result === false) {
            //DBに結果がなかった時になにかする
        }
        return $result;
    }

}
