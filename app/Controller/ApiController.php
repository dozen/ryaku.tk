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
        if (isset($this->request->params['ext'])) {
            $type = $this->request->params['ext'];
        } else {
            $this->redirect('/');
        }

        $result = $this->Url->register($this->request->query['url']);
        $data = array('url' => 'http://' . $result . '.略.tk', 'subdomain' => $result);

        switch ($type) {
            case 'json':
                $this->RequestHandler->setContent('json');
                $this->RequestHandler->respondAs('application/json');
                $body = json_encode($data);
                break;
            case 'xml':
                $this->RequestHandler->setContent('xml');
                $this->RequestHandler->respondAs('application/xml');
                $body = '<response>' .
                        '<url>' . $data['url'] . '</url>' .
                        '<subdomain>' . $data['subdomain'] . '</subdomain>' .
                        '</response>';
                break;
            default:
                $this->RequestHandler->setContent('txt');
                $this->RequestHandler->respondAs('text/plain');
                $body = $data['url'];
                break;
        }
        if ($result === false) {
            $this->issueError($type);
        } else {
            $this->set('body', $body);
        }
    }

    function issueError($type) {
        switch ($type) {
            case 'json':
                $this->set('body', json_encode(array('error' => '有効なURLではありません')));
                break;
            case 'xml':
                $body = '<error>有効なURLではありません</error>';
                $this->set('body', $body);
                break;
            default:
                $this->set('body', 'error: 有効なURLではありません');
                break;
        }
    }

}

?>
