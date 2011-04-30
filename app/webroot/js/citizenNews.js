window.addEvent('domready', function() {
	if ($('desc_slider')) {	
		var descSlider = new Fx.Slide('desc_slider').hide();

		$('desc_slider').setStyles({
			display: 'block'
		});

		if ($('desc_toggle')) {
			$('desc_toggle').addEvent('click', function(event){
				event.stop();
				descSlider.toggle();
			});
		}
	}
	
	
	if ($('register_slider')) {
		var registerSlider = new Fx.Slide('register_slider').hide();

		$('register_slider_container').setStyles({
			display: 'block'
		});

		if ($('register_toggle')) {
			$('register_toggle').addEvent('click', function(event){
				event.stop();
				registerSlider.toggle();
			});
		}
	}
	
	if ($('login_slider')) {
		var loginSlider = new Fx.Slide('login_slider').hide();

		$('login_slider_container').setStyles({
			display: 'block'
		});

		if ($('login_toggle')) {
			$('login_toggle').addEvent('click', function(event){
				event.stop();
				loginSlider.toggle();
			});
		}
	}
	
	if ($('search_slider')) {
		var searchSlider = new Fx.Slide('search_slider').hide();

		$('search_slider_container').setStyles({
			display: 'block'
		});

		if ($('search_toggle')) {
			$('search_toggle').addEvent('click', function(event){
				event.stop();
				searchSlider.toggle();
			});
		}
	}

	
	
	
	if ($('upload_slider')) {
		var uploadSlider = new Fx.Slide('upload_slider').hide();

		$('upload_slider_container').setStyles({
			display: 'block'
		});

		if ($('upload_toggle')) {
			$('upload_toggle').addEvent('click', function(event){
				event.stop();
				uploadSlider.toggle();
			});
		}
	}



	if ($('video_edit_slider')) {
		var videoEditSlider = new Fx.Slide('video_edit_slider').hide();

		$('video_edit_container').setStyles({
			display: 'inline'
		});

		if ($('video_edit_toggle')) {
			$('video_edit_toggle').addEvent('click', function(event){
				event.stop();
				videoEditSlider.toggle();
			});
		}
	}
	
	
	if ($('email_slider')) {
		var emailSlider = new Fx.Slide('email_slider').hide();

		$('email_container').setStyles({
			display: 'inline'
		});

		if ($('email_toggle')) {
			$('email_toggle').addEvent('click', function(event){
				event.stop();
				emailSlider.toggle();
			});
		}
	}

	/*	
	if ($('comment_slider')) {
		var emailSlider = new Fx.Slide('comment_slider').hide();

		$('comment_container').setStyles({
			display: 'inline'
		});

		if ($('comment_toggle')) {
			$('comment_toggle').addEvent('click', function(event){
				event.stop();
				emailSlider.toggle();
			});
		}
	}
	*/
	
	if ($('embed_slider')) {
		var embedSlider = new Fx.Slide('embed_slider').hide();

		$('embed_slider_container').setStyles({
			display: 'block'
		});

		if ($('embed_toggle')) {
			$('embed_toggle').addEvent('click', function(event){
				event.stop();
				embedSlider.toggle();
			});
		}
	}
	
	
});
