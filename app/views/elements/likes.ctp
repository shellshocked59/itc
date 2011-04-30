<div id="rating">
  <p class="rating">Avg. Rating: <?php echo $this->data['Video']['avg_rating']; ?>
  <br />
  <?php
	if (!is_numeric($cur_rating)) {
	  $wrapper_class = 'nolikes';
	} elseif ($cur_rating == 1) {
	  $wrapper_class = 'likes';
	} elseif ($cur_rating == 0) {
	  $wrapper_class = 'dislikes';
	}
  ?>

  <div class="<?php echo $wrapper_class; ?> clearfix">
  <div class="thumbs_down">
	<?php
		if ($cur_rating == 1 || !is_numeric($cur_rating)) {
		  echo $this->Js->link($this->Html->image("icons/thumb_down_grey.png", array('alt' => 'Thumbs Down')), array('controller' => 'videos', 'action' => 'rateAjax', $video_id, -1), array('escape' => false, 'update' => '#rating', 'buffer' => false));
		} else {
		  echo $this->Html->image("icons/thumb_down.png", array('alt' => 'Thumbs Down'));
		}
	?>
  </div>
  <div class="thumbs_up">
	<?php
		if ($cur_rating == 0 || !is_numeric($cur_rating)) {
		  echo $this->Js->link($this->Html->image("icons/thumb_up_grey.png", array('alt' => 'Thumbs Up')), array('controller' => 'videos', 'action' => 'rateAjax', $video_id, 1), array('escape' => false, 'update' => '#rating', 'buffer' => false));
		} else {
		  echo $this->Html->image("icons/thumb_up.png", array('alt' => 'Thumbs Up'));
		}
	?>
  </div>
  

  
  <div class="like_text">Like<br>Dislike</div>
</div>
</div>