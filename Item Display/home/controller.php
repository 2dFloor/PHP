<?php
	include '../model/model.php';
	
	function generate_left_info(){
		$categoryTotals = get_category_total();
		$NumOfFish 		= mysqli_num_rows($categoryTotals[0]);
		$NumOfReptile 	= mysqli_num_rows($categoryTotals[1]);
		$NumOfArachnid 	= mysqli_num_rows($categoryTotals[2]);	
		return array($NumOfFish, $NumOfReptile, $NumOfArachnid);
	}	
?>