<?php
session_start();
$pdo = new PDO('mysql:host=sql102.epizy.com;port=3306;dbname=epiz_26764786_XXX', 'epiz_26764786', 'URNgtR7eNZobf');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['signup'])){header("location:signup.php");}
if(isset($_POST['login'])){
  $stmt=$pdo->query("select * from users");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['username']===$_POST['username'] && $row['password']===$_POST['password']){
      $_SESSION['user_id']=$row['user_id'];
      $_SESSION['name']=$row['firstname']." ".$row['lastname'];
      $_SESSION['username']=$row['username'];
      header("Location:logged_index.php");
      return;
    }
  }
  $_SESSION['login_error']='Invalid Username or Password';
      header("Location:index.php");
      return;
}

?>
<html>
  <head>
    <title>Secure Chat</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="nvbr">
      <a class="navbar-brand" href="index.php" style="color: rgb(14, 165, 14);">
      <img src="Untitled.png" width="45" height="45" class="d-inline-block align-top" alt="">    Secure Chat</a>
      <span class="navbar-text" style="font-size: 18px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
                  <ul class="navbar-nav mr-auto" id="menuoptions">
                    <li class="nav-item active">
                      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                  </ul>
                  
                </div>
            </span>
    </nav>
        
          <div class="container-fluid" id=contents>
            <span><?php
              if(isset($_SESSION['user_id'])==false){
                echo'
                <div style="margin-left:30%;margin-right:30%;background-color: aliceblue;padding:40px;border-radius:10px;margin-top:120px;
                margin-bottom:120px;">
                <form method="POST">
                <div class="form-group">
                ';
                if(isset($_SESSION['login_error'])){
                  echo'<div style="color:red">'.$_SESSION['login_error'].'</div>';
                  unset($_SESSION['login_error']);
                }
                echo'
                <label for="exampleInputEmail1">Secure Chat Username</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
          </div> 
          <button type="submit" class="btn btn-primary" name="login">Login</button>
          <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
          </form></div>';
            }else{header("Location:logged_index.php");return;}
            ?></span>
          </div> 
        
          <footer class="panel-footer" id="foot">
            <div class="container"></div>
              <div style="text-align: center;">
                This application is developed by: C. Bindhu Madhava Varma - 19BCD7116.
                P. Krishna Dheeraj - 19BCN7030 B. Mohan Srinivasa Sarma - 19BCN7015
                CH. Sesha Pranav - 19BCN7190
              </div>  
              <hr>
              <div class=" col-sm-12" style="text-align: center;" >&copy; Copyright Secure Chat 2020 <br>All Rights reserved &copy;2020.</div>
            </div>
          </footer>
          <script src="jquery-1.11.3.min.js"></script>
          <script src="js/bootstrap.min.js"></script>
        </body>
        </html>
    </body>
</html>