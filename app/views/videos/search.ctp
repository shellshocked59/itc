<div class="clearfix">
  <h2>Searching for "<?php echo $query; ?>"</h2>

<?php if (count($this->data) > 0): ?>
<?php
$this->Paginator->options(array('url' => $this->passedArgs));
?>

<?php foreach($this->data as $video): ?> 
<div class="video_preview">
  <?php
	echo $this->Html->link('<h4 class="title">' . $video['Video']['title'] . '</h4>' .
						   $this->Html->image('/files/videos/' . $video['Video']['id'] . '.png', array('style' => 'width:205px;',
																									   "alt" => 'Video Preview Image')),
						   array('controller' => 'videos', 'action' => 'view', $video['Video']['id']),
						   array('escape' => false));
  ?>

<div class="metadata">
<?php echo $this->Time->timeAgoInWords($video['Video']['date']); ?>  
<?php echo "Avg. Rating: "; ?>
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
  <br />
  <!-- prints X of Y, where X is current page and Y is number of pages -->
  <div class="page_number"><?php echo $this->Paginator->counter(array('format' => '%page% of %pages%')); ?></div>
</div>
<?php else: ?>
No results found. Please try again.<br /><br />
<?php
echo $this->Form->create('Search', array('url' => array('controller' => 'videos', 'action' => 'search')));
echo $this->Form->input('search', array('label' => 'Search: ', 'style' => 'width:20em;'));
echo $this->Form->submit('Search', array('class' => 'submit_button'));
echo $this->Form->end();
?>

<?php endif; ?>
</div>