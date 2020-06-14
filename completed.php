<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
   <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
   <link rel="stylesheet" href="./css/welcomeStyle.css">
    <title>Calendely</title>
  </head>
  <body >

    <div class="container">
      <div class="topnav">
        <a  href="./welcome.php">Upcomming</a>
        <a class="active" href="./completed.php">Completed</a>
          <a href="./logout.php">LogOut</a>
      </div>
      <div class="jumbotron">
        <h1>Completed List</h1>
        <p>Below list contain all up Completed meetings</p>
        <p>Your URL: http://localhost/celendly/booking.php?user_id=<?php echo $user_id; ?></p>
      </div>
      <?php
      include("./config.php");

      $sql = "SELECT DATEDIFF(`meeting_date`, now()) AS 'DateDiff', TIMESTAMPDIFF(MINUTE,now() , `meeting_time`) AS 'timeDiff', `meeting_id`, `user_id`, `meeting_date`, `meeting_time`, `client_name`, `client_email`, `description` FROM `meetings` WHERE user_id = {$user_id} and(DATEDIFF(`meeting_date`, now()) < 0 OR (DATEDIFF(`meeting_date`, now()) = 0 and TIMESTAMPDIFF(MINUTE,now() , `meeting_time`) < 0))";
      //echo $sql;
      $result = mysqli_query($db,$sql);
      while($row = $result->fetch_assoc()) {
       ?>
      <div class="card">
        <h5 class="card-header"> <?php $selectedDate = $row['meeting_date'];
        $nameOfDay = date('l', strtotime($selectedDate));
        $formatedDate = date('d F, Y', strtotime($selectedDate));
         echo $nameOfDay.", ".$formatedDate; ?> </h5>

         <div class="card-body">
         <div class="row">
           <div class="col-5">
             <p class="card-text" style="color: green;"><strong> <?php
             $selTime = $row['meeting_time'];
             //echo strtotime(substr($selTime, 0, 5));
             $displayTime = date('h.i A', strtotime($selTime));
             echo $displayTime; ?> </strong> </p>
           </div>
           <div class="col-auto">
             <h5 class="card-title"><strong> <?php
           echo $row['client_name']; ?> </strong></h5>
             <p class="card-text"> <?php echo $row['client_email']; ?> </p>
               <p class="card-text"> <?php echo $row['description']; ?> </p>
           </div>

         </div>
         </div>
      </div>
      <br>
    <?php } ?>

    </div>


    <!-- <h1>Welcome User</h1> -->
    <?php
      //print_r($_SESSION['user_id']);
    ?>

  </body>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</html>
