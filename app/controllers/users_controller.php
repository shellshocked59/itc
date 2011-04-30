<?php

class UsersController extends AppController {
  var $name = 'Users';

  var $components = array('Session');

  function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allowedActions = array('login', 'register');
  }

  /**
   * Log a user in
   * Provided by AuthComponent
   */
  function login() {
  }

  /**
   * Log a user out
   * Provided by AuthComponent
   */
  function logout() {
	$this->redirect($this->Auth->logout());
	
  }

  /**
   * Register a new user
   */
  function register() {
	if (isset($this->data)) {
	  if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['confirm_password'])) {
		$this->User->create();
		$this->User->save($this->data);
		$this->Auth->login($this->data);
		$this->Session->setFlash('Successfully Registered');
		$this->redirect('/');
	  }
	}
  }
  function view($Userid) {
	  /**
		 ERIC - view is used to view a user Profile. unfortunately i suck at coding.
		 */
	  $cur_user = $this->User->find('first', array('conditions' => array('User.id' => $Userid)));
  $this->set('comments', $cur_video['Comment']);
  $this->set('videos', $cur_video['Video']);
  }
}