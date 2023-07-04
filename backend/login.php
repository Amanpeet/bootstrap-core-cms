<?php
include('inc/loginator.php'); // Include Login Script
if ((isset($_SESSION['username']) != '')) {
  header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="amanz">

  <title>Custom Admin Template</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">

  <!-- core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link href="css/style-admin.css" rel="stylesheet">
</head>

<body class="bg-dark" style="background: url('img/bg-map.jpg'); background-size: cover;">
  <div class="container pt-5">
    <div class="row">
      <div class="col-lg-5 mx-auto">

        <div class="card mx-auto mt-lg-5">
          <div class="card-header text-center">
            <img class="w-50" src="img/logo.png" alt="">
            <h5><strong>ADMIN PANEL</strong></h5>
          </div>
          <div class="card-body">
            <form method="post" action="">
              <div class="mb-3">
                <label for="username"><strong>Username</strong></label>
                <input class="form-control" name="username" id="username" type="text" placeholder="username" required>
              </div>
              <div class="mb-3">
                <label for="password"><strong>Password</strong></label>
                <input class="form-control" name="password" id="password" type="password" placeholder="password" required>
              </div>
              <div class="text-center pt-2">
                <input class="btn btn-dark btn-lg" type='submit' name='submit' value='LOGIN'>
              </div>
            </form>
            <div class="error text-danger text-center pt-3"><strong><?php echo $error; ?></strong></div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- core JavaScript-->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      console.log("login page scripts init");

    });
  </script>
</body>
</html>