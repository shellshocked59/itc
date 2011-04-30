<div class="box">
<?php
// Set up meta tags to hopefully embed in FB
$this->Html->meta(array('property' => 'fb:app_id', 'content' => '100397303382713'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:type', 'content' => 'video'), null, array('inline' => false));
//$this->Html->meta(array('property' => 'og:video', 'content' => $this->Html->url($this->data['Video']['flv_filename'], true)), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video', 'content' => 'http://rinon.dyndns.org/jwplayer/player.swf?controlbar=over&image=' . $this->Html->url('/files/videos/' . $this->data['Video']['id'] . '.png') . '&file=' . $this->Html->url('/files/videos/' . $this->data['Video']['id'] . '.flv', true)), null, array('inline' => false, 'escape' => false));
$this->Html->meta(array('property' => 'og:video:type', 'content' => 'application/x-shockwave-flash'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video:width', 'content' => '398'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video:height', 'content' => '460'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:image', 'content' => $this->Html->url($this->data['Video']['preview_image'], true)), null, array('inline' => false));
?>


	
	
<h2><?php echo $this->data['Video']['title']; ?></h2>
<div id="video_right_nav">
  <?php if (($this->Session->check('Auth.User') && $this->Session->read('Auth.User.id') == $this->data['User']['id']) || $this->Session->read('Auth.User.admin')){
	  //echo $this->Html->link($this->Html->image("icons/film_key.png", array('alt' => 'Change Your Featured Video')), array('controller' => 'videos', 'action' => 'setFeatured', $this->data['Video']['id']), array('escape' => false));
	//echo $this->Html->link($this->Html->image("icons/film_edit.png", array('alt' => 'Edit This Video')), array('controller' => 'videos', 'action' => 'edit', 'video_id' => $this->data['Video']['id']), array('escape' => false));
	echo $this->Html->link($this->Html->image("icons/film_edit.png", array('alt' => 'Edit This Video')), '#',  array('id' => 'video_edit_toggle', 'escape' => false));
	echo $this->Html->link($this->Html->image("icons/film_delete.png", array('alt' => 'Delete Your Video')), array('controller' => 'videos', 'action' => 'delete', $this->data['Video']['id']), array('escape' => false));?>
	
	<?php echo $this->element('video_edit'); }?>
	
		
	<br />
	<p class="video_uploaded" >Uploaded by: <?php echo $this->data['User']['alias']; ?><br />
	<?php echo $this->Time->timeAgoInWords($this->data['Video']['date']); ?>
	<p> Views: <?php echo $this->data['Video']['views'];?> </p>
	<p class="video_category">Category: <?php echo $this->data['Category']['name']; ?></p>
	<p class="video_duration">Duration: <?php echo $this->data['Video']['duration_hours'] . ':' . $this->data['Video']['duration_minutes'] . ':' . $this->data['Video']['duration_seconds']; ?></p>
	
	
	
		<!-- ?php echo $this->data['category']; ?> -->
	<?php echo $this->element('likes', array('video_id' => $this->data['Video']['id'], 'cur_rating' => $cur_rating)); ?>
	<br />
	
	
	
	<br>
	<a id='desc_toggle' class="button">Show Description</a>
	<br><br>
	<div id="desc_slider_container">
	<div id="desc_slider" class="clearfix" style="display: none;">
	  <?php if ($this->data['Video']['description']==""):?>
	  	<i>No Description</i>
	  <?php else:?>
	  	<textarea style="width:98%; height:150px;" readonly=readonly><?php echo $this->data['Video']['description']; ?></textarea>
	  <?php endif;?>
	</div>
	</div>

</div>
<?php
echo '<video width="640" height="360" controls>';
foreach($this->data['Video']['filenames'] as $filename => $filetype) {
  echo '<source src="' . $html->url($filename) . '" ';
  if (empty($filetype)) {
	echo 'type="' . $filetype . '">';
  } else {
	echo '>';
  }
}
$mp4_filename = '/files/videos/' . $this->data['Video']['id'] . '.flv';
?>
<object width="640" height="360" type="application/x-shockwave-flash" data="<?php echo $this->Html->url('/jwplayer/player.swf'); ?>">
	<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
	<param name="movie" value="<?php echo $this->Html->url('/jwplayer/player.swf'); ?>" />
	<param name="flashvars" value="controlbar=over&amp;image=<?php echo $this->Html->url(substr($filename, 0, -4) . '.png'); ?>&amp;file=<?php echo $html->url($mp4_filename);?>" />
	<!-- fallback image. note the title field below, put the title of the video there -->
	<img src="<?php echo $this->Html->url('/files/videos/' . substr($filename, 0, -4) . '.png'); ?>" width="640" height="360" alt="Sample"
	     title="No video playback capabilities, please download the video below" />
</object>
<?php
echo '</video>';
?>
</div>
<br>
