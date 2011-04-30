<div id="login_slider_container" style="display: none;">
  <div id="login_slider">
	<?php
	  echo $this->Form->create('User', array('action' => 'login'));
	?>
	Email:<br>
	<?php
	  echo $this->Form->input('email', array('label' => false, 'style' => 'width:100%;'));
	?>
	Password:<br>
	<?php
	  echo $this->Form->input('password', array('label' => false, 'style' => 'width:100%;'));
	?>
	<?php
	  echo $this->Form->end('/img/login.png');
	?>
  </div>
</div>