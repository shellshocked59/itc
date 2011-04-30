<?php echo $this->element('video'); ?>

<?php echo $this->element('video_social', array('video_id' => $this->data['Video']['id'], 'user_id' => $this->data['User']['id']))?>

<div class="box clearfix categories_box">
  <?php
	$i = 0;
	foreach($categories as $category_id => $category_name):
	$i++;
	if ($i < count($categories)) {
	  $bottom_border = 'border_bottom';
	} else {
	  $bottom_border = '';
	}
	?>
  <div id="category_nav-<?php echo $category_id; ?>" class="category_nav clearfix <?php echo $bottom_border; ?>">
	Loading...
	<?php $this->Js->buffer($this->Js->domReady($this->Js->request(array('action' => 'updateCategory', $category_id), array('async' => true, 'update' => 'category_nav-' . $category_id)))); ?>
  </div>
  <?php endforeach; ?>
</div>