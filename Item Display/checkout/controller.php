<?php
	include '../model/model.php';
	
	function generate_left_info(){
		$categoryTotals = get_category_total();
		$NumOfFish 		= mysqli_num_rows($categoryTotals[0]);
		$NumOfReptile 	= mysqli_num_rows($categoryTotals[1]);
		$NumOfArachnid 	= mysqli_num_rows($categoryTotals[2]);	
		return array($NumOfFish, $NumOfReptile, $NumOfArachnid);
	}	

	function generate_item_data($cart){
		$database = mysqli_fetch_all(get_all());
		$foundData = array();
		// Only keep data related to cart from DB get 
		foreach($database as $value){
			if(isset($cart[$value[0]])){
				array_push($foundData, $value);
			}
		}
		// Construct final array to return with desired data only
		$finalData = array();
		foreach($cart as $key => $value){
			foreach($foundData as $b){
				if($key == $b[0]){
					// Generate price with quantity considered 
					$price = number_format(round(($b[3] * (1-$b[4])) * $cart[$key], 2), 2);
					// Item name, item quantity, item total price 
					$c = array($key, $cart[$key], $price);
					array_push($finalData, $c);
					break;
				}
			}
		}
		return $finalData;
	}

	function remove_item_from_cart($cart){
		if(isset($_POST['remove'])){
			// Remove from current array and save for future's 
			unset($cart[$_POST['item']]);
			$_SESSION['cart'] = json_encode($cart);
			return $cart;
		}
		else
			return $cart;
	}

	function formulate_total($itemDetails){
		$total = 0;
		if(sizeof($itemDetails) == 0){
			$total = 00.00;
		}
		else{
			foreach($itemDetails as $item){
				$total += $item[2];
			}
		}
		return $total;
	}
?>