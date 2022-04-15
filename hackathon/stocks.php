<?php
    session_start();
    if (!isset($_SESSION["is-login"])){
        header("location: /login.php");
    }
?>
<?php
require 'db_conn.php';
?>
<?php
require 'view_text.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/api.js"></script>
    <script type="text/javascript" src="js/script_view.js"></script>
    <style>
      .main{
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        display: flex;
      }
    </style>
</head>
<body class="text-center">
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="img/logo.jpg" width="40" height="32" style="margin-right: 10px">
        <span class="fs-4">TripleD Market</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Home</a></li>
        <?php if (!isset($_SESSION["is-login"])){
        echo '<li class="nav-item"><a href="login.php" class="nav-link" aria-current="page">Login</a></li>
        <li class="nav-item"><a href="signup.php" class="nav-link" aria-current="page">Sign Up</a></li>';
        }
        if (isset($_SESSION["is-login"])){
          echo '<li class="nav-item"><a href="account.php" class="nav-link" aria-page="page">Account</a></li>';
          echo '<li class="nav-item"><a href="stocks.php" class="nav-link active" aria-page="page">Stocks</a></li>';
          echo '<li class="nav-item"><a href="includes/logout.inc.php" class="nav-link" aria-page="page">Log Out</a></li>';
        }
         ?>
      </ul>
    </header>
  </div>
<div class="main">
  <div id="StockList" style="margin-left: 50px; width: 10%;">
      <p>здесь должны были быть кнопки для переключения между акциями...</p>
      <p>мы не успели, но сделаем их позже...</p>
  </div>
  <div id="chartContainer" style="height: 450px; width: 50%; margin: 50px;"></div>
  <div id="Buy-Sell" style="margin-right: 100px;">
    <main class="form-signin">
      <div class="justify">
        <form  action="app/buy.php" method="post" style="max-width: 500px;
           margin-left: auto;
           margin-right: auto;">
           <?php $list = $conn->query("SELECT * FROM users WHERE id='{$_SESSION["user-id"]}'");?>
              <?php while($acc = $list->fetch(PDO::FETCH_ASSOC)) { ?>
                <h1 class="h3 mb-3 fw-normal">Your Balance: <?php echo $acc['account']; ?> rub.</h1>
                 <?php } ?>
                 <?php $ticker = 'SBER'; ?>
                 <?php $list = $conn->query("SELECT * FROM user_stock WHERE user_id='{$_SESSION["user-id"]}'
                   AND ticker='$ticker' ");
                   if ($list->rowCount() != 0){?>
                    <?php while($acc = $list->fetch(PDO::FETCH_ASSOC)) { ?>
                <h2 class="h3 mb-3 fw-normal">You have <?php echo $acc['amount']; ?> stocks of <?php echo $ticker; ?>.</h2>
              <?php } } else{ ?>
              <h2 class="h3 mb-3 fw-normal">You have 0 stocks of <?php echo $ticker; ?>.</h2>
            <?php } ?>
                <h2 class="h3 mb-3 fw-normal">Price of one stock: <p id="p" style="color: blue;"><span id="span"> rub.</span></p></h2>
            <div class="form-floating" style="margin: 10px">
              <input type="num_buy" class="form-control" class="<?php if($is_invalid) echo 'is-invalid"'; $_SESSION["is-invalid"] = false; ?>" name = "num_buy" placeholder="number">
              <label for="floatingPassword">Enter the number of stocks for buy</label>
            </div>
            <button class="w-100 btn btn-lg btn-success" type="submit">Buy</button>
            <input id="myPrice" type="hidden" name="price">
            <input id="myTicker" type="hidden" name="ticker">
          </form>

          <form  action="app/sell.php" method="post" style="max-width: 500px;
             margin-left: auto;
             margin-right: auto;">
              <div class="form-floating" style="margin: 10px">
                <input type="num_sell" class="form-control" class="<?php if($is_invalid) echo 'is-invalid"'; $_SESSION["is-invalid"] = false; ?>" name = "num_sell" placeholder="number">
                <label for="floatingPassword">Enter the number of stocks for sale</label>
              </div>
              <button class="w-100 btn btn-lg btn-danger" type="submit">Sell</button>
              <input id="myPrice2" type="hidden" name="price2">
              <input id="myTicker2" type="hidden" name="ticker2">
            </form>
      </div>
  </main>
  </div>
</div>
</body>
</html>
