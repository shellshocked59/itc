<div id="upload_slider_container" style="display: none;">
  <div id="upload_slider">
	
	<?php
	  echo $this->Form->create('NewVideo', array('url' => array('controller' => 'videos', 'action' => 'add'), 'type' => 'file'));
	?>
	
	<?php 
	  echo $this->Form->file('uploadedFile', array('class' => 'input'));
	?>
	<h4 style="padding-bottom:0;">Title</h4>
	<?php
	  echo $this->Form->input('title', array('label' => false, 'class' => 'upload_title input'));
	?>
	<h4 style="padding-bottom:0;">Description</h4>
	<?php
	  echo $this->Form->textarea('description', array('label' => false, 'class' => 'upload_desc input'));?>
	
	<h4 style="padding-bottom:0; float:left;">Category</h4>
	<?php
	  echo $this->Form->input('category_id', array('label' => false, 'class' => 'left input'));
	?>
	<br><br>
	<?php echo $this->Form->end('/img/upload.png');?>
	
  </div>
</div>