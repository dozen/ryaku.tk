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

    public $uses = array('Url', 'Xml');
    public $components = array('RequestHandler');

    public function index() {
        $result = $this->Url->register($this->request->query['url']);
        $data = array('url' => 'http://' . $result . '.略.tk', 'subdomain' => $result);
        switch ($this->request->params['ext']) {
            case 'json':
                echo '<pre>';
                $this->RequestHandler->setContent('json');
                $this->RequestHandler->respondAs('application/json; charset=UTF-8');
                return new CakeResponse(array('body' => json_encode($data)));
                break;
            case 'xml':
                $this->RequestHandler->setContent('xml');
                $this->RequestHandler->respondAs('application/xml; charset=UTF-8');
                $value = '<?xml version="1.0" encoding="UTF-8"?>' .
                        '<response>' .
                        '<url>' . $data['url'] . '</url>' .
                        '<subdomain>' . $data['subdomain'] . '</dubdomain>' .
                        '</response>';
                return new CakeResponse(array('body' => $value));
                break;
            default:
                return new CakeResponse(array('body' => $data['url']));
                break;
        }
    }

}

?>
