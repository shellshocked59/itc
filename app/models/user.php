<?php

class User extends AppModel {
  var $name = 'User';

  var $hasMany = array('Video', 'Rating', 'Comment');
}

?>