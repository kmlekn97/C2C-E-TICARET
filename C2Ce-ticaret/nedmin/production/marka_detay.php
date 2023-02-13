<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$markasor=$admindbservices->MarkaDetayGetir();
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Marka Detay <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <div class="clearfix"></div>

            
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(3);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Marka Ad",1);
              $tbl->addcolumn("Ürün",2);
              $tbl->TableBaslik();

              ?>

              <tbody>

                <?php 

                $say=0;

                while($markacek=$admindbservices->vericek($markasor)) { 



                 $markalarim=$cons->Marka_ekle($markacek);
                 $Urunlerim=$cons->Urun_ekle($markacek);
                 

                 $say++;?>

                 <tr>

                  <?php

                  $tbl->addRow($say,0,20);
                  $tbl->addRow($markalarim->get_marka_adi(),1);
                  $tbl->addRow($Urunlerim->get_urun_ad(),2);

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
