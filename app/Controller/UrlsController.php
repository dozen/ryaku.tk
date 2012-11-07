<?php
App::import('Vendor', 'Validate');
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

    public function shortcut() {
        $result = $this->Url->register(Hash::get($this->data, 'Url.url'));
        $this->set('subdomain', $result);
    }

}
