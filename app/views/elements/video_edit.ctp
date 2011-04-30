<div id="video_edit_container" style="display: none;">
  <div id="video_edit_slider">
	<?php
	  echo $this->Form->create('Video', array('action' => 'edit', 'type' => 'file'));
	?>
	
	
	<h4 style="padding-bottom:0;">Title</h4>
	<?php
	  echo $this->Form->input('title', array('label' => false, 'class' => 'upload_title input'));
	?>
	<h4 style="padding-bottom:0;">Description</h4>
	<?php
	  echo $this->Form->input('description', array('label' => false, 'class' => 'upload_desc input', 'style' => 'resize:none;'));
	?>
	
	<h4 style="padding-bottom:0; float:left;">Category</h4>
	<?php
	  echo $this->Form->input('category_id', array('label' => false, 'class' => 'left input'));
	?>
	<br><br>
	<?php
	  echo $this->Form->submit('Edit', array('class' => 'submit_button'));
	  echo $this->Form->end();
	  ?>
  </div>
</div>