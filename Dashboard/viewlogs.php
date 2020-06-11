<!DOCTYPE html>
<html lang="en" >
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
  <style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even){background-color: #f2f2f2}
  tr:nth-child(odd){background-color: #ffffff}

  th {
    background-color: #21242F;
    color: white;
  }

  .p {
    color:white;
  }
</style>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Zzztructure</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="content2">

  <h2 style="color:white;">Logs</h2><br>

  <table>
    <thead>
      <tr>
        <th>Log Id</th>
        <th>Card Id</th>
        <th>Log Date</th>
      </tr>
    <thead>

    <tbody id="logs">
    </tbody>
  </table>


<form action="timers.php" method="POST" id="alarms">
<div class="inputholder">
<div class="field">
<p id="p" style="color:white;">go to bed: <input type="datetime-local" name="gotobed" value="2020-06-08T23:30" id="gotobed"></p>
</div><br>
<div class="field">
<p id="p" style="color:white;">alarm: <input type="datetime-local" name="alarm" value="2020-07-08T09:00" id="alarm"></p>
</div>
<p id="gotobed-display" style="color:white;"></p>
<p id="alarm-display" style="color:white;"></p>
</div>

        
<button type="submit" name="submit" value="Submit">Set time</button

</form>


<?php 




?>




  <script type="text/javascript">

    $(document).ready(function(){
      function showData()
      { 
        $.ajax({

          url: 'log.php',
          type: 'POST',
          data: {action : 'showLogs'},
          dataType: 'html',
          success: function(result)
          {
            $('#logs').html(result);
          },
          error: function()
          {
            alert("Failed to fetch logs!");
          }
        })
      }

      
        
            $('#alarms').submit(event => {
                event.preventDefault(); // stop met herladen

                $.ajax({
                    url: 'timers.php',
                    method: 'POST',
                    data: { 
                    // gotobed: $('#gotobed').val(),
                    // alarm:  $('#alarm').val()
                    gotobed: +new Date($('#gotobed').val()),
                    alarm: +new Date($('#alarm').val())
                    },
                    dataType: "text",
                    success: data => {
                        console.log(data);
                        var times = data.split(',');
                        times = times.map(time => {
                          time = new Date(parseInt(time.substr(0, time.length - 3)) * 1000);
                          return time.toLocaleString('nl-NL');
                        });
                        $('#gotobed-display').html('Succes! Go to bed tijd opgeslagen: ' + times[0]);
                        $('#alarm-display').html('Succes! alarm tijd opgeslagen: ' + times[1]);
                    }
                });
            });
       
    


        
     

      //Fetch rfid logs in database every 2.5 seconds
      setInterval(function(){ showData(); }, 1000);
    });



  </script>
  </content>
</body>
</html>
