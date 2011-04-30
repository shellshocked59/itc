 <div class="box">
<?php echo $this->element('video', array('video' => $video)); ?>
</div>
<div class="social">
  <?php echo $this->element('video_social', array('video_id' => $video['id'], 'user_id' => $uploader['id']))?>
</div>
<?php echo $this->element('comment', array('video_id' => $video['id'], 'user_id' => $uploader['id']))?>
<div class="box"> 
<h3>Other Videos in //Category</h3>
<?php echo $this->element('video_nav_horizontal_mockup', array('video' => $video)); ?>
</div>
<div class="box"> 
<h3>Other Videos in //Category</h3>
<?php echo $this->element('video_nav_horizontal_mockup', array('video' => $video)); ?>
</div>
<div class="box"> 
<h3>Other Videos in //Category</h3>
<?php echo $this->element('video_nav_horizontal_mockup', array('video' => $video)); ?>
</div>