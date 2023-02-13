<?php 

include 'header.php'; 

$Calisanlarim=$admindbservices->calisanGetir($_GET['calisan_id']);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Çalışan Düzenleme <small>,

             <?php $form->Durum_cek(); ?>


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

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <?php

            $form->TextBox("calisan_ad",$Calisanlarim->get_calisan_ad(),"Ad",0);
            $form->TextBox("calisan_soyad",$Calisanlarim->get_calisan_soyad(),"Soyad",1);
            $form->TextBox("calisan_maas",$Calisanlarim->get_calisan_maas(),"Maaş",2);
            $form->TextBox("calisan_departman",$Calisanlarim->get_calisan_departman(),"Departman",3);
            $form->TextBox("calisan_unvan",$Calisanlarim->get_calisan_unvan(),"Ünvan",4);

            ?>


          <input type="hidden" name="calisan_id" value="<?php echo htmlspecialchars($_GET['calisan_id']) ?>"> 


          <div class="ln_solid"></div>

          <?php $form->Button("calisanduzenle","Güncelle"); ?>
          
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
