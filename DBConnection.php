<?php
$database = "mysql:host = localhost; dbname=id3675237_full_calendar";
$username = "id3675237_all41n12";
$password = "A35cobar";
try
{
    $db = new PDO($database , $username , $password);
} 
catch (Exception $ex) 
{
    $errorMessage = $ex->getMessage();
    echo "An error occured when trying to connect to the database";
}