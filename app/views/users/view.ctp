<h3>User Profile</h3>

<?php echo $this->element('video', array('video' => $video)); ?>

<div class="video_nav">
  <?php echo $this->element('video_menu', array('video_id' => $video['id'], 'user_id' => $uploader['id']))?>

  <!-- comments -->
  <?php echo $this->element('comment', array('video_id' => $video['id'], 'user_id' => $uploader['id']))?>
  </div>