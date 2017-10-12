<?php
  $mysql_host = "127.0.0.1";
  $mysql_user = "root";
  $mysql_pass = "";
  $mysql_db = "general_hospital";

  $connect = new mysqli ($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

  if($connect -> connect_error){
    die("Could not connect: " . mysqli_connect_error());
  }

  if(isset($_POST['login'])){
    $username = $conn -> real_escape_string(trim($_POST['username']));
    $password = $conn -> real_escape_string(trim($_POST['password']));
    $query = $conn -> query("SELECT signup_id, signup_username, signup_password FROM signup WHERE signup_username = $username");
    $row = $query -> fetch_array();

    if($password == $row['signup_password']){
      $_SESSION['usersession'] = $row['signup_id'];
    }

    else{
      $msg = "<div class = 'alert alert-danger'>
      &nbsp; Username or password invalid
      </div>";
    }

    else if(isset($_POST['signup'])){
      $username = $conn -> real_escape_string(trim($_POST['username']));
      $email = $conn -> real_escape_string(trim($_POST['email']));
      $password = $conn -> real_escape_string(trim($_POST['password']));

      $checkmail = $conn->query("SELECT sign_email FROM signup WHERE signup_email = '$email'");
      $count = $checkmail->numrows;

      if($count == 0){
        $query = "INSERT INTO signup (signup_username, signup_email, signup_password) Values ('$username, $email, $password')";

        if($conn->query($query)){
          $msg = "<div class = 'alert alert-success'>&nbsp; Successfully registered
          </div>";
        }

        else{
          $msg = "<div class = 'alert alert-success'>&nbsp; Error while registered
          </div>"
        }
      else{
        $msg = "<div class='alert alert-danger'>&nbsp; Sorry email already taken</div>";
      }
      }
    }

    $conn->close();
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

    <title>Hospital Management System</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="" method="post">
                    <h1><i class="fa fa-hospital-o"></i> General Hospital </h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="username" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="" />
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" name="login" value="Login" href="plain_page.html"></input>
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

                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form action="" method="post">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" name="email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="" />
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" name="signup" value="Submit" href="index.html"></input>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
