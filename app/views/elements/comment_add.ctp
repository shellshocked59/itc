<!-- File: /app/views/posts/add.ctp -->	
	

<!-- <textarea id="myTextarea" style="font-family: tahoma,arial,sans-serif">Start typing...</textarea> -->


<?php
echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'addAJAX', $video_id), 'default' => false));
echo $this->Form->textarea('comment', array('default' => 'Write a comment...', 'class' => 'input', 'style' => 'resize:none; height:100px; width:100%;'));
$this->Js->get('#CommentComment');

$on_focus = "
if (event.target.value == 'Write a comment...') {
  event.target.value = '';
}
";
$this->Js->event('focus', $on_focus, array('stop' => false));

$on_losing_focus = "
if (event.target.value == '') {
  event.target.value = 'Write a comment...';
}
";
$this->Js->event('blur', $on_losing_focus, array('stop' => false));
?>
<br><br>
<?php
$after_submit = "
//$('comments_slider').getParent().setStyle('height', 'auto');
$('CommentComment').value = 'Write a comment...';
";
echo $this->Js->submit('Comment', array('update' => '#comments',
										'url' => array('controller' => 'comments', 'action' => 'addAJAX', $video_id),
										'complete' => $after_submit,
										'class' => 'submit_button'));
echo $this->Form->end();
?>
<br />
