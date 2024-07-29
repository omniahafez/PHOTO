<?php
session_start();
// be sure user loggin
if(isset($_SESSION['login']) and $_SESSION['login'] == true){
  header('location: users.php');
  die();
}

include_once("../include/conn.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Handling user registration
if (isset($_POST["register"])) {
  try {
    $fullname = $_POST['fullname'];
    $user_name = $_POST["user_name"];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    // Inserting user data into database
    $sql = "INSERT INTO `users`(`fullname`, `user_name`, `password`, `email`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fullname, $user_name, $password, $email]);
    echo "Inserted Successfully";
    header("location: login.php");
            exit();
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
}

  // Handling user loggin

if (isset($_POST["login"])) {
    try {
      // IMPORT data from DB for enter username
      $sql = "SELECT `fullname`, `password` FROM users WHERE user_name = ? and active = ?";
      $user_name = $_POST["user_name"];
      $password = $_POST["password"];
      $active = 1;
      $stmt = $conn->prepare($sql);
      $stmt->execute([$user_name, $active]);
      echo "Inserted Successfully";
      // Checking if user exists
      if ($stmt->rowCount()) {
        $result = $stmt->fetch();
            $verify = password_verify($password, $result['password']); 
      
            // Print the result depending if they match 
            if ($verify) { 
                $_SESSION["login"] = true;
                $_SESSION["user_name"] = $user_name; // Store username in session
                header("location: users.php");
                  die();
            } else { 
                echo 'Incorrect Password!'; 
            }
          }else{
            echo "user not found";
          }
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Images Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="user_name" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="password" name="password"/>
              </div>
              <div>
              <input type="submit" name="login" value="login" class="btn btn-default submit">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-file-image-o"></i></i> Images Admin</h1>
                  <p>©2016 All Rights Reserved. Images Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="" method="post" >
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Fullname" required="" name="fullname" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="user_name" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
              
                <input type="submit" name="register" value="register" class="btn btn-default submit">
                
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-file-image-o"></i></i> Images Admin</h1>
                  <p>©2016 All Rights Reserved. Images Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
