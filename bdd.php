<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=event_i/o;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
