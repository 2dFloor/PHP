<?php
	session_start();
	include 'controller.php';

	$leftData = generate_left_info();
	$NumOfFish		= $leftData[0];
	$NumOfReptile 	= $leftData[1];
	$NumOfArachnid	= $leftData[2];	

	// Unpack cart 
	$cart = json_decode($_SESSION['cart'], true);

	// Delete item from cart if requested
	$cart = remove_item_from_cart($cart);

	// Use cart data to get item data from server
	$itemDetails = generate_item_data($cart); 

	$total = formulate_total($itemDetails);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PHP Project</title>
		<style type="text/css">
			body{
				background-color: #fffdd0;
			}
			#container{
				width: 1000px;
				border: 1px solid black;
				margin: 0 auto;
				display: flex;	
				flex-wrap: wrap;
				background-color: #fffdd0;
			}
			#left{
				width: 200px;
				display: flex;
				flex-direction: column;
				margin: 2px;
			}
			#right{
				width: 790px;
				height: 100%;
				display: flex;
				flex-direction: column;
				position: relative;
			}
			#upper{
				width: 792px;
				height: 100px;
				flex: none;
				text-align: center;
				font-size: 78px;
				color: white;
				background-color: #800;
				margin: 2px;
			}
			#lower{
				width: 100%;
				height: 300px;
				border: 1px solid #800;
				margin: 2px;
				background-color: white;
			}
			.categories{
				font-size: 20px;
				text-align: left;
				border: 0;
				padding: 0;
				color: #800;
				background-color: transparent;
				font-family: sans-serif;
				text-decoration: none;
			}
			.categories:hover{
				color: red;
				text-decoration: underline;
				cursor: pointer;
				font-family: sans-serif;
			}
			#home{
				font-size: 20px;
				background-color: #800;
				color: white;
				width: 55px;
				text-decoration: none;
				font-family: sans-serif;
			}
			h1{
				margin-bottom: 0;
				margin-top: 0;
				font-weight: bold;
				text-decoration: underline;
				color: #800;
				font-family: sans-serif;
			}
			.item-title{
				width: 100%;
				height: 50px;
				font-size: 46px;
				background-color: #fca;
				color: #800;
			}
			.item-pic{
				width: 250px;
				height: 230px;
				border: 1px solid #800;
				margin: 4px;
				float: left;
			}
			.item-detail{
				width: 500px;
				height: 230px;
				margin: 4px;
				float: left;
				display: flex;
				flex-direction: column;
				font-weight: bold;
				color: #800;
			}
			.item-info{
				margin: 8px;
			}
			#quantity{
				width: 40px;
				text-align: center;
				border: 1px solid #800;
			}
			#quantity:focus{
				outline-width: 0;
			}
			#add{
				margin-top: 20px;
				margin-left: 8px;
				color: #800;
				background-color: transparent;
				border: 0;
				cursor: pointer;
				border: 1px solid #fca;
				font-weight: bold;
			}
			#add:hover{
				border: 1px solid #800;
			}
			#add:focus{
				outline-width: 0;
				border: 1px solid #800;
			}
			#cart{
				position: absolute;
				right: 10px;
				top: 70px;
				font-family: sans-serif;
				font-weight: bold;
				color: white;
				font-size: 18px;
				text-decoration: none;
				border: 1px solid #800;
				padding: 2px;
			}
			#cart:hover{
				border: 1px solid white;
			}
			#pag-tainer{
				margin: 4px auto;
			}
			#home-pic{
				margin: 2px;
				width: 792px;
			}
			#cart-container{
				width: 100%;
				border: 1px solid #800;
				display: flex;
				flex-direction: column;
				background-color: white;
				margin: 2px;
				font-family: sans-serif;
				text-align: left;
				font-size: 38px;
				font-style: italic;
			}
			#my-cart{
				width: 100%;
				height: 50px;
				background-color: #800;
				color: white;
			}
			.even{
				height: 30px;
				background-color: white;
				display: flex;
				justify-content: space-between;
				align-items: center;
			}
			.odd{	
				background-color: #fca;
			}
			.ha{
				font-size: 12px;
				font-family: Lucida Sans Unicode;
				flex: 1;
			}
			.ha-btn{
				width: 100px;
				margin-bottom: 18px;
			}
			.add{
				margin-top: 20px;
				margin-left: 8px;
				color: #ab4c4c;
				background-color: transparent;
				border: 0;
				cursor: pointer;
				font-weight: bold;
				border-left: 1px solid #ab4c4c;
			}
			.add:hover{
				color: #800;
			}
			.add:focus{
				outline-width: 0;
			}
			#nothing{
				font-size: 30px;
				width: 100%;
				text-align: center;
				color: grey;
			}
			#detailBar{
				width: 100%;
				font-size: 18px;
				font-weight: bold;
				display: flex;
				justify-content: space-between;
				align-items: center;
				font-style: normal;
				background-color: #f3e5e5;
				color: #800;
			}
			.topBarChild{
				flex: 1;
			}
			.float-right{
				float: right;
				width: 102px;
			}
		</style>
	</head>
	<body>
		<div id='container'>
			<div id='left'>
				<a id='home' href='../home/view.php'>Home</a>
				<h1 style="margin-top: 90px;">Pets</h1>
				<a href='../search/view.php?category=fish&page=1&sort=0' class='categories'>Fishes(<?php echo $NumOfFish;?>)</a>
				<a href='../search/view.php?category=reptile&page=1&sort=0' class='categories'>Reptiles(<?php echo $NumOfReptile;?>)</a>
				<a href='../search/view.php?category=arachnid&page=1&sort=0' class='categories'>Arachnids(<?php echo $NumOfArachnid;?>)</a>
			</div>
			<div id='right'>
				<div id='upper'>My Pet Shop</div>
				<div id='cart-container'>
					<div id='my-cart'>Currently in My Cart</div>
						<?php
							if(sizeof($cart) == 0){
								echo "<div id='nothing'>";
									echo "Nothing!";
								echo "</div>";
							}
							else{
								echo "<div id='detailBar' style='border-bottom: 1px solid #800;'>";
									echo "<div class='topBarChild'>item (quantity)</div>";
									echo "<div class='topBarChild'>price</div>";
									echo "<div class='float-right'></div>";
								echo "</div>";

								$index = 0;
								foreach($itemDetails as $item){
									echo "<form class='even"; if($index % 2 != 0){echo " odd";} echo "' action='' method='post'>";
										echo "<div class='ha'>$item[0]($item[1])</div>";
										echo "<div class='ha'>$" . $item[2] . "</div>";
										echo "<input type='hidden' name='item' value='" . $item[0] . "'>";
										echo "<input class='add ha-btn' value='remove' type='submit' name='remove'>";
									echo "</form>";
									$index++;
								}

								echo "<div id='detailBar'>";
									echo "<div class='topBarChild' style='border-top: 1px solid #800;'>total: $"; echo $total; echo "</div>";
								echo "</div>";
							}
						?>
				</div>
			</div>
		</div>
	</body>
</html>