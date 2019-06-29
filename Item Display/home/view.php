<?php
	session_start();
	include 'controller.php';

	$leftData = generate_left_info();
	$NumOfFish		= $leftData[0];
	$NumOfReptile 	= $leftData[1];
	$NumOfArachnid	= $leftData[2];	
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
			#pag-tainer{
				margin: 4px auto;
			}
			#home-pic{
				margin: 2px;
				width: 792px;
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
				<img id='home-pic' src="main.png">
			</div>
		</div>
	</body>
</html>