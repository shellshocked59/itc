<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:og="http://ogp.me/ns#">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Citizen News:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php echo $this->Html->meta('icon'); ?>
	<?php
		echo $this->Html->css(array(
			'citizenNews',
			'likes',
			'sliders',
			'viewVideo',
			'video_preview'
		));
		echo $this->Html->script(array(
			'mootools.js', 'mootools-more.js', 'citizenNews.js'
		));
	?>
	<script type="text/javascript" src="/jwplayer/jwplayer.js"></script>
	<?php echo $scripts_for_layout; ?>
	<!--<?php
		//echo $this->Html->css('print', null, array('media' => 'print'));
		//echo '<!--[if IE]>' . $this->Html->css('ie') . '<![endif]-->';
		//echo '<!--[if IE 7]>' . $this->Html->css('ie7') . '<![endif]-->';
	?>-->
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('layout/nav');?>
			<?php echo $this->element('layout/login_slider'); ?>
			<?php echo $this->element('layout/register_slider'); ?>
			<?php echo $this->element('video_add'); ?>
			<?php echo $this->element('layout/header');?>
			<div style="margin:10px 10px;">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('email'); ?>
			</div>
		</div>
		<div id="body">
			<?php echo $content_for_layout; ?>
			
		</div>
		<div id="footer">
			<?php echo $this->element('layout/footer');?>
		</div>
	</div>
	<div class="shadow-bottom"></div>
<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
