<?php 
include 'header.php';
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Ayarlar</h3>
      </div>

     <!-- <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Anahtar Kelimeniz...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Ara!</button>
            </span>
          </div>
        </div>
      </div>-->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Smtp Mail Ayarları <small>

               <?php $form->Durum_cek(); ?>


             </small> </h2>
             <ul class="nav navbar-right panel_toolbox">




             </ul>
             <div class="clearfix"></div>
           </div>

           <div class="x_content">

            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php

              $form->TextBox("ayar_smtphost",$ayarlarim->get_ayar_smtphost(),"Mail Smtp Host");
              $form->TextBox("ayar_smtpuser",$ayarlarim->get_ayar_smtpuser(),"Mail Adresiniz");
              $form->PasswordTextBox("ayar_smtppassword","Mail Şifreniz",null,null,$ayarlarim->get_ayar_smtppassword());
              $form->TextBox("ayar_smtpport",$ayarlarim->get_ayar_smtpport(),"Smtp Port");
              $form->Button("mailayarkaydet","Güncelle");

              ?>             


            </form>



          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>
