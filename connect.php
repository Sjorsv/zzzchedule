<?php
//date_default_timezone_set('');
$servername = 'localhost';
$username = 'sjorsplatjouw';
$password = 'quahShax6a';
$dbname = 'sjorsplatjouw';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage();
    }

