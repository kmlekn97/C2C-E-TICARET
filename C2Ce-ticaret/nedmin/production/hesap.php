<?php 

include 'header.php'; 
require_once 'CLASS/Hesap.php';

//Belirli veriyi seçme işlemi
$hesapsor=$admindbservices->hesapgetir();
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hesap Listeleme <small>,

             <?php $form->Durum_cek(); ?>


           </small></h2>

           <div class="clearfix"></div>

           <?php $form->Buttonhref("Yeni Ekle","hesap-ekle.php"); ?>

         </div>
         <div class="x_content">


          <!-- Div İçerik Başlangıç -->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <?php
            $tbl=new CreateTable(8);
            $tbl->addcolumn("S.No",0);
            $tbl->addcolumn("Hesap Adı",1);
            $tbl->addcolumn("Hesap Tarih",2);
            $tbl->addcolumn("Hesap IBAN",3);
            $tbl->addcolumn("Cari İslem",4);
            $tbl->addcolumn("Durum",5);
            $tbl->addcolumn("",6);
            $tbl->addcolumn("",7);
            $tbl->TableBaslik();
            ?>

            <tbody>

              <?php 

              $say=0;

              while($hesapcek=$admindbservices->vericek($hesapsor)) { $say++;
                $hesaplarim=$cons->Hesap_ekle($hesapcek);
                ?>


                <tr>
                  <?php 
                  $tbl->addRow($say,0,20);
                  $tbl->addRow($hesaplarim->get_hesap_adi(),1);
                  $tbl->addRow($hesaplarim->get_hesap_tarih(),2);
                  $tbl->addRow($hesaplarim->get_hesap_iban(),3);
                  if ($hesaplarim->get_durum()==0) {
                    $tbl->AddButton("cari-islem.php?hesap_id=".$hesaplarim->get_hesap_id(),-1,"Cari","information");
                    $tbl->AddButton("../netting/islem.php?hesap_id=".$hesaplarim->get_hesap_id()."&hesap_one=1&hesap_kapa=ok",5,"Aç","success");
                    $tbl->AddButton("hesap-duzenle.php?hesap_id=".$hesaplarim->get_hesap_id(),-1,"Düzenle","primary");
                    $tbl->AddButton("../netting/islem.php?hesap_id=".$hesaplarim->get_hesap_id()."&hesapsil=ok",7,"Sil","danger","Bu Hesabı Silmek İstediğine Emin Misin???");
                  }
                  else { 

                    $tbl->AddButton("cari-islem.php?hesap_id=".$hesaplarim->get_hesap_id(),4,"Cari","information");
                    $tbl->AddButton("../netting/islem.php?hesap_id=".$hesaplarim->get_hesap_id()."&hesap_one=0&hesap_kapa=ok",5,"Kapa","danger"); 
                    $tbl->AddButton("hesap-duzenle.php?hesap_id=".$hesaplarim->get_hesap_id(),6,"Düzenle","primary");
                    $tbl->AddButton("../netting/islem.php?hesap_id=".$hesaplarim->get_hesap_id()."&hesapsil=ok",7,"Sil","danger","Bu Hesabı Silmek İstediğine Emin Misin???");
                  }

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
