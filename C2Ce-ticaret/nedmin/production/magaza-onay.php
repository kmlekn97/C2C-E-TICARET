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
            <h2>Mağaza Başvuru <small>

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

          <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
          <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
          </button>


          <!-- Div İçerik Başlangıç -->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(8);
            $tbl->addcolumn("Kayıt Tarih",0);
            $tbl->addcolumn("Firma Adı",1);
            $tbl->addcolumn("Firma Türü",2);
            $tbl->addcolumn("Ad",3);
            $tbl->addcolumn("Soyad",4);
            $tbl->addcolumn("Mail Adresi",5);
            $tbl->addcolumn("Telefon",6);
            $tbl->addcolumn("",7);
            $tbl->TableBaslik();


            ?>

            <tbody>

              <?php 

              $arraylistkullanici=array();
              $kullanicilist=new ArrayList($arraylistkullanici);
              $kullanicilist=$admindbservices->magazaListele(1);
              $kullanicilist=$kullanicilist->toArray();
              foreach ($kullanicilist as $kullanicilarim) 
              {


                ?>

                <tr>

                  <?php

                  $tbl->addRow($kullanicilarim->get_kullanici_zaman(),0);
                  $tbl->addRow($kullanicilarim->get_kullanici_unvan(),1);
                  $tbl->Sirkettype($kullanicilarim->get_kullanici_tip(),$kullanicilarim->get_kullanici_magaza());
                  $tbl->addRow($kullanicilarim->get_kullanici_ad(),3);
                  $tbl->addRow($kullanicilarim->get_kullanici_soyad(),4);
                  $tbl->addRow($kullanicilarim->get_kullanici_mail(),5);
                  $tbl->addRow($kullanicilarim->get_kullanici_gsm(),6);
                  $tbl->AddButton("magaza-onay-islemleri.php?kullanici_id=".$kullanicilarim->get_kullanici_id(),7,"Mağaza İnceleme","primary");

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
