<?php session_start();?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <title>TripleD Market</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="js/script_ajax.js" language="javascript" ></script>
  </head>
  <body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="img/logo.jpg" width="40" height="32" style="margin-right: 10px">
        <span class="fs-4">TripleD Market</span>
      </a>

      <div>
      </div>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
        <?php if (!isset($_SESSION["is-login"])){
        echo '<li class="nav-item"><a href="login.php" class="nav-link" aria-current="page">Login</a></li>
        <li class="nav-item"><a href="signup.php" class="nav-link" aria-current="page">Sign Up</a></li>';
        }
        if (isset($_SESSION["is-login"])){
          echo '<li class="nav-item"><a href="account.php" class="nav-link" aria-page="page">Account</a></li>';
          echo '<li class="nav-item"><a href="stocks.php" class="nav-link" aria-page="page">Stocks</a></li>';
          echo '<li class="nav-item"><a href="includes/logout.inc.php" class="nav-link" aria-page="page">Log Out</a></li>';
        }
         ?>
      </ul>
    </header>
  </div>
  <div class="px-4 py-5 my-5 text-center">
      <h1 class="display-5 fw-bold">TripleD Market</h1>
      <div class="col-lg-6 mx-auto">
        <?php if (!isset($_SESSION["is-login"])){
                            echo'
        <p class="lead mb-4">Please register or log in to your account.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <a href="login.php"><button type="button" class="btn btn-primary btn-lg px-4 gap-3">Login</button></a>
          <a href="signup.php"><button type="button" class="btn btn-outline-secondary btn-lg px-4">Sign up</button></a>
          </div>';
        }
        if (isset($_SESSION["is-login"])){
                            echo '
          <p class="lead mb-4">Your personal account and a list of stocks available in the top menu.</p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <a href="account.php"><button type="button" class="btn btn-primary btn-lg px-4 gap-3">Open My Account</button></a>
          </div>';
                          }
        ?>
      </div>
    </div>
  </body>
</html>
