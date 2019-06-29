<?php
	include '../model/model.php';

	function test_url_integrity(){
		$categories = array('fish', 'reptile', 'arachnid');
		$sort 		= array(0, 1, 2);
		if(!isset($_GET['category']) || !isset($_GET['page']) || !isset($_GET['sort'])){
			header('Location: ../home/view.php');
			exit();			
		}
		else if(!in_array($_GET['category'], $categories)){
			header('Location: ../home/view.php');
			exit();
		}	
		else if(!in_array($_GET['sort'], $sort)){
			header('Location: ../home/view.php');
			exit();
		}
	}

	function generate_item_info(){
		$category 	= $_GET['category'];
		$sort 		= $_GET['sort'];
		$data = get_items($category, $sort);
		return $data;
	}

	function generate_left_info(){
		$categoryTotals = get_category_total();
		$NumOfFish 		= mysqli_num_rows($categoryTotals[0]);
		$NumOfReptile 	= mysqli_num_rows($categoryTotals[1]);
		$NumOfArachnid 	= mysqli_num_rows($categoryTotals[2]);	
		return array($NumOfFish, $NumOfReptile, $NumOfArachnid);
	}
	function generate_pagination($fishTotal, $reptileTotal, $arachnidTotal){
		$category 	= $_GET['category'];

		if($category == 'fish'){
			$numOfPages = ceil($fishTotal / 8);
		}
		elseif ($category == 'reptile') {
			$numOfPages = ceil($reptileTotal / 8);
		}
		elseif ($category == 'arachnid') {
			$numOfPages = ceil($arachnidTotal / 8);
		}
		return $numOfPages;
	}

	function create_cookie_cart(){		
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = json_encode(array());
		}
	}	

	function add_item_to_cart(){
		if(isset($_POST['addToCart'])){
			if(is_numeric($_POST['quantity'])){
				$cart = json_decode($_SESSION['cart'], true);
				// Item is already in the cart, add new order to previous 
				if(array_key_exists($_POST['title'], $cart)){
					$cart[$_POST['title']] += intval($_POST['quantity']);
				}
				// No item existed before, create a new entry
				else{
					$cart[$_POST['title']] = intval($_POST['quantity']);
				}
				// Repack and save to session 
				$_SESSION['cart'] = json_encode($cart);
				return true;
			}
			else{
				return false;
			}
		}
		else
			return null;
	}

	function total_items_in_cart(){
		$cart 	= json_decode($_SESSION['cart'], true);
		$total 	= 0;
		if(isset($_SESSION['cart'])){
			foreach ($cart as $quantity) {
				$total += intval($quantity);
			}
			return $total;
		}
		else{
			return $total;
		}
	}
?>