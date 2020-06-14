<!DOCTYPE html>
<?php
 include("config.php");
 session_start();
 $user_id = 0;
 $username = "";
$startTime = "";
$user_email = "";
$endTime = "";
?>
<?php
//echo "<br> UserId{$user_id}";
 if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
   $user_id = $_GET['user_id'];
   $_SESSION['user_id'] = $_GET['user_id'];
   $sql = "SELECT * FROM user WHERE user_id={$user_id}";

   $result = mysqli_query($db,$sql);
   $count = mysqli_num_rows($result);
   if ($count > 0) {
     // code...
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     $username = $row['user_name'];
     $_SESSION['user_name'] = $username;
    $startTime = $row['start_time'];
    $user_email = $row['user_email'];
    $Fs = date( 'h.i A', strtotime($startTime));
    $Fe = date( 'h.i A', strtotime($endTime) );
    $endTime = $row['end_time'];
  }else{
    echo "<h1> Invalid Url <h1>";
  }
 }
  else if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
    $booking_date =$_POST['datePicker'];
    echo $booking_date;
    $nowDate = date('Y-m-d');
    echo $nowDate;
    //Validating selected days
    $nameOfDay = date('D', strtotime($booking_date));
    echo "<br> selected day: {$nameOfDay}";

    $match = 0;
    $daySql = "SELECT * FROM avialable_day WHERE user_id= {$user_id}";
    $result = mysqli_query($db,$daySql);
     while ($row = $result->fetch_assoc()) {
       echo "<strong>{$row['day']}</strong><br>";
       if(strpos($row['day'], $nameOfDay) !== false) {
         echo "Word Found!";
         $match = 1;
       }
   }

       if ($match == 0) {
         $msg = "{$username}+is+not+availabel+on+{$nameOfDay}";
         header("location: booking.php?error={$msg}&user_id={$user_id}");
         echo "Invalid Day user_id";
       }else{
         echo "Valid day";
         //Validating Date SELECTed by user
         if ($nowDate > $booking_date){
           //When user select PAST Date
           $msg = "Please+select+todays+or+future+date";
           header("location: booking.php?error={$msg}&user_id={$user_id}");
           echo "Invalid Date";
         }
         else {
           //User have selected valid Date
           echo "Valid Date";
           //Validating time selected by user_id
           //$selTime = $_POST['timePicker'];
           $selTime = $_POST['time'];
           echo "<br>Selected Time {$selTime}" ;
           if ($selTime == '') {
             // Invalid Time
             $msg = "Please+select+time+in+which+{$username}+is+available";
             header("location: booking.php?error={$msg}&user_id={$user_id}");
             echo "<br>Invalid Time";
           }else {
             // Valid Times
             echo "<br>Valid Time {$selTime}" ;

             $onlyHrs = date( 'H', strtotime($selTime));

             echo "<br> Only hr {$onlyHrs}";
             $sql = "SELECT * FROM user WHERE user_id={$user_id}";
             $result = mysqli_query($db,$sql);
             $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              $startTime = $row['start_time'];
             $endTime = $row['end_time'];

             $startHrs = date('H', strtotime($startTime));
             $endHrs = date('H', strtotime($endTime));

             if ($onlyHrs>=$startHrs && $onlyHrs < $endHrs) {
               //check wheather slot is availabel
               echo "<br> Time in range";
               $bookSql = "Select * from meetings where meeting_date = '{$booking_date}' and meeting_time = '{$onlyHrs}:00' and user_id=".$_SESSION['user_id'];
               echo "<br> Sql {$bookSql}";

               $result = mysqli_query($db,$bookSql);
               $count = mysqli_num_rows($result);
               //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

               echo "<br> Count {$count}";
               //while ($row = $result->fetch_assoc())
               if ($count>0) {
                 // code...
                 $msg = "Sorry+Slot+not+available";
                 header("location: booking.php?error={$msg}&user_id={$user_id}");
                 echo "<br> Sorry Slot not available {$row['user_id']}";
               }else {
                 echo "<br> Hurray Slot available";
                 //proceed for booking2
                 header("location: booking2.php?seldate={$booking_date}&time={$onlyHrs}&user_id={$user_id}&user_name={$username}");
               }
             }else{
               $msg = "Please+select+time+in+which+{$username}+is+available";
               header("location: booking.php?error={$msg}&user_id={$user_id}");
               echo "<br> Time out of range";
               //header("Location: http://www.example.com/another-page.php");
             }

           }
       }

    }
  }else {
    echo "UnAuthurized Access";
    //header("location: error.php");
  }
  function get_times( $default = '09:00', $interval = '+60 minutes' ) {

   $output = '';
 include("config.php");
   $user_id = $_SESSION['user_id'];
   $sql = "SELECT * FROM user WHERE user_id={$user_id}";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $startTime = $row['start_time'];
   $endTime = $row['end_time'];
   echo "<br> Functtion startTime";

   $current = strtotime( '00:00' );
   $end = strtotime( '23:59' );

   while( $current <= $end ) {
       $time = date( 'H:i', $current );
       $sel = ( $time == $default ) ? ' selected' : '';

       $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
       $current = strtotime( $interval, $current );
   }

   return $output;
 }


 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="/css/booking.css">
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Booking</title>
  </head>
  <body>
    <div class="container align-self-center" style="margin-top: 10%;">
      <div class="card">
        <h5 class="card-header">Meeting Date</h5>
        <div class="card-body">
          <h5 class="card-title"> <?php echo $username; ?> </h5>

          <div class="row">
            <div class="col-2">
                <p class="card-text"> <img src="https://bks-partners.com/wp-content/uploads/2018/03/Clock-Grey.png" style="height:13px;width: 13px;padding-right: 5px;">1 hr Meeting </p>
                <p class="card-text">Timing</p>
                <strong> <?php echo $startTime.' - '.$endTime; ?> </strong>
            </div>

            <div class="col-7">
              <div class="form-group">
                <form class="from-group" action="" method="post">
                  <p class="card-text">Meeting Date</p>
                  <!--Date picker -->
                  <input type="date" class="form-control" name="datePicker" id="datePicker"> <br>
                  <p class="card-text">Meeting Time</p>
                  <select name="time" class="form-control"><?php echo get_times();?></select> <br>
                    <!-- <input class="form-control" type="time" id="timePicker" name="timePicker"> <br> -->
                    <button type="submit" class="btn btn-primary" name="button">Proceed</button>
                </div>
                </form>
              </div>


            <div class="col-auto">
            <p class="card-text">Available Day</p>
            <?php

             $daySql = "SELECT * FROM avialable_day WHERE user_id= {$user_id}";
             $result = mysqli_query($db,$daySql);
              while ($row = $result->fetch_assoc()) {
                echo "<strong>{$row['day']}</strong><br>";
              }
             ?>
            </div>
          </div>
          <?php  if (isset($_GET['error'])) {
              // code...
              echo '<p class="card-text" style="color:red;">'.$_GET['error'].'</p>';
              //echo "<script type='text/javascript'>$(document).ready(function(){('#myModal').modal('show');});</script>";
            }
           ?>

        </div>
      </div>
      </div>
    </div>

    <script type="text/javascript">
    $(function(){
     $('#datepicker').datepicker({
         startDate: '-0m'
         //endDate: '+2d'
     }).on('changeDate', function(ev){
         $('#sDate1').text($('#datepicker').data('date'));
         $('#datepicker').datepicker('hide');
     });

 });
</script>

  </body>
</html>
