<h3>Other <?php echo $categories[$category_id]; ?> Videos</h3>
<?php
$this->Paginator->options(array('url' => array('action' => 'updateCategory', $category_id),
								'update' => '#category_nav-' . $category_id,
								'evalScripts' => true));
?>


<?php foreach($category_videos as $video): ?> 
<div class="video_preview">
<h4 class="title"><?php echo $video['Video']['title']; ?></h4>

<?php echo $this->Html->image("/files/videos/" . $video['Video']['id'] . '.png', array( 'style' => 'width:205px; height:100',   "alt" => "Nav_Mockup",    'url' => array('controller' => 'videos', 'action' => 'view', $video['Video']['id']))); ?>

<div class="metadata">
<?php echo $this->Time->timeAgoInWords($video['Video']['date']); ?>  
<?php echo " - Avg. Rating: "; ?>
<?php echo $video['Video']['avg_rating']; ?> 
</div>

</div>
<?php endforeach; ?> 

<div class="pagination_links">
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
  <?php if (count($category_videos) > 0): ?>
  <?php echo $this->Paginator->counter(array('format' => '%page% of %pages%')); ?>
  <?php endif; ?>
</div>
<?php echo $this->Js->writeBuffer(); ?>