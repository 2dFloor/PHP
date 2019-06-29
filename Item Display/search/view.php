<?php
	session_start();
	include 'controller.php';

	test_url_integrity();

	// Fill left panel information 
	$leftData = generate_left_info();
	$NumOfFish		= $leftData[0];
	$NumOfReptile 	= $leftData[1];
	$NumOfArachnid	= $leftData[2];

	// Get data for items 
	$itemData = generate_item_info();

	// Only display 8 maximum per page
	$indx 	= 0;
	$max	= $_GET['page'] * 8;

	// Create the pagination section
	$pages 			= generate_pagination($NumOfFish, $NumOfReptile, $NumOfArachnid);
	$currentPage 	= $_GET['page'];

	// Cookie handling
	create_cookie_cart();
	$result = add_item_to_cart();

	$cartNum = total_items_in_cart();
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
			.item-pic-frame{
				width: 250px;
				height: 230px;
				border: 1px solid #800;
				margin: 4px;
				float: left;
			}
			.pic{
				width: 250px;
				height: 230px;
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
			.add{
				margin-top: 20px;
				margin-left: 8px;
				color: #800;
				background-color: transparent;
				border: 0;
				cursor: pointer;
				border: 1px solid #fca;
				font-weight: bold;
			}
			.add:hover{
				border: 1px solid #800;
			}
			.add:focus{
				outline-width: 0;
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
				margin: 0 auto;
				font-family: sans-serif;
			}
			.pag-item{
				text-decoration: none;
				color: black;
				font-size: 20px;
				margin: 4px;
			}
			.pag-active{
				color: black;
				text-decoration: underline;
				pointer-events: none;
				cursor: default;
			}
			#filter-box{
				font-size: 20px;
				margin-top: 20px;
				color: #800;
			}
			#filter-title{
				font-size: 30px;
				font-family: sans-serif;
				font-weight: bold;
				text-decoration: underline;
			}
			.filter-label{
				font-size: 20px;
				font-family: sans-serif;
				text-decoration: none;
			}
			#filter-btn{
				margin-top: 14px;
				margin-left: 4px;
			}
			.error{
				position: fixed;
				width: 600px;
				text-align: center;
				z-index: 5;
				margin: 0 auto;
				left: 0;
    			right: 0;
    			top: 0;
    			font-size: 26px;
			}
			.green{
				background-color: #3B5323;
				border: 2px solid white;
				border-top: 0;
				color: white;
			}
			.red{
				background-color: #CD5C5C;
				border: 2px solid black;
				border-top: 0;
				color: black;				
			}
		</style>
		<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous">
		</script>
		<script>
			$(window).on('load', function(){
				// Fade out error message 
				$('.error').delay(3000).fadeOut('fast');
			});
		</script>
	</head>
	<body> 
		<?php
			if(is_null($result)){
				// Do nothing
			}
			else if($result == true)
				echo "<div class='error green'>Successfully Added To Cart!</div>";
			else
				echo "<div class='error red'>Failed To Add To Cart. Enter A Valid Quantity.</div>";
		?>
		<div id='container'>
			<div id='left'>
				<a id='home' href='../home/view.php'>Home</a>
				<h1 style="margin-top: 90px;">Pets</h1>
				<?php
					echo "<a href='../search/view.php?category=fish&page=1&sort=" . $_GET['sort'] . "' class='categories'>Fishes(" . $NumOfFish . ")</a>";
					echo "<a href='../search/view.php?category=reptile&page=1&sort=" . $_GET['sort'] . "'class='categories'>Reptiles(" . $NumOfReptile . ")</a>";
					echo "<a href='../search/view.php?category=arachnid&page=1&sort=" . $_GET['sort'] . "'class='categories'>Arachnids(" . $NumOfArachnid . ")</a>";
				?>
				<form id='filter-box' action="" method="get">
					<span id='filter-title'>Sort by:</span>
					<input type="hidden" name="category" <?php echo "value='" . $_GET['category'] . "'"?> /> 
					<input type="hidden" name="page" value="1">
					<div>
						<input type="radio" name="sort" value="1" <?php if($_GET['sort'] == 1) echo "checked";?> >
						<label class='filter-label'>Alphabetically</label>
					</div>
					<div>
						<input type="radio" name="sort" value="0" <?php if($_GET['sort'] == 0) echo "checked";?> >
						<label class='filter-label'>Random</label>					
					</div>	
					<div>
						<input type="radio" name="sort" value="2" <?php if($_GET['sort'] == 2) echo "checked";?> >
						<label class='filter-label'>Price</label>					
					</div>
					<input id='filter-btn' class='add' type='submit' value='Update'>
				</form>				
			</div>
			<div id='right'>
				<div id='upper'>My Pet Shop</div>
				<a id='cart' href='../checkout/view.php'>CART <?php echo $cartNum?></a>
				<?php 
				while($row = $itemData->fetch_array()){
					if($max-8 <= $indx && $indx < $max){
						echo "<div id='lower'>";
							echo "<div class='item-title'>" . $row['Name'] . "</div>";
							echo "<div class='item-pic-frame'><img class='pic' src='../resources/" . $_GET['category'] ."/" . $row['Picture'] . "'></div>";
							echo "<div class='item-detail'>";
								echo "<span class='item-info'>Description: " . $row['Description'] ."</span>";
								echo "<span class='item-info'>List Price: $" . $row['Price'] . "</span>";
								echo "<span class='item-info'>Discount: " . $row['Discount'] * 100 . "%</span>";
								echo "<span class='item-info'>Your Price: $" . number_format(round($row['Price'] * (1-$row['Discount']), 2), 2) ."</span>";
								echo "<form method='post' action=''>";
									echo "<span class='item-info'>Quantity:</span><input id='quantity' type='text' name='quantity'><br>";
									echo "<input type='hidden' name='title' value='" . $row['Name'] . "'>";
									echo "<input class='add' value='Add to Cart' type='submit' name='addToCart'>";
								echo "</form>";
							echo "</div>";
						echo "</div>";
					}
					$indx++;
				}
				?>
				<div id='pag-tainer'>
					<?php 
					for($x=1; $x<=$pages; $x++){
						if($x == $currentPage){
							echo "<a class='pag-item pag-active' href=''>" . $x ."</a>";
						}
						else{
							echo "<a class='pag-item' href='view.php?category=" . $_GET['category'] . '&page=' . $x . "&sort=" . $_GET['sort'] . "'>" . $x . "</a>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>