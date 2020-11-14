<?php
session_start();
$pdo = new PDO('mysql:host=sql102.epizy.com;port=3306;dbname=epiz_26764786_XXX', 'epiz_26764786', 'URNgtR7eNZobf');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                    <li class="nav-item">
                      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                  </ul>
                  
                </div>
              
            </span>
    </nav>
        
          <div class="container-fluid" id=contents>
            <span>
                <div style="margin-left:30%;margin-right:30%;background-color: aliceblue;padding:40px;border-radius:10px;margin-top:57px;
                margin-bottom:56px;font-size:22px;">
                <div style="font-weight:bold;">This application is developed by : </div>C. Bindhu Madhava Varma - 19BCD7116.
                <br>P. Krishna Dheeraj - 19BCN7030 <br>B. Mohan Srinivasa Sarma - 19BCN7015
                <br>CH. Sesha Pranav - 19BCN7190
                </div>';
            }
            </span>
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