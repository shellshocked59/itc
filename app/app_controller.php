<?php

class AppController extends Controller {
  var $components = array('Auth' => array('fields' => array('username' => 'email',
															'password' => 'password'),
										  'loginRedirect' => '/',
										  'logoutRedirect' => '/'));

  var $helpers = array('Html', 'Form', 'Session', 'Js' => array('Mootools'), 'Time', 'Paginator');

  var $uses = array('Category');

  function beforeFilter() {
	$this->set('categories', $this->Category->find('list'));
	if ((isset($this->params['mobile']) && $this->params['mobile']) || (isset($this->params['named']['mobile']) && $this->params['named']['mobile'])) {
	  $this->viewPath = 'mobile/' . $this->viewPath;
	  $this->layout = 'mobile';
	  $this->helpers = array('Html', 'Form', 'Session', 'Time', 'Paginator');
	}
  }
}

?>