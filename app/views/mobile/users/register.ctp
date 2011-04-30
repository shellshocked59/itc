<div style="width 100%; background-color:'white';">
<?php
echo $this->Form->create('User', array('action' => 'register', 'class' => 'webButton'));
echo $this->Form->input('email', array('class' => 'webButton'));
echo $this->Form->input('alias', array('label' => 'Nickname', 'class' => 'webButton'));
echo $this->Form->input('password', array('class' => 'webButton'));
echo $this->Form->input('confirm_password', array('class' => 'webButton', 'type' => 'password'));
echo $this->Form->end('Register', array('class' => 'webButton'));
?>
	</div>
	
	
	