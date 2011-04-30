<div class="box social" style="height:32px; margin-top:2px;">
   <ul>



	<!-- email button TODO make into form -->
	<li><a style="margin-right:10px;" id='embed_toggle' href="#" class="button left">Show Embed Code</a></li>
	<!-- end email button -->
	
	<!-- twitter link/button -->
	<li class="social_button" style="margin:5px 10px 0 0; width:90px; overflow:hidden;"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	</li><!-- end twitter link/button -->
	
	<!-- Tumblr.com/share -->
	<li class="social_button" style="margin-top:5px;"><a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:129px; height:21px; background:url('http://www.tumblr.com/platform/v1/share_3.png') top left no-repeat transparent;">Share on Tumblr</a> 
	</li><!-- END Tumblr.com/share -->
	<!-- Google Buzz -->
	<li class="social_button" style="margin-top:3px;"><a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="normal-button"></a>
	<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
	</li><!-- END Google Buzz -->
	
	<!-- reddit button -->
	<li class="social_button" style="margin:6px 10px 0 0;"><script type="text/javascript" src="http://www.reddit.com/static/button/button1.js"></script>
	</li>
	<!-- end reddit button -->
	
	<!-- facebook button -->
	<li class="social_button" style="margin-top:5px;"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode($this->Html->url(array('controller' => 'videos', 'action' => 'view', $video_id), true)); ?>&amp;layout=button_count&amp;show_faces=true&amp;width=25&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></li>
	<!-- end facebook button -->
	
	
</ul>
</div>
<br />
	<div id="embed_slider_container" style="display: none; width:66%; position:absolute;">
  <div id="embed_slider">
	
		<textarea class="wdth-100" style="height:100px;"><?php echo '<video width="640" height="360" controls>';
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
		 ?></video></textarea>
		
  </div>
</div>					
	<div class="email_container" id="email_container" style="display: none;">
		<div id="email_slider">
		To:  tester@test.com  <br />
		From:  sender@send.com <br />
		Subject:  Subject  <br />
		Body: [Default: Check out this cool video at get.CurrentUrl  <br />
		SendButton
		
		</div>
	</div>
<br>