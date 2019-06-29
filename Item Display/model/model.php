<?php
	function connect_database(){
		$con = mysqli_connect("127.0.0.1", "root", "", "php_project");
		return $con;
	}

	function get_items($category, $sort){
		$con = connect_database();
		if ($category == 'fish' && $sort == 0){
			$result = $con->query("SELECT * FROM fish ORDER BY RAND()");
			return $result;
		}
		elseif ($category == 'fish' && $sort == 1){
			$result = $con->query("SELECT * FROM fish ORDER BY Name");
			return $result;
		}
		elseif ($category == 'fish' && $sort == 2){
			$result = $con->query("SELECT * FROM fish ORDER BY (Price * ( 1 - Discount))");
			return $result;
		}
		elseif ($category == 'reptile' && $sort == 0){
			$result = $con->query("SELECT * FROM reptile ORDER BY RAND()");
			return $result;
		}
		elseif ($category == 'reptile' && $sort == 1){
			$result = $con->query("SELECT * FROM reptile ORDER BY Name");
			return $result;
		}
		elseif ($category == 'reptile' && $sort == 2){
			$result = $con->query("SELECT * FROM reptile ORDER BY (Price * ( 1 - Discount))");
			return $result;
		}
		elseif ($category == 'arachnid' && $sort == 0){
			$result = $con->query("SELECT * FROM arachnid ORDER BY RAND()");
			return $result;
		}
		elseif ($category == 'arachnid' && $sort == 1){
			$result = $con->query("SELECT * FROM arachnid ORDER BY Name");
			return $result;
		}
		elseif ($category == 'arachnid' && $sort == 2){
			$result = $con->query("SELECT * FROM arachnid ORDER BY (Price * ( 1 - Discount))");
			return $result;
		}
	}

	function get_number_of_pages($category){
		// Figure out how many pages there are.
		$con = connect_database();
		$result = $con->query("SELECT * FROM $category");
		return $result;
	}

	function get_category_total(){
		$con = connect_database();
		$fishes 	= $con->query("SELECT * FROM fish");
		$reptiles 	= $con->query("SELECT * FROM reptile");
		$arachnids 	= $con->query("SELECT * FROM arachnid");
		return array($fishes, $reptiles, $arachnids);
	}

	function get_all(){
		$con = connect_database();
		$result = $con->query("SELECT * FROM fish UNION SELECT * FROM reptile UNION SELECT * FROM arachnid");
		return $result;
	}
?>
