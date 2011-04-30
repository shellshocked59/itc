<div id="search_slider_container" style="display: none;">
  <div id="search_slider">
	<?php
	  echo $this->Form->create('Search', array('url' => array('controller' => 'videos', 'action' => 'search')));
	  echo $this->Form->input('search', array('label' => false, 'style' => 'width:100%;'));
	  echo $this->Form->end('/img/search.png');
	?>
  </div>
</div>