<?php 

include 'header.php'; 


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Ayarlar <small>

              <?php 
              $value=array("ok","no","eksiksifrekarakter","eskisifrehata","sifreleruyusmuyor");
              $key=array("İşlem Başarılı...","İşlem Başarısız...","En az Bir Karakter Birde Rakam Olmalı...","Eski Şifre Hatalı...","Şifreler Uyuşmuyor...");
              $form->Durum_cek2($value,$key);
              ?>


            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Profil Resmi<br><span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <?php 
                  if (strlen($kullanicilarim->get_kullanici_resim())>0) {?>

                    <img width="200"  src="../../<?php echo $kullanicilarim->get_kullanici_resim(); ?>">

                  <?php } else {?>


                    <img width="200"  src="../../dimg/logo-yok.png">


                  <?php } ?>


                </div>
              </div>

              <?php

              $form->FileChooser("kullanici_resim",null,"Resim Seç");

              ?>

              <input type="hidden" name="eski_yol" value="<?php echo $kullanicilarim->get_kullanici_resim(); ?>">

              <?php $form->Button("profilfotochange","Güncelle");  ?>

            </form>

            <hr>



            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">



              <?php

              $form->PasswordTextBox("kullanici_eskipassword","Eski Şifre",null,"Eski Şifre Giriniz...");
              $form->PasswordTextBox("kullanici_passwordone","Şifre",null,"Şifre Giriniz...");
              $form->PasswordTextBox("kullanici_passwordtwo","Şifre Tekrar",null,"Şifre Tekrar Giriniz...");
              $form->Button("kullanicisifreguncelle","Güncelle","primary");

              ?>

            </form>





          </div>
        </div>
      </div>
    </div>



    <hr>
    <hr>
    <hr>



  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
