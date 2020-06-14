<?php
session_start();
  $username = $_SESSION['user_name'];
  $selTime = $_GET['selTime'];
  $selectedDate= $_GET['selectedDate'];
  $displayTime = date('h.i A', strtotime($selTime.":00"));
  //echo $displayTime;
  $nameOfDay = date('l', strtotime($selectedDate));
  $formatedDate = date('F d, Y', strtotime($selectedDate));
  $displayTime = $displayTime. ', '.$nameOfDay. ', '.$formatedDate;

  unset($_SESSION['user_id']);
   session_destroy();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="/css/booking.css">
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Confirm</title>
  </head>
  <body style="background-color: #353943;">
    <div class="container align-self-center" style="margin-top: 10%;">
      <div class="card">
        <h5 class="card-header">Confirmed</h5>
        <div class="card-body">
          <h5 class="card-title align-self-center">
<img src="https://bks-partners.com/wp-content/uploads/2018/03/Clock-Grey.png" style="height:13px;width: 13px;padding-right: 5px;">1 hr Meeting
            </h5>

          <div class="row">
            <div class="col-12">
                <p class="card-text"> <?php echo 'You are schedule with '.$username; ?> </p>
                <strong> <?php echo $displayTime.""; ?> </strong> <br>

            </div>
          </div>
        </div>
      </div>
      </div>

  </body>
</html>
