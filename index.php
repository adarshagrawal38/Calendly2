<!DOCTYPE html>
<?php
   include("./config.php");
   session_start();
   if (isset($_SESSION['user_id'])) {
     //echo "UserId {$_SESSION['user_id']}";
     header("Location: welcome.php");
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $email = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT user_id FROM user WHERE user_email= '$email' and user_password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
      // $sql = "SELECT user_id FROM user order by user_id desc limit 1";
      // $result = $db->query($sql);
      //
      // $user_id = 0;
      // if ($result->num_rows > 0) {
      //   // output data of each row
      //   while($row = $result->fetch_assoc()) {
      //     echo "id: " . $row["user_id"];
      //     $user_id = $row["user_id"];
      //   }
      if($count == 1) {
         $_SESSION['user_id'] = $row['user_id'];
         header("location: ./welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
         echo "<script>alert('Invalid login!');</script>";
      }
   }
?>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->

    <link rel="stylesheet" href="./css/style2.css">

    <meta charset="utf-8">
    <title>Calendely</title>
  </head>
  <body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" action = "" method = "post">
              <div class="form-label-group">

                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail" class="form-control-label">Email address</label>

              </div>

              <div class="form-label-group">

                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                  <label for="inputPassword" class="form-control-label">Password</label>
              </div>
              <br>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <hr class="my-4">

              <a href="./register.php" class="btn btn-lg btn-secondary btn-block text-uppercase">Register</a>
              <!-- <button class="btn btn-lg btn-secondary btn-block text-uppercase" type="button">Register</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</html>
