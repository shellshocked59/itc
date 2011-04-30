<?php echo $this->element('video'); ?>

<?php echo $this->element('video_social', array('video_id' => $this->data['Video']['id'], 'user_id' => $this->data['User']['id'])); ?>

<?php echo $this->element('comment_slider', array('video_id' => $this->data['Video']['id'])); ?>

<div class="box">
<div id="category_nav-1" class="clearfix">
  Loading...
  <?php $this->Js->buffer($this->Js->domReady($this->Js->request(array('action' => 'updateCategory', $this->data['Category']['id']), array('async' => true, 'update' => 'category_nav-1')))); ?>
</div>
</div>