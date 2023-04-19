<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include('./connection.php');

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $role = 'teacher';
  $query = "INSERT INTO users (email, password, name, role) VALUES ('$email', '$password', '$name', '$role')";
  mysqli_query($conn, $query);
  header('Location: login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Registration</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

</head>
<style>
body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}

</style>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Teacher Registration</h3>
        <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
      <?php } ?>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="POST">
                    <label>Name:</label>
                    <input type="text" name="name" required><br><br>
               
                    <label>Email:</label>
                    <input type="email" name="email" required><br><br>
                    <label>Password:</label>
                    <input type="password" name="password" required><br><br>
                    <input type="submit" value="Register">
                    </form>
                     
                      <br>
                      <p>Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>