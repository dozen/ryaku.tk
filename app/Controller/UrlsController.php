<?php

App::import('Vendor', 'Validate');
App::uses('Sanitize', 'Utility');

/**
 * Description of UrlsController
 *
 * @author dozen
 */
class UrlsController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('title_for_layout', '略.tk -URL短縮サービス-');
        $this->set('urlCount', $this->Url->find('count'));
    }

    public function jump() {
        $this->set('title_for_layout', '略.tk -URL短縮サービス-');
        $requestUrl = $this->request->pass[0];
        $url = $this->Url->findUrl($requestUrl);
        //$this->redirect(Hash::get($url, 'Url.url'));
        $this->set('url', Hash::get($url, 'Url.url'));
        $this->set('sanitizedUrl', Sanitize::html(Hash::get($url, 'Url.url')));
        $safe = Validate::isSafe($url);
        switch($safe) {
            case true:
                $this->set('safe', '<span style="color:green">危険性は見つかりませんでした。</span>');
                break;
            case false:
                $this->set('safe', '<span style="color:red">有害である可能性があります。</span>');
                break;
            case 'error':
                $this->set('safe', '<span style="color:grey">検査に失敗しました。安全性は未確認です。</span>');
                break;
        }
    }

}
