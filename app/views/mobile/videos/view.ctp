<h2><?php echo $this->data['Video']['title']; ?></h2>

<?php
echo '<video width="100%" style="max-width:480" controls poster="' . $this->Html->url('/files/videos/' . $this->data['Video']['id'] . '.png') . '" onclick="this.play()">';
foreach($this->data['Video']['filenames'] as $filename => $filetype) {
  if (substr($filename, -3, 3) == 'mp4') {
  	$mp4_filename = $filename;
  }
  echo '<source src="' . $html->url($filename) . '" ';
  if (!empty($filetype)) {
	echo 'type=\'' . $filetype . '\' />';
  } else {
	echo '/>';
  }
}
?>
<object width="480" height="360" type="application/x-shockwave-flash" data="<?php echo $this->Html->url('/jwplayer/player.swf'); ?>">
	<!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
	<param name="movie" value="<?php echo $this->Html->url('/jwplayer/player.swf'); ?>" />
	<param name="flashvars" value="controlbar=over&amp;image=<?php echo $this->Html->url('/jwplayer/preview.jpg'); ?>&amp;file=<?php echo $html->url($mp4_filename);?>" />
	<!-- fallback image. note the title field below, put the title of the video there -->
	<img src="<?php echo $this->Html->url('/jwplayer/preview.jpg'); ?>" width="640" height="360" alt="Sample"
	     title="No video playback capabilities, please download the video below" />
</object>
<?php
echo '</video>';
?>
<!-- END VIDEO -->
<br />
<br />
like button goes here
<br />
Uploaded by: 
<?php echo $this->data['User']['alias']; ?>
<br />
<?php echo $this->Time->timeAgoInWords($this->data['Video']['date']); ?>
<br />
Category: <?php echo $this->data['Category']['name']; ?>
<br />
Video Duration: 
<?php echo $this->data['Video']['duration_hours'] . ':' . $this->data['Video']['duration_minutes'] . ':' . $this->data['Video']['duration_seconds']; ?>


	
