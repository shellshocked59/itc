<?php
if ($this->Paginator->hasPrev()) {
  echo $this->Paginator->prev('Newer Videos');
}
?>
<?php foreach($this->data as $video): ?> 
<div class="video_preview">
  <?php
	echo $this->Html->link('<h4 class="title">' . $video['Video']['title'] . '</h4>' .
						   $this->Html->image('/files/videos/' . $video['Video']['id'] . '.png', array('style' => 'width:205px;',
																									   "alt" => 'Video Preview Image')),
						   array('controller' => 'videos', 'action' => 'view', $video['Video']['id'], 'mobile' => true),
						   array('escape' => false));
  ?>

<div class="metadata">
<?php echo $this->Time->timeAgoInWords($video['Video']['date']); ?>  
<?php echo "Avg. Rating: "; ?>
<?php echo $video['Video']['avg_rating']; ?> 
</div>

</div>
<?php endforeach; ?> 
<br />
<?php
if ($this->Paginator->hasNext()) {
  echo $this->Paginator->next('Older Videos');
}
?>
<?php echo $this->Js->writeBuffer(); ?>
