<div class="register_slider_container" id="register_slider_container" style="display: none;">
  <div id="register_slider">
	<?php echo $this->Form->create('User', array('action' => 'register'));?>
		Email:<br>
		<?php echo $this->Form->input('email', array('label' => false));?>
		
		Alias:<br>
		<?php echo $this->Form->input('alias', array('label' => false));?>
		
		Password:<br>
		<?php echo $this->Form->input('password', array('label' => false));?>
		
		Confirm Password:<br>
		<?php
			echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => false));
			echo $this->Form->end('/img/register.png');
		?>
  </div>
</div>