<?php
session_start();
$pdo = new PDO('mysql:host=sql102.epizy.com;port=3306;dbname=epiz_26764786_XXX', 'epiz_26764786', 'URNgtR7eNZobf');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['signup'])){
    $stmt=$pdo->prepare("insert into users(firstname,lastname,username,password) values (:firstname
    ,:lastname,:username,:password)");
    $stmt->execute(
      array(
        ':firstname' => $_POST['firstname'],
        ':lastname' => $_POST['lastname'],
        ':username' => $_POST['username'],
        ':password' => $_POST['password'],
        )
    );
  header("Location:index.php");
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
          <div class="container-fluid" id="form"style="margin-left:30%;margin-right:30%;max-width:40%;
                background-color: aliceblue;padding:40px;border-radius:10px;margin-top:57px;
                margin-bottom:56px;">
    <form method="POST">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationServer01">First name</label>
      <input type="text" class="form-control " name="firstname" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationServer02">Last name</label>
      <input type="text" class="form-control" name="lastname" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationServer03">User Name</label>
      <input type="email" class="form-control"  name="username" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationServer03">Set Password</label>
      <input type="password" class="form-control " name="password" required>
    </div>
    
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input " type="checkbox" value="" id="invalidCheck3" required>
      <label class="form-check-label" for="invalidCheck3">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit" name="signup">Sign Up</button>
 
</form>

    </div>
    
          </div> 
        
          <footer class="panel-footer" id="foot">
            <div class="container"></div>
              <div style="text-align: center;">
                This application is developed by: <br>C. Bindhu Madhava Varma - 19BCD7116.
                <br>P. Krishna Dheeraj - 19BCN7030 <br>B. Mohan Srinivasa Sarma - 19BCN7015
                <br>CH. Sesha Pranav - 19BCN7190
              </div>  
              <hr>
              <div class=" col-sm-12" style="text-align: center;" >&copy; Copyright Bindhu Madhava Varma 2020 <br>All Rights reserved &copy;2020.</div>
            </div>
          </footer>
          <script src="jquery-1.11.3.min.js"></script>
          <script src="js/bootstrap.min.js"></script>
        </body>
        </html>
    </body>
</html>