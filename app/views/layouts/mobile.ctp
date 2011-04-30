<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Citizen News:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php echo $this->Html->meta('icon'); ?>
	<?php
	  echo $this->Html->css(array('mobile'));
	?>
</head>
<body>
<div id="header">
	<h1><?php echo $this->Html->link('Citizen News', '/');?><?php echo $this->Html->image("../img/icons/video.png", array('alt' => "Citizen News"));?></h1>
</div>
<?php echo $content_for_layout; ?>
<div id="footer">
</div>
</body>
</html>