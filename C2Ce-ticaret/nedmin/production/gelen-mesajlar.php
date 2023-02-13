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
            <h2>Gelen Mesajlar <small>,

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
            <?php $form->Buttonhref("Yeni Ekle","mesaj-gonder.php"); ?>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <?php

              $tbl=new CreateTable(7);
              $tbl->addcolumn("Mesaj Tarihi",0);
              $tbl->addcolumn("Gönderen",1);
              $tbl->addcolumn("Mail",2);
              $tbl->addcolumn("Durum",3);
              $tbl->addcolumn("Detay",4);
              $tbl->addcolumn("",5);
              $tbl->addcolumn("",6);
              $tbl->TableBaslik();

              ?>

              <tbody>
                <?php 


                $mesajsor=$admindbservices->mesajgelengetir();


                while($mesajcek=$admindbservices->vericek($mesajsor)) {

                  $kullanicilarim=$cons->Kullanici_ekle($mesajcek);

                  $mesajlarim=$cons->Mesaj_ekle($mesajcek);

                  $kullanici_gon=$mesajlarim->get_kullanici_gon();
                  ?>


                  <tr>
                    <?php
                    $tbl->addRow($mesajlarim->get_mesaj_zaman(),0);
                    $tbl->addRow($kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(),1);
                    $tbl->addRow($kullanicilarim->get_kullanici_mail(),2);
                    ?>
                    <td> <?php 
                    if ($mesajlarim->get_mesaj_okunma()==0) {?>

                      <i style="color:green" class="fa fa-circle" aria-hidden="true">

                      <?php } else {?>

                       <i class="fa fa-circle" aria-hidden="true">
                       <?php }
                       ?>
                     </td>
                     <?php
                     $tbl->addRow($mesajlarim->get_mesaj_detay(),3);
                     $tbl->AddButton("mesaj-detay?mesaj_id=".$mesajlarim->get_mesaj_id()."&kullanici_gon=".$mesajlarim->get_kullanici_gon(),4,"Mesajı Oku","primary");
                     $tbl->AddButton("../netting/islem.php?gelenmesajsil=ok&mesaj_id=".$mesajlarim->get_mesaj_id(),5,"Sil","danger","Bu mesajı silmek istiyormusunuz? İşlem geri alınamaz...");
                     ?>
                   </tr>



                 <?php  }

                 ?>


               </tbody>
             </table>

             <!-- Div İçerik Bitişi -->


           </div>
         </div>
       </div>
     </div>




   </div>
 </div>
 <!-- /page content -->

 <?php include 'footer.php'; ?>
