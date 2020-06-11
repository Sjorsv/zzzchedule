<?php
    include 'connect.php';
    $nu = time();
    $selectStmt = $conn->query("SELECT * FROM `alarms` ORDER BY id DESC LIMIT 1");
	$result = $selectStmt->fetch(PDO::FETCH_ASSOC);	
    $alarmtime = substr($result['alarmtime'], 0, strlen($result['alarmtime']) - 3);
    
    echo intval($alarmtime < $nu);
    // echo intval($nu >= $alarmtime);
    
    // var_dump($alarmtime < $nu);
    // echo $alarmtime;
    // echo "<br/>";
    // echo $nu;
