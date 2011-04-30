<?php

class VideosController extends AppController {
  var $name = 'Videos';

  var $components = array('Session', 'RequestHandler');


  function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allowedActions = array('index', 'view', 'updateCategory', 'updateComments', 'mobile_index', 'search');
  }


  /**
   * View currently featured videos
   */
  function index() {
	$list = array_keys($this->Video->find('list', array('conditions' => array('Video.featured' => true),
														'recursive' => false,
														'order' => 'rand()'
														)));
	$featuredId = $list[0];
	$this->view($featuredId);
  }

  function mobile_index() {
	$this->paginate = array(
        'limit' => 10,
        'order' => array('Video.date' => 'desc')
    );
	$this->data = $this->paginate('Video', array('Video.featured' => true));
	$this->render('index');
  }

  /**
   * Search for a video
   */
  function search() {
	if (isset($this->data)) {
	  $query = $this->data['Search']['search'];
	  $this->passedArgs['query'] = $query;
	} else {
	  $query = $this->passedArgs['query'];
	}
	$query_wildcards = '%' . $query . '%';
	$this->set('query', $query);
	$this->paginate = array(
        'limit' => 10,
        'order' => array('Video.date' => 'desc')
    );
	$this->data = $this->paginate('Video', array('OR' => array('Video.title LIKE' => $query_wildcards,
															   'Video.description LIKE' => $query_wildcards,
															   'Category.name LIKE' => $query_wildcards,
															   'Video.date LIKE' => $query_wildcards)));
  }

  /**
   * View a news video
   */
  function view($videoId) {
	//debug($this->Auth->user());
	$this->data = $this->Video->read(null, $videoId);
	if (empty($this->data['Video'])) {
	  $this->Session->setFlash("This video is no longer available.");
	  $this->redirect('/error');
	  return;
	}
	//debug($this->data);

	// Increment views
	$this->Video->set('views', $this->data['Video']['views']+1);
	$this->Video->save();

	$this->data['Video']['filenames'] = $this->_getVideoFilenames($videoId);

	$this->data['Video']['flv_filename'] = $this->_getFlashFilename($videoId);
	$this->data['Video']['preview_image'] = '/' . Configure::read('Video.file_base_path') . '/' . $videoId . '.png';

	$this->data['Video']['duration_hours'] = sprintf("%02u", floor($this->data['Video']['duration'] / (60*60)));
	$this->data['Video']['duration_minutes'] = sprintf("%02u", floor(($this->data['Video']['duration'] % (60*60) / 60)));
	$this->data['Video']['duration_seconds'] = sprintf("%02u", $this->data['Video']['duration'] % 60);

	$cur_user = $this->Auth->user();
	$cur_rating = $this->Video->Rating->find('first', array('conditions' => array('Rating.user_id' => $this->Auth->user('id'),
																				  'Rating.video_id' => $videoId)));
	$this->set('cur_rating', $cur_rating['Rating']['rate']);

	$this->set('comments', $this->data['Comment']);
	$this->set('title_for_layout', 'Citizen News - ' . $this->data['Category']['name'] . ' - ' . $this->data['Video']['title']);
  }

  /**
   * (AJAX) Update a category pagination
   */
  function updateCategory($categoryId) {
	$this->paginate = array('limit' => 4,        'order' => array(
            'Video.date' => 'desc'
        )
);
	$pag_category = $this->paginate('Video', array('Video.category_id' => $categoryId));
	$this->set('category_videos', $pag_category);
	$this->set('category_id', $categoryId);
	$this->render('/elements/video_nav', 'ajax');
  }

  /**
   * (AJAX) Update comment pagination
   */
  function updateComments($videoId) {
	$this->paginate = array(
        'limit' => 5,
        'order' => array(
            'Comment.date' => 'desc'
        )
    );
	$pag_comment = $this->paginate('Comment', array('Comment.video_id' => $videoId));
	
	$this->set('pag_comment', $pag_comment);
	$this->set('video_id', $videoId);
	$this->render('/elements/comment_pagination', 'ajax');
  }

  /**
   * Add a news video (user-submitted)
   * Only users are allowed to upload videos.
   */
  function add() {
	if (isset($this->data)) {
	  $this->data['Video'] = $this->data['NewVideo'];
	  unset($this->data['NewVideo']);
	  if (!is_uploaded_file($this->data['Video']['uploadedFile']['tmp_name'])) {
		$this->Session->setFlash('An error has occurred while uploading your video.');
		return;
	  }
	  switch ($this->data['Video']['uploadedFile']['type']) {
	  case 'video/ogg':
		$fileExt = '.ogv';
		break;
	  case 'video/mp4':
		$fileExt = '.mp4';
		break;
	  default:
		$this->Session->setFlash('Invalid File Type!');
		return;
	  }

	  $this->data['Video']['date'] = date('Y-m-d H:i:s');

	  $this->data['Video']['user_id'] = $this->Auth->user('id');
	  $this->data['Video']['like'] = 0;
	  $this->data['Video']['dislike'] = 0;

	  $this->Video->create();
	  $this->Video->save($this->data);
	  $dest_abs_path = WWW_ROOT . Configure::read('Video.file_base_path') . DS . $this->Video->id . $fileExt;
	  move_uploaded_file($this->data['Video']['uploadedFile']['tmp_name'], $dest_abs_path);

	  // Ignore devel machines...
	  if (PHP_OS == 'Linux') {
		$raw_length = exec('mplayer -identify "' . escapeshellcmd($dest_abs_path) . '" -frames 0 -vc null -vo null -ao null 2> /dev/null | grep ID_LENGTH');
		$this->data['Video']['duration'] = round(substr(strstr($raw_length, '='), 1));
		$this->Video->save($this->data);

		// Place symlink into queue for processing script to convert
		symlink($dest_abs_path, TMP . Configure::read('Video.queue_path') . DS . $this->Video->id . $fileExt);
	  }


	  $this->Session->setFlash('Video Uploaded');
	  $this->redirect(array('action' => 'view', $this->Video->id));
	}
  }

  /**
   * Edit a video.
   * Admins and the submitter are allowed to edit.
   */
  function edit($videoId) {
	$cur_video = $this->Video->read(null, $videoId);

	// Verify permissions
	if ($this->Auth->user('id') != $cur_video['User']['id'] && !$this->Auth->user('admin')) {
	  $this->Session->setFlash('Insufficient Privileges to edit this video!');
	  $this->redirect(array('action' => 'view', $this->Video->id));
	  return;
	}

	if (isset($this->data)) {
	  $this->Video->save($this->data);
	  $this->Session->setFlash('Video Edited');
	  $this->redirect(array('action' => 'view', $this->Video->id));
	} else {
	  $this->set('categories', $this->Video->Category->find('list'));
	  $this->data = $cur_video;
	}
  }

  /**
   * Rate a video (thumbs-up, thumbs-down)
   * Only users are allowed to rate, and only once per user.

   * Rating should be + or - 1
   */
  function rate($videoId, $rating) {
	$this->_rateHelper($videoId, $rating);

	$this->redirect(array('action' => 'view', $videoId));
  }

  /**
   * AJAX Rating
   */
  function rateAjax($videoId, $rating) {
	$this->data['Video']['avg_rating'] = $this->_rateHelper($videoId, $rating);
	if ($rating == 1) {
	  $this->set('cur_rating', 1);
	} else {
	  $this->set('cur_rating', 0);
	}
	$this->set('video_id', $videoId);
	$this->render('/elements/likes', 'ajax');
  }

  private function _rateHelper($videoId, $rating) {
	if ($rating != 1 && $rating != -1) {
	  $this->Session->setFlash('Invalid rating');
	  $this->redirect(array('action' => 'view', $videoId));
	  return;
	}

	$cur_video = $this->Video->read(null, $videoId);
	$likes = $cur_video['Video']['like'];
	$dislikes = $cur_video['Video']['dislike'];
	//debug($cur_video);
	$prev_rating = $this->Video->Rating->find('first', array('conditions' => array('Rating.user_id' => $this->Auth->user('id'),
																				   'Rating.video_id' => $videoId)));
	if (!empty($prev_rating)) {
	  if (($prev_rating['Rating']['rate'] == 0 && $rating == -1) || ($prev_rating['Rating']['rate'] == 1 && $rating == 1)) {
		// Same rating as last time, do nothing
	  } else {
		// User is changing their rating
		if ($rating == 1) {
		  $likes++;
		  $dislikes--;
		}
		if ($rating == -1) {
		  $likes--;
		  $dislikes++;
		}
		$prev_rating['Rating']['rate'] = ($rating == 1);
		$this->Video->Rating->save($prev_rating);
	  }
	} else {
	  if ($rating == 1) {
		$likes++;
	  }
	  if ($rating == -1) {
		$dislikes++;
	  }
	  $this->Video->Rating->create();
	  $rating = array('Rating' => array('user_id' => $this->Auth->user('id'),
										'video_id' => $videoId,
										'rate' => ($rating == 1)));
	  $this->Video->Rating->save($rating);
	}
	$this->Video->set('like', $likes);
	$this->Video->set('dislike', $dislikes);
	$this->Video->save();

	if ($dislikes == 0) {
	  return sprintf("%.02f", $likes);
	} else {
	  return sprintf("%.02f", $likes / $dislikes);
	}
  }


  /**
   * Delete a video.
   * Admins and the submitter are allowed to delete.
   */
  function delete($videoId) {
	$cur_video = $this->Video->read(null, $videoId);

	// Verify permissions
	if ($this->Auth->user('id') != $cur_video['User']['id'] && !$this->Auth->user('admin')) {
	  $this->Session->setFlash('Insufficient Privileges to delete this video!');
	  $this->redirect(array('action' => 'view', $this->Video->id));
	  return;
	}

	$this->Video->delete($videoId);
	foreach ($this->_getVideoFilenames($videoId) as $filename => $filetype) {
	  unlink(WWW_ROOT . $filename);
	}
	$this->Session->setFlash('Video deleted!');
	$this->redirect(array('action' => 'index'));
  }

  function setFeatured($videoID) {
	  //set featured video for user
  }
	
  /**
   * Private function to build filenames array.
   * Assumes $this->Video is set properly
   */
  private function _getVideoFilenames($videoId) {
	$video_basename = $videoId;
	$video_filenames = array(); // Entries have format filename=>filetype
	$video_filenames['/files/videos/' . $video_basename . '.mp4'] = ''; // Android 2.2 has a bug with recognizing the type attribute
	$video_filenames['/files/videos/' . $video_basename . '.ogv'] = 'video/ogg; codecs="theora, vorbis"';
	return $video_filenames;
  }

  /**
   * Private function to build flash filename
   */
  private function _getFlashFilename($videoId) {
	$video_basename = $videoId;
	return '/files/videos/' . $video_basename . '.flv';
  }
}

?>
