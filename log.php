<?php 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
	switch ($_POST['action']) {
		case 'insertRfIdLog':
		insertRfIdLog();
		break;


		case 'showLogs':
		showLogs();

		default:

		break;
	}
}


function insertRfIdLog() {
    include 'connect.php';
    $cardid = $_POST['cardid'];
    $time = time();
	
    $stmt = $conn->prepare("INSERT INTO `tbllogs`(`cardid`, `logdate`) VALUES (:card, :dt)");
    $stmt->bindParam(":card", $cardid);
    $stmt->bindParam(":dt", $time);
	$stmt->execute();
	$id = $conn->lastInsertId();

	
	// echo "success";
	$selectStmt = $conn->query("SELECT * FROM alarms");
	$result = $selectStmt->fetch(PDO::FETCH_ASSOC);	
	$gotobedtime = substr($result['gotobedtime'], 0, strlen($result['gotobedtime']) - 3);
	$alarmtime = substr($result['alarmtime'], 0, strlen($result['alarmtime']) - 3);

	if (($alarmtime <= $time)) {
		echo $buzzer;
		return;
	}
	
	if (($id % 2) == 0){
		echo $gotobedtime <= $time ? "Groen" : "Rood";
		// echo "inchecken";
		// var_dump($gotobedtime, $time);

	} else {
		echo $alarmtime > $time ? "Rood" : "Groen";
		// echo "uitchecken";
	}

	
	
}

function showLogs()
{
	include 'connect.php';

	$logs = $conn->query("SELECT * FROM `tbllogs`");
	while($r = $logs->fetch()){
		echo "<tr>";
		echo "<td>".$r['logid']."</td>";
		echo "<td>".$r['cardid']."</td>";
		$dateadded = date("F j, Y, g:i a", $r["logdate"]);
		echo "<td>".$dateadded."</td>";
		echo "</tr>";
	}
}

?>
