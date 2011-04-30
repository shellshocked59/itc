<div id="nav_scrollbar" style="width:100%; height:195px; overflow:auto">			
		
	<?php for( $i=0; $i<16; $i+= 1) {
	
	echo "<div style='float: left; padding: 12.5px;'>";
	
	echo $this->data['Video']['title'];
	echo "<br />";
	echo $this->Html->image("nav_mockup.png", array( 'style' => 'width:200px; height:100',   "alt" => "Nav_Mockup",    'url' => array('controller' => 'videos', 'action' => 'view', 1))); 
	echo "<br />";
	echo "Uploaded by: <a href=user_view>//Alias</a> ";
	echo "<br />";
	echo $this->Time->timeAgoInWords($this->data['Video']['date']);
	
	echo "<span style='align:right'>. Avg. Rating: ";
	echo $this->data['Video']['avg_rating'];
	
	
	
	echo "</span></div>";
	
	}
	?>
		
	
<!-- repeater -->
<?php for( $i=0; $i<16; $i+= 1) {

echo "<li style='display: inline;
	float: left; padding: 12.5px; 
'>";

echo $this->data['Video']['title'];
echo "<br />";
echo $this->Html->image("nav_mockup.png", array( 'style' => 'width:200px; height:100',   "alt" => "Nav_Mockup",    'url' => array('controller' => 'videos', 'action' => 'view', 1))); 
echo "<br />";
echo "Uploaded by: <a href=user_view>//Alias</a> ";
echo "<br />";
echo $this->Time->timeAgoInWords($this->data['Video']['date']);

echo "<span style='align:right'>. Avg. Rating: ";
echo $this->data['Video']['avg_rating'];



echo "</span></li>";

}
?>
	


	</ul>
  </div>
</div>
