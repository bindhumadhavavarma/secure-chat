<?php
session_start();
$pdo = new PDO('mysql:host=sql102.epizy.com;port=3306;dbname=epiz_26764786_XXX', 'epiz_26764786', 'URNgtR7eNZobf');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['disconnect'])){header("Location:logged_index.php");}
if(isset($_POST['send'])){
  



$key=array(array(),array());
$msg=$_POST['message'];
$msg_16=str_split($msg,16);

$full_enc_hex_msg='';$full_enc_msg='';
for($a=0;$a<count($msg_16);$a++){
    $hex_msg=implode(unpack("H*", $msg_16[$a]));
    while(strlen($hex_msg)!=32){$hex_msg=$hex_msg.'0';}
    $hex_msg_c=str_split($hex_msg,2);
$state=array(array(),array());
$k=0;
for($i=0;$i<4;$i++){
    for($j=0;$j<4;$j++){
        $state[$j][$i]=$hex_msg_c[$k];$k++;
    }
}

$s_box=array(
    array('63','7c','77','7b','f2','6b','6f','c5','30','01','67','2b','fe','d7','ab','76'),
    array('ca','82','c9','7d','fa','59','47','f0','ad','d4','a2','af','9c','a4','72','c0'),
    array('b7','fd','93','26','36','3f','f7','cc','34','a5','e5','f1','71','d8','31','15'),
    array('04','c7','23','c3','18','96','05','9a','07','12','80','e2','eb','27','b2','75'),
    array('09','83','2c','1a','1b','6e','5a','a0','52','3b','d6','b3','29','e3','2f','84'),
    array('53','d1','00','ed','20','fc','b1','5b','6a','cb','be','39','4a','4c','58','cf'),
    array('d0','ef','aa','fb','43','4d','33','85','45','f9','02','7f','50','3c','9f','a8'),
    array('51','a3','40','8f','92','9d','38','f5','bc','b6','da','21','10','ff','f3','d2'),
    array('cd','0c','13','ec','5f','97','44','17','c4','a7','7e','3d','64','5d','19','73'),
    array('60','81','4f','dc','22','2a','90','88','46','ee','b8','14','de','5e','0b','db'),
    array('e0','32','3a','0a','49','06','24','5c','c2','d3','ac','62','91','95','e4','79'),
    array('e7','c8','37','6d','8d','d5','4e','a9','6c','56','f4','ea','65','7a','ae','08'),
    array('ba','78','25','2e','1c','a6','b4','c6','e8','dd','74','1f','4b','bd','8b','8a'),
    array('70','3e','b5','66','48','03','f6','0e','61','35','57','b9','86','c1','1d','9e'),
    array('e1','f8','98','11','69','d9','8e','94','9b','1e','87','e9','ce','55','28','df'),
    array('8c','a1','89','0d','bf','e6','42','68','41','99','2d','0f','b0','54','bb','16')
);
for($i=0;$i<4;$i++){
    for($j=0;$j<4;$j++){
        $val=$state[$i][$j];
        $val_arr=str_split($val);
        $state[$i][$j]=$s_box[hexdec($val_arr[0])][hexdec($val_arr[1])];
    }
}

$shift_row_enc=array(
    array('00','01','02','03'),
    array('11','12','13','10'),
    array('22','23','20','21'),
    array('33','30','31','32')
);
$tr_state=array(array(),array());
for($i=0;$i<4;$i++){
    for($j=0;$j<4;$j++){
        $val=$shift_row_enc[$i][$j];
        $val_arr=str_split($val);
        $tr_state[$i][$j]=$state[$val_arr[0]][$val_arr[1]];
    }
}

for($i=0;$i<4;$i++){
    $k='';
    $b=array($tr_state[$i][0],$tr_state[$i][1],$tr_state[$i][2],$tr_state[$i][3]);
    for($j=0;$j<8;$j++){
        $ki=$b[0];
        $b[0]=$b[1];
        $b[1]=$b[2];
        $b[2]=$b[3];
        $b[3]=bin2hex(pack('H*',$ki) ^ pack('H*',$b[0]));
        if($j>3)$k=$k.$ki;
    }
    $key[$a][$i]=$k;
    $p_key=str_split($key[$a][$i],2);
   
    for($j=0;$j<4;$j++){
        $temp=bin2hex(pack('H*',$tr_state[$j][$i]) ^ pack('H*',$p_key[$j]));
        $tr_state[$j][$i]=$temp;
    }
}


$state_one = array();
foreach ($tr_state as $value) {
$state_one = array_merge($state_one, $value);
}
$enc_hex_msg=implode($state_one);
$full_enc_hex_msg=$full_enc_hex_msg.$enc_hex_msg;
$string='';
for ($i=0; $i < strlen($enc_hex_msg)-1; $i+=2){
    $string .= chr(hexdec($enc_hex_msg[$i].$enc_hex_msg[$i+1]));
}
$full_enc_msg=$full_enc_msg.$string;
}
$key_one = array();
foreach ($key as $value) {
$key_one = array_merge($key_one, $value);
}
$key_str=implode($key_one);
$permutation=array(58,50,42,34,26,18,10,02,60,52,
  44,36,28,20,12,04,62,54,46,38,
  30,22,14,06,64,56,48,40,32,24,16,8,
  57,49,41,33,25,17,9,01,59,51,43,35,
  27,19,11,03,61,53,45,37,29,21,13,05,
  63,55,47,39,31,23,15,07);
  $zeroes=0;
  while(strlen($full_enc_hex_msg) % 64 !=0){$full_enc_hex_msg=$full_enc_hex_msg.'0';$zeroes++;}
  $size= strlen($full_enc_hex_msg)/64;
  $hex_msg_64=str_split($full_enc_hex_msg,64);
  $enc_hex_msg_64=array();
  for($i=0;$i<$size;$i++){
    $hex_msg_char=str_split($hex_msg_64[$i]);
    
    $enc_hex_msg_char=array();
    for($j=0;$j<64;$j++){$enc_hex_msg_char[$j]=$hex_msg_char[$permutation[$j]-1];}
    $enc_hex_msg_64[$i]=implode($enc_hex_msg_char);
  }
  $p_enc_hex_msg=implode($enc_hex_msg_64);
  $full_enc_hex_msg=$p_enc_hex_msg;

  
  
  $stmt=$pdo->prepare("insert into feed(user_id,type,message) values (:user_id,:type,:message)");
    $stmt->execute(
      array(
        ':user_id' => $_SESSION['r_user_id'],
        ':type' => 1,
        ':message' => $full_enc_hex_msg,
        )
    );
    $stmt=$pdo->prepare("insert into feed(user_id,type,message) values (:user_id,:type,:message)");
    $stmt->execute(
      array(
        ':user_id' => $_SESSION['user_id'],
        ':type' => 0,
        ':message' => $full_enc_hex_msg,
        )
    );
    $stmt=$pdo->query("select * from feed");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($row['message']===$full_enc_hex_msg){
        $stmt1=$pdo->prepare("insert into decryption_keys(sl,decryption_key,zeroes) values (:sl,:decryption_key,:zeroes)");
        $stmt1->execute(
          array(
            ':sl' => $row['sl'],
            ':decryption_key' => $key_str,
            ':zeroes' => $zeroes,
            )
        );
      }
    }
  header("Location:secure.php");return;
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
                      <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout </a>
                      </li>
                      
                    </ul>
                    
                  </div>

            </span>
    </nav>
          
          <div class="container-fluid" id=contents style="min-height:472px ">
       
          <h2 style="color:rgb(14, 165, 14);text-align:center;"><?php echo $_SESSION['name']." &rarr; ".$_SESSION['r_name'];?></h2>
          <div style=" background-image:url(Untitled1.png);  background-repeat: no-repeat;
