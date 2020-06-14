<!DOCTYPE html>
<?php

   session_start();
   include("config.php");
   $email = '';
   $pass = '';
   $name = '';

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $pass = mysqli_real_escape_string($db,$_POST['password']);
      $name= mysqli_real_escape_string($db,$_POST['name']);
      // $startTime = $_POST['startTime'];
      // $endTime = $_POST['endTime'];
      $startTime = $_POST['startTime'];
      $endTime = $_POST['endTime'];

      echo "<h3>{$startTime}, {$endTime} <h3>";
      if (strtotime($startTime) > strtotime($endTime)) {
        // code...
        header('Location: http://localhost/celendly/register.php?email='.$email.'&password='.$pass.'&name='.$name.'&error=End+Of+Time+is+less+then+start');
        //echo "<script>alert('Please Select Valid End Time')</script>";
        //echo "Invalid Time selection";
      }else {
        // code...
        echo "valid time selection";

      //INSERT INTO `user`(`user_email`, `user_password`, `start_time`, `end_time`) VALUES ('some@gmail.com', 'pass', '02:22', '14:03')
      $insertQuery  = "INSERT INTO `user`(`user_email`, `user_password`, `start_time`, `end_time`, `user_name`) VALUES ('{$email}',
         '{$pass}', '{$startTime}', '{$endTime}', '{$name}')";
      if ($db->query($insertQuery) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $sql = "SELECT user_id FROM user order by user_id desc limit 1";
      $result = $db->query($sql);

      $user_id = 0;
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "id: " . $row["user_id"];
          $user_id = $row["user_id"];
          $_SESSION['user_id'] = $row["user_id"];
        }
        if (isset($_POST['mon'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Monday')";
            $db->query($sql);
        }
        if (isset($_POST['tues'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Tuesday')";
            $db->query($sql);
        }
        if (isset($_POST['wed'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Wednessday')";
            $db->query($sql);
        }
        if (isset($_POST['thrus'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Thursday')";
            $db->query($sql);
        }
        if (isset($_POST['fri'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Friday')";
            $db->query($sql);
        }
        if (isset($_POST['sat'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Staturday')";
            $db->query($sql);
        }
        if (isset($_POST['sun'])) {
            $sql= "INSERT INTO avialable_day (user_id, day) VALUES({$user_id}, 'Sunday')";
            $db->query($sql);
        }

        // session_start
        //session_register("user_id");
        $_SESSION['user_id'] = $user_id;
        header("location: welcome.php");
      }
      }
    }



   function get_times( $default = '09:00', $interval = '+60 minutes' ) {

    $output = '';

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
    <link rel="stylesheet" href="./css/style2.css">
    <title>Calendely</title>
  </head>
  <body>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">

          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">

                <?php
                  if (isset($_GET['email'])) {
                    // code...
                    echo "<input value=".$_GET['email']." type='email' id='inputEmail' name='email' class='form-control' placeholder='Email address' required autofocus>";
                  }else {
                    echo '<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>';
                  }
                 ?>
                 <label for="inputEmail" class="form-control-label">Email address</label>

              </div>

              <div class="form-label-group">

                <?php
                  if (isset($_GET['password'])) {
                    // code...
                    echo "<input value=".$_GET['password']." type='password' id='inputPassword' name='password' class='form-control' placeholder='Password' required autofocus>";
                  }else {
                    echo '<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>';
                  }
                 ?>
                 <label for="inputPassword" class="form-control-label">Password</label>

              </div>
              <div class="form-label-group">

                <?php
                  if (isset($_GET['name'])) {
                    // code...
                    echo "<input value=".$_GET['name']." type='text' id='name' name='name' class='form-control' placeholder='Full Name' required autofocus>";
                  }else {
                    echo '<input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>';
                  }
                 ?>
                 <label for="name" class="form-control-label">Full Name</label>
              </div>
              <div class="">
                  <label for="startTime" class="form-control-label">Available start time</label>
                  <select name="startTime" class="form-control"><?php echo get_times();?></select>
                <!-- <input type="time" id="startTime" class="form-control" name="startTime" placeholder="Available start time Time" > -->
              </div>
              <div class="">
                <label for="endTime" class="form-control-label">Available end time</label>
                <select name="endTime" class="form-control"><?php echo get_times($default = '10:00');?></select>
                <!-- <input type="time" id="endTime" class="form-control" name="endTime" placeholder="Available end time Time" > -->
              </div>
              <div class="form-check">
                <input type="checkbox" name="mon" class="form-check-input" id="exampleCheck1" checked>
                <label class="form-check-label" for="exampleCheck1">Monday</label>
              </div>
              <div class="form-check">
                <input type="checkbox" name="tues" class="form-check-input" id="exampleCheck1" checked>
                <label class="form-check-label" for="exampleCheck1">Tuesday</label>
              </div>
              <div class="form-check">
                <input type="checkbox" name="wed" class="form-check-input" id="exampleCheck1" checked>
                <label class="form-check-label" for="exampleCheck1">Wednessday</label>
              </div>
              <div class="form-check">
                <input type="checkbox" name="thrus" class="form-check-input" id="exampleCheck1" checked>
                <label class="form-check-label" for="exampleCheck1">Thursday</label>
              </div>
              <div class="form-check">
                <input type="checkbox" name="fri" class="form-check-input" id="exampleCheck1" checked>
                <label class="form-check-label" for="exampleCheck1">Friday</label>
              </div>
              <div class="form-check">
                <input type="checkbox" name="sat" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Staturday</label>
              </div>
              <div class="form-check">
                <input type="checkbox" name="sun" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Sunday</label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
              <hr class="my-4">
            </form>
          <?php  if (isset($_GET['error'])) {
              // code...
              echo '<p style="color:red;">'.$_GET['error'].'</p>';
              //echo "<script type='text/javascript'>$(document).ready(function(){('#myModal').modal('show');});</script>";
            }
           ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</html>
