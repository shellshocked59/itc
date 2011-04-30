<?php

class Video extends AppModel {
  var $name = 'Video';

  var $hasMany = array('Rating', 'Comment');
  var $belongsTo = array('User', 'Category');

  function afterFind($results, $primary=false) {
	if ($primary == true) {
	  foreach($results as &$result) {
		if (isset($result['Video']['dislike'])) {
		  if ($result['Video']['dislike'] == 0) {
			$result['Video']['avg_rating'] = sprintf("%0.2f", $result['Video']['like']);
		  } else {
			$result['Video']['avg_rating'] = sprintf("%0.2f", $result['Video']['like'] / $result['Video']['dislike']);
		  }
		}
	  }
	}
	return $results;
  }
}

?>
