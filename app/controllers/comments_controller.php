<?php
class CommentsController extends AppController {   
  
  var $name = 'Comments';  
  
		
  function index() {       
	$this->set('comments', $this->Comment->find('all'));    
  }

  function view($id = null) { 
	//$this->Comment->User->find('first', array('conditions' =>array('User.id' => $some_id)));
	$this->Comment->id = $id;       
	$this->set('comment', $this->Comment->read());   
  }
	
  function add($videoId) {
	if (!empty($this->data)) {
	  if ($this->Comment->save($this->data)) {
		//$this->Session->setFlash('Your comment has been saved.');
		$this->redirect(array('controller' => 'videos', 'action' => 'index'));
	  }
	}
  }

  /**
   * AJAX function to add a comment
   */
  function addAJAX($videoId) {
	if (!empty($this->data)) {
	  $this->data['Comment']['user_id'] = $this->Auth->user('id');
	  $this->data['Comment']['video_id'] = $videoId;
	  $this->data['Comment']['approved'] = false;
	  $this->data['Comment']['date'] = date('Y-m-d H:i:s');
	  if ($this->Comment->save($this->data)) {
		//$this->Session->setFlash('Your comment has been saved.');
		//$this->redirect(array('controller' => 'video', 'action' => 'updateComments'));
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
	}
  }
	
	
  function delete($id) {
	if ($this->Comment->delete($id)) {
	  $this->Session->setFlash('The comment with id: ' . $id . ' has been deleted.');
	  $this->redirect(array('controller' => 'videos', 'action' => 'index'));
	}
  }
	
  function updateComments($id) {
	//TODO finish this function
	echo $id;
  }
  //END functional comment controls
	
	
	
	
	
	
  function approve($id) {
	//TODO this needs to set comment.approved = 1;
	if ($this->Comment->delete($id)) {
	  $this->Session->setFlash('The comment with id: ' . $id . ' has been approved.');
	  $this->redirect(array('controller' => 'videos', 'action' => 'view'), $video_id);
	}
  }
}
?>
