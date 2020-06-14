<?php
 include("config.php");
 session_start();
  // $username = "Adarsh";
  // $selectedDate = "2020-06-18";
  // $selTime = "09";
  // $user_id = 7;
  // $nameOfDay = date('l', strtotime($selectedDate));
  // $displayTime = date('h.i', strtotime($selTime));
  // $formatedDate = date('F d, Y', strtotime($selectedDate));

  $username = "";
  $selectedDate = "";
  $selTime = "";
  $user_id = 0;
  $nameOfDay = "";
  $displayTime = "";
  $formatedDate = "";
  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET['user_name'];
    $user_id = $_GET['user_id'];
    $selTime = $_GET['time'];
    $selectedDate = $_GET['seldate'];

    $_SESSION['user_name'] = $username;
    $_SESSION['selTime'] = $selTime;
    $_SESSION['selectedDate'] = $selectedDate;
    $_SESSION['user_id'] = $user_id;

    $nameOfDay = date('l', strtotime($selectedDate));
    //echo $selTime.":00";
    $displayTime = date('h.i A', strtotime($selTime.":00"));
    //echo $displayTime;

    $formatedDate = date('F d, Y', strtotime($selectedDate));
  }


  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $selTime =  $_SESSION['selTime'] ;
    $selectedDate = $_SESSION['selectedDate'];

    $client_name = $_POST['client_name'];
    $client_email = $_POST['email'];
    $description = $_POST['description'];

    echo "<br>Name: " . $client_name;
    //Booking a Slot for Your
    $sql = "INSERT INTO `meetings`(`user_id`, `meeting_date`, `meeting_time`, `client_name`, `client_email`, `description`) VALUES
            ({$user_id}, '{$selectedDate}', '{$selTime}:00:00', '{$client_name}', '{$client_email}', '{$description}')";
    echo "<br>Sql " . $sql;
    if ($db->query($sql) === TRUE) {
      $_SESSION['selTime'] = $selTime;
      $_SESSION['selectedDate'] = $selectedDate;
      //selTime=09&selectedDate=2020-01-12
        header("Location: confirmPage.php?selTime=".$selTime."&selectedDate=".$selectedDate);

      echo "record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }


  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="/css/booking.css">
   <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
   <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->

    <title>Booking</title>
  </head>
  <body style="background-color: #353943;">
    <div class="container align-self-center" style="margin-top: 10%;">
      <div class="card">
        <h5 class="card-header">Meeting Details</h5>
        <div class="card-body">
          <h5 class="card-title"> <?php echo $username; ?> </h5>

          <div class="row">
            <div class="col-2">
                <p class="card-text"> <img src="https://bks-partners.com/wp-content/uploads/2018/03/Clock-Grey.png" style="height:13px;width: 13px;padding-right: 5px;">1 hr Meeting </p>
                <strong> <?php echo $displayTime.""; ?> </strong> <br>
                <?php echo $nameOfDay; ?> <br>
                <strong> <?php echo $formatedDate; ?> </strong>
            </div>

            <div class="col-7">
              <div class="form-group">
                <form class="from-group" action="" method="post">
                  <p class="card-text">Name</p>
                  <input type="text" class="form-control" id="client_name" name="client_name" required> <br>
                  <p class="card-text">Email</p>
                    <input class="form-control" type="email" id="email" name="email" required> <br>
                    <p class="card-text">Please share any thing wchich would be helpfull for prepare for meeting</p>
                      <input class="form-control" type="text-area" id="description" name="description"> <br>
                    <button type="submit" class="btn btn-primary" name="button">Confirm</button>
                </div>
                </form>

              </div>


            <div class="col-auto">
              <!-- Display avialable days and time -->
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
       $("#datePicker").datepicker({
           minDate: 0;
       });
   });

</script>

  </body>
</html>
