<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include('./connection.php');
  $email = mysqli_real_escape_string($conn, trim($_POST['email']));
  $password = trim($_POST['password']);
  $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
  }

  $user = mysqli_fetch_assoc($result);

  if ($user) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];

    if ($user['role'] == 'teacher') {
      header('Location: teacher_panel.php');
    } else if ($user['role'] == 'admin') {
      header('Location: admin_dashboard.php');
    }
    exit();
  } else {
    $error_message = 'Invalid email or password';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
        <h3 class="text-center text-white pt-5">Login form</h3>
        <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
      <?php } ?>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="POST">
                      <label>Email:</label>
                      <input type="email" name="email" required><br><br>
                      <label>Password:</label>
                      <input type="password" name="password" required><br><br>
                      <input type="submit" value="Login">
                    </form>
                     
                      <br>
                      <p>Don't have an account? <a href="registration.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
