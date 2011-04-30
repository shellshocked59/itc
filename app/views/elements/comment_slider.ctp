<!-- File: /app/views/comments/index.ctp  (edit links added) -->

<a href="#" id="comments_toggle" class="button">Show Comments</a>
<br><br>

  <div class="comments_slider_container" id="comments_slider_container" style="display: none;">
	<div id="comments_slider">



	  <!-- Add Comment -->
	  
	  <?php
		if ($this->Session->check('Auth.User')) {
		  echo $this->element('comment_add', array('video_id' => $video_id));
		} else {
		  echo '<p class="please_login_message">You must be logged in to submit comments</p>';
		}
	  ?>

	  <div id="comments">
		Loading...
	<?php $this->Js->buffer($this->Js->domReady($this->Js->request(array('action' => 'updateComments', $video_id), array('async' => false, 'update' => 'comments', 'complete' => "		var commentsSlider = new Fx.Slide('comments_slider', {
	  resetHeight: true
}).hide();

		$('comments_slider_container').setStyles({
			display: 'block'
		});

		if ($('comments_toggle')) {
			$('comments_toggle').addEvent('click', function(event){
				event.stop();
				commentsSlider.toggle();
			});
		}
")))); ?>
<?php echo $this->Js->writeBuffer(); ?>
	  </div>
	</div>
  </div>
  <br>

