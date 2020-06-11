<?php

function alarm($data) {
    include('config.php');
    $query = mysqli_query($mysqli, "INSERT INTO alarms(gotobedtime, alarmtime) VALUES (" . $data['gotobed'] .", " . $data['alarm'] . ")");
    //echo  "INSERT INTO alarms(alarmtime, wakeuptime) VALUES (" . $data['gotobed'] . ", " . $data['alarm'] . ")";
    echo $data['gotobed'] . "," . $data['alarm'];
    // $rows = mysqli_num_rows($query);
  }


alarm ($_POST);
if (isset($_POST['submit'])){
    echo "gotobed".$_POST['gotobed'];
    echo "alarm".$_POST['alarm'];
}
