<?php

class Category extends AppModel {
  var $name = 'Category';

  var $hasMany = 'Video';
}

?>