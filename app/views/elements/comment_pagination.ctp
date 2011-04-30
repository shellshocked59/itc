<?php
$this->Paginator->options(array('url' => array('controller' => 'videos', 'action' => 'updateComments', $video_id),
								'update' => '#comments',
								'evalScripts' => true));
?>

<?php foreach($pag_comment as $comment): ?>
<div class="comment box">
<p class="comment_text"><?php echo $comment['Comment']['comment']; ?></p>
<p class="comment_user"><?php echo 'Posted by ' . $comment['User']['alias'] . ' ' . $this->Time->timeAgoInWords($comment['Comment']['date']);?></p>
<div class="comment_actions clearfix">
<?php
  if ($this->Session->check('Auth.User')){
	echo $this->Html->link(
						   'Delete', 
						   array('action' => 'delete', $comment['Comment']['id']), 
						   array('class' => 'button'), 
						   'Are you sure?'
						   );
	//echo $this->Html->link(
						  // 'Approve', 
						  // array('action' => 'Approve', $comment['Comment']['id']), array('class' => 'button'));
  }
?>
</div>
</div>
<?php endforeach; ?>

<div class="comment_pagination">
  <!-- Shows the next and previous links -->
  <?php
	if ($this->Paginator->hasPrev()) {
	  echo $this->Paginator->prev('&laquo; Previous', array('class' => 'button', 'escape' => false));
	}
  ?>

  <!-- Shows the page numbers -->
  <?php echo $this->Paginator->numbers(); ?>

  <?php
	if ($this->Paginator->hasNext()) {
	  echo $this->Paginator->next('Next &raquo;', array('class' => 'button', 'escape' => false));
	}
  ?>
  <!-- prints X of Y, where X is current page and Y is number of pages -->
  <?php if (count($pag_comment) > 0): ?>
  <?php echo $this->Paginator->counter(array('format' => '%page% of %pages%')); ?>
  <?php else: ?>
  <p>No comments yet. Be the first to start the discussion?</p>
  <?php endif; ?>
</div>
</div>
</div>
<br>
<?php echo $this->Js->writeBuffer(); ?>