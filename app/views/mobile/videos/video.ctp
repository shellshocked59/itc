<div class="box">
<?php
// Set up meta tags to hopefully embed in FB
$this->Html->meta(array('property' => 'fb:app_id', 'content' => '100397303382713'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:type', 'content' => 'video'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video', 'content' => $this->Html->url($this->data['Video']['flv_filename'], true)), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video:type', 'content' => 'application/x-shockwave-flash'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video:width', 'content' => '398'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:video:height', 'content' => '460'), null, array('inline' => false));
$this->Html->meta(array('property' => 'og:image', 'content' => $this->Html->url($this->data['Video']['preview_image'], true)), null, array('inline' => false));
?>


<?php
echo '<video width="640" height="360" controls>';
foreach($this->data['Video']['filenames'] as $filename => $filetype) {
  if (substr($filename, -3, 3) == 'mp4') {
  	$mp4_filename = $filename;
  }
  echo '<source src="' . $html->url($filename) . '" ';
  if (empty($filetype)) {
	echo 'type="' . $filetype . '">';
  } else {
	echo '>';
  }
}
?>
<object width="640" height="360" type="application/x-shockwave-flash" data="<?php echo $this->Html->url('/jwplayer/player.swf'); ?>">
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
</div>
<br>