background-position: center;min-height:500px;margin:20px;
          margin-left:70px;margin-right:70px;border-radius:10px;background-color:white;
          padding:20px;">
          <div><?php
          $stmt=$pdo->query("select * from feed");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $stmt1=$pdo->query("select * from decryption_keys");
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
              if($row['sl']===$row1['sl']){$key_str=$row1['decryption_key'];$zeroes=$row1['zeroes'];}
            }
            $key_one=str_split($key_str,32);
            $key=array(array(),array());
            for($i=0;$i<count($key_one);$i++){
              $p_key_one=str_split($key_one[$i],8);
              for($j=0;$j<4;$j++){
                $key[$i][$j]=$p_key_one[$j];
              }
            }
          $msg=$row['message'];
          $depermutation=array(40,8,48,16,56,24,64,32,39,7,
            47,15,55,23,63,31,38,6,46,14,
            54,22,62,30,37,5,45,13,53,21,61,
            29,36,4,44,12,52,20,60,28,35,
            3,43,11,51,19,59,27,34,2,42,10,
            50,18,58,26,33,1,41,9,49,17,57,25);
            $size=strlen($msg)/64;
            $msg_64=str_split($msg,64);
            $dec_msg_64=array();
            for($i=0;$i<$size;$i++){
              $msg_char=str_split($msg_64[$i]);
              $dec_msg_char=array();
              for($j=0;$j<64;$j++){$dec_msg_char[$j]=$msg_char[$depermutation[$j]-1];}
              $dec_msg_64[$i]=implode($dec_msg_char);
            }
            $dec_hex_msg=implode($dec_msg_64);

          $le=strlen($dec_hex_msg)-$zeroes;
          $hex_msg=substr($dec_hex_msg,0,$le);
          $hex_msg_32=str_split($hex_msg,32);
          $dec_msg='';
          for($a=0;$a<count($hex_msg_32);$a++){
              $hex_msg_c=str_split($hex_msg_32[$a],2);
              $state=array(array(),array());
              $k=0;
              for($i=0;$i<4;$i++){
                  for($j=0;$j<4;$j++){
                      $state[$i][$j]=$hex_msg_c[$k];$k++;
                  }
              }
          
              for($i=0;$i<4;$i++){
                  $p_key=str_split($key[$a][$i],2);
                  for($j=0;$j<4;$j++){
                      $temp=bin2hex(pack('H*',$state[$j][$i]) ^ pack('H*',$p_key[$j]));
                      $state[$j][$i]=$temp;
                  }
              }
          
          
              $s_box=array(
                  array('52','09','6a','d5','30','36','a5','38','bf','40','a3','9e','81','f3','d7','fb'),
                  array('7c','e3','39','82','9b','2f','ff','87','34','8e','43','44','c4','de','e9','cb'),
                  array('54','7b','94','32','a6','c2','23','3d','ee','4c','95','0b','42','fa','c3','4e'),
                  array('08','2e','a1','66','28','d9','24','b2','76','5b','a2','49','6d','8b','d1','25'),
                  array('72','f8','f6','64','86','68','98','16','d4','a4','5c','cc','5d','65','b6','92'),
                  array('6c','70','48','50','fd','ed','b9','da','5e','15','46','57','a7','8d','9d','84'),
                  array('90','d8','ab','00','8c','bc','d3','0a','f7','e4','58','05','b8','b3','45','06'),
                  array('d0','2c','1e','8f','ca','3f','0f','02','c1','af','bd','03','01','13','8a','6b'),
                  array('3a','91','11','41','4f','67','dc','ea','97','f2','cf','ce','f0','b4','e6','73'),
                  array('96','ac','74','22','e7','ad','35','85','e2','f9','37','e8','1c','75','df','6e'),
                  array('47','f1','1a','71','1d','29','c5','89','6f','b7','62','0e','aa','18','be','1b'),
                  array('fc','56','3e','4b','c6','d2','79','20','9a','db','c0','fe','78','cd','5a','f4'),
                  array('1f','dd','a8','33','88','07','c7','31','b1','12','10','59','27','80','ec','5f'),
                  array('60','51','7f','a9','19','b5','4a','0d','2d','e5','7a','9f','93','c9','9c','ef'),
                  array('a0','e0','3b','4d','ae','2a','f5','b0','c8','eb','bb','3c','83','53','99','61'),
                  array('17','2b','04','7e','ba','77','d6','26','e1','69','14','63','55','21','0c','7d')
              );
              for($i=0;$i<4;$i++){
                  for($j=0;$j<4;$j++){
                      $val=$state[$i][$j];
                      $val_arr=str_split($val);
                      $state[$i][$j]=$s_box[hexdec($val_arr[0])][hexdec($val_arr[1])];
                  }
              }
              $shift_row_dec=array(
                  array('00','01','02','03'),
                  array('13','10','11','12'),
                  array('22','23','20','21'),
                  array('31','32','33','30')
              );
              $tr_state=array(array(),array());
              for($i=0;$i<4;$i++){
              for($j=0;$j<4;$j++){
                  $val=$shift_row_dec[$i][$j];
                  $val_arr=str_split($val);
                  $tr_state[$i][$j]=$state[$val_arr[0]][$val_arr[1]];
              }
              }
              
              $tr_state=array_map(null, ...$tr_state);;
              $state_one = array();
              foreach ($tr_state as $value) {
              $state_one = array_merge($state_one, $value);
              }
              $enc_hex_msg=implode($state_one);
              
              $string='';
              for ($i=0; $i < strlen($enc_hex_msg)-1; $i+=2){
                  $string .= chr(hexdec($enc_hex_msg[$i].$enc_hex_msg[$i+1]));
              }
              $dec_msg=$dec_msg.$string;
              
          }
          
          

            if($row['user_id']===$_SESSION['user_id']){
              if($row['type']==0){
                echo '<div class="card" style="width: fit-content;float:right">
                <div class="card text-right" style="width:fit-content;float:right;background-color: rgb(125, 215, 245);">
                <ul class="list-group list-group-flush">
                <li class="list-group-item">'.$dec_msg.'</li>
                </ul>
              </div></div>';
              }
              if($row['type']==1){
                echo '
                <div class="card" style="width: 100%;">
                <div class="card" style="width: fit-content;background-color: rgb(125, 215, 245);">
                <ul class="list-group list-group-flush">
                <li class="list-group-item">'.$dec_msg.'</li>
                </ul>
                </div>
                </div>
                ';
              }
            }
          }
          ?></div>
          </div>
          <form method="POST">
  <div class="form-group row" style="padding-left:70px">
    <span class="col-sm-10">
      <input type="text" class="form-control" name="message" placeholder="Type a message to send">
      
    </span>
    <button type="submit" class="btn btn-primary" name="send">Send</button>&nbsp;
    <button type="submit" class="btn btn-primary" name="disconnect">Disconnect</button>
  </div>
</form>
          </div>
        
          <footer class="panel-footer" id="foot">
            <div class="container"></div>
              <div style="text-align: center;">
                This application is developed by:<br>C. Bindhu Madhava Varma - 19BCD7116.
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