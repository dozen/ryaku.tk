<?php

/**
 * Description of Url
 *
 * @author dozen
 */
App::import('Vendor', 'Basen');

class Url extends AppModel {

    public $name = 'Url';
    var $validate = array('url' => 'url');

    /**
     * URLの登録
     * @param string $url
     * @return string 変換後のURLの一部（サブドメイン部分）
     */
    function register($url) {
        $data = $this->find('first', array('conditions' => array('url' => $url)));
        if ($data === false) {    //登録されてなかったら登録作業をする。
            $count = $this->find('count');
            Basen::setCharFile();
            $basen = Basen::encode(++$count);
            $data = array('char' => $basen, 'url' => $url); //登録するデータ
            $result = $this->save($data);
            if($result === false) {
                //登録に失敗した時。
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
        preg_match('/^([-0-7a-zA-Z]*)\./', $url, $match);
        $puny_code = $match[1];
        $basen = $idna->decode($puny_code);
        $result = $this->find('first', array('conditions' => array('char' => $basen)));
        if ($result === false) {
            //DBに結果がなかった時になにかする
        }
        return $result;
    }

}
