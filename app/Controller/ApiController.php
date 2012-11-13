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

        if (!isset($this->request->query['url'])) {
            $this->issueError($type, 1);
        } else {
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
    }

    function issueError($type, $code = 0) {
        if ($code === 1) {
            $message = '引数が足りません';
        } else {
            $message = '有効なURLではありません';
        }
        switch ($type) {
            case 'json':
                $this->set('body', json_encode(array('error' => $message)));
                break;
            case 'xml':
                $body = '<error>' . $message . '</error>';
                $this->set('body', $body);
                break;
            default:
                $this->set('body', 'error: ' . $message);
                break;
        }
    }

}

?>
