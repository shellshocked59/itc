<?php
echo $this->Form->create('User', array('action' => 'register'));
echo $this->Form->input('email');
echo $this->Form->input('alias', array('label' => 'Nickname'));
echo $this->Form->input('password');
echo $this->Form->input('confirm_password', array('type' => 'password'));
echo $this->Form->end('Register');
?>