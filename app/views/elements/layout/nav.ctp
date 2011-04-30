<ul>
	<?php if ($this->Session->check('Auth.User')):?>
		<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));?></li>
		<li><?php echo $this->Html->link('Upload a Video', '#', array('id' => 'upload_toggle'));?></li>
	<?php else:?>
		<li><?php echo $this->Html->link('Register', '#', array('id' => 'register_toggle'));?></li>
		<li><?php echo $this->Html->link('Login', '#', array('id' => 'login_toggle'));?></li>
	<?php endif;?>
	<li><?php echo $this->Html->link('Search', '#', array('id' => 'search_toggle'));?></li>
	<li class="home"><?php echo $this->Html->link($this->Html->image('../img/layout/icon-home-black.png'), array('controller' => 'videos', 'action' => 'index'), array('escape' => false));?></li>
</ul>
