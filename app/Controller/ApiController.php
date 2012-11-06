<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api
 *
 * @author dozen
 */
class ApiController extends AppController {

    public $components = array('RequestHandler');
    public $uses = array('Url', 'Xml');

    public function index() {
        $result = $this->Url->register($this->request->query['url']);
        $data = array('url' => 'http://' . $result . '.略.tk', 'subdomain' => $result);
        switch ($this->request->params['ext']) {
            case 'json':
                $this->RequestHandler->setContent('json');
                $this->RequestHandler->respondAs('application/json');
                $this->set('body', json_encode($data));
                break;
            case 'xml':
                $this->RequestHandler->setContent('xml');
                $this->RequestHandler->respondAs('application/xml');
                $body = '<response>' .
                        '<url>' . $data['url'] . '</url>' .
                        '<subdomain>' . $data['subdomain'] . '</subdomain>' .
                        '</response>';
                $this->set('body', $body);
                break;
            default:
                $this->RequestHandler->setContent('txt');
                $this->RequestHandler->respondAs('text/plain');
                $this->set('body', $data['url']);
                break;
        }
    }

}

?>
