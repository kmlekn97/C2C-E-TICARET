<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Kemal EKIN Eğitim Sürümü </title>

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

<?php 

if (isset($_COOKIE['adminsLogin'])) 
{
  $login=json_decode($_COOKIE['adminsLogin']);
  $gecici=$login->kullanici_password;
  $pass=openssl_decrypt($gecici, "AES-128-ECB", "admins_coz");
  if (isset($_COOKIE['oturumdurum']))
  Header("Location:index.php");
}
?>

<body  class="login" style=" background: url(agac.jpg) no-repeat center center fixed;
background-size:cover;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;">
<div class="login-page">
  <a class="hiddenanchor" id="signup"></a>
  <a class="hiddenanchor" id="signin"></a>

  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">


        <form action="../netting/islem.php" method="POST">


          <h1>Yönetim Paneli </h1>

          <div>

            <input type="text" name="kullanici_mail" class="form-control"


            <?php
            if (isset($_COOKIE['adminsLogin'])) {
             echo 'value="'.$login->kullanici_mail.'"';
           } else {

            echo 'placeholder="Kullanıcı Adı(Mail)"';
          }
          ?>


          required="" />
        </div>
        <div>
          <input type="password" name="kullanici_password" class="form-control"
          <?php
          if (isset($_COOKIE['adminsLogin'])) {
            echo 'value="'.$pass.'"';
          } else {

            echo 'placeholder="Kullanıcı Şifre"';
          }
          ?>

          required="" />
        </div>
        <div>
          <?php
          if (isset($_COOKIE['adminsLogin'])) {
            ?>
            <input type="checkbox" id="remember_me" name="remember_me" value="remember_me" checked>
            <label for="remember_me"> Beni Hatırla</label><br>
            <?php
          }
          else
           {
            ?>

            <input type="checkbox" id="remember_me" name="remember_me" value="remember_me">
            <label for="remember_me"> Beni Hatırla</label><br>
          <?php 
        }
          ?>
          <button  style="width: 100%; background-color: #73879C; color:white;" type="submit" name="admingiris" class="btn btn-default"> Giriş Yap</button>

        </div>

        <div class="clearfix"></div>

        <div class="separator">
          <p class="change_link">

           <?php 
           error_reporting(0);
           if (htmlspecialchars($_GET['durum'])=="no") {

             echo "Kullanıcı Bulunamadı...";

           } elseif (htmlspecialchars($_GET['durum'])=="exit") {

             echo "Başarıyla Çıkış Yaptınız.";

           }

           ?>

         </p>

         <div class="clearfix"></div>
         <br />

         <div>
          <h1><i class="fa fa-paw"></i> Kemal EKIN</h1>
          <p>©2020 Kemal EKIN Eğitim Sürümü</p>
        </div>
      </div>
    </form>



  </section>
</div>

</div>
</div>
</body>
</html>
