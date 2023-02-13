<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$markasor=$admindbservices->MarkalariGetir(0);
  ?>

  
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">

      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Marka Onay <small>

               <?php $form->Durum_cek(); ?>


             </small></h2>

             <div class="clearfix"></div>
           </div>


           <div class="x_content">



             <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
             <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
             </button>

             
             <!-- Div İçerik Başlangıç -->

             <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(6);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Marka Ad",1);
              $tbl->addcolumn("Marka Kategori",2);
              $tbl->addcolumn("Kullanıcı Adı",3);
              $tbl->addcolumn("Kullanıcı Mail",4);
              $tbl->addcolumn("",5);
              $tbl->TableBaslik();

              ?>

              <tbody>

                <?php 

                $say=0;

                while($markacek=$admindbservices->vericek($markasor)) { 


                  $markalarim=$cons->Marka_ekle($markacek);

                  $kategorim=$cons->Kategori_ekle($markacek);

                  $kullanicilarim=$cons->Kullanici_ekle($markacek);



                  $say++;?>

                  <tr>

                    <?php

                    $tbl->addRow($say,0,20);
                    $tbl->addRow($markalarim->get_marka_adi(),1);
                    $tbl->addRow($kategorim->get_kategori_ad(),2);
                    $tbl->addRow($kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(),3);
                    $tbl->addRow($kullanicilarim->get_kullanici_mail(),4);
                    $tbl->AddButton("marka-onay.php?marka_id=".$markalarim->get_marka_id()."&kullanici_id=".$markalarim->get_kullanici_id(),5,"İncele","primary");

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
