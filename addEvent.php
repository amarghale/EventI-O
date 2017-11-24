<?php
require_once('bdd.php');
ob_start();

if (isset($_POST['title']) &&isset($_POST['venue']) && isset($_POST['lecturer'])&& isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['categories']))
{
	$title = $_POST['title'];
        $venue = $_POST['venue'];
        $lecturer = $_POST['lecturer'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
        $category = $_POST['categories'];
	$sql = "INSERT INTO events(title, venue, lecturer, start, end, color, categories) values ('$title', '$venue' , '$lecturer' , '$start', '$end', '$color','$category')";		
	echo $sql;	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	ob_end_flush();
?>
