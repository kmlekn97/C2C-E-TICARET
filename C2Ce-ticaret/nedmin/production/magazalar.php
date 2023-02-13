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
            <h2>Mağazalar <small>

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

           $tbl=new CreateTable(12);
           $tbl->addcolumn("#",0);
           $tbl->addcolumn("Kayıt Tarih",1);
           $tbl->addcolumn("Firma Adı",2);
           $tbl->addcolumn("Mağaza Adı",3);
           $tbl->addcolumn("Firma Türü",4);
           $tbl->addcolumn("Ad",5);
           $tbl->addcolumn("Soyad",6);
           $tbl->addcolumn("Mail Adresi",7);
           $tbl->addcolumn("Telefon",8);
           $tbl->addcolumn("Satış Fiyat",9);
           $tbl->addcolumn("",10);
           $tbl->addcolumn("",11);
           $tbl->TableBaslik();

           ?>

           <tbody>

            <?php 

            $arraylistkullanici=array();
            $kullanicilist=new ArrayList($arraylistkullanici);
            $kullanicilist=$admindbservices->magazaListele(2);
            $kullanicilist=$kullanicilist->toArray();
            foreach ($kullanicilist as $kullanicilarim) 
            {
             $durum=$kullanicilarim->get_kullanici_magaza();

             ?>


             <tr>
               <td style="width: 4rem;"> 
                <?php
                $foto="";
                if ($kullanicilarim->get_kullanici_tip() == "LIMITED_OR_JOINT_STOCK_COMPANY" || $kullanicilarim->get_kullanici_tip() == "TECHNİCAL_PERSON" || $kullanicilarim->get_kullanici_tip() == "OWNER") 
                { 
                  $foto=$kullanicilarim->get_kullanici_resim();
                  ?>
                  <img src="../../<?php echo $foto;?>" class="img-responsive"/>
                <?php } else { 
                  $foto=$kullanicilarim->get_kullanici_magazafoto();
                  ?>
                  <img src="../../<?php echo $foto;?>" class="img-responsive"/>

                <?php } ?>


              </td>

              <?php 

              $tbl->addRow($kullanicilarim->get_kullanici_zaman(),1);
              $tbl->addRow($kullanicilarim->get_kullanici_unvan(),2);
              $tbl->addRow($kullanicilarim->get_magaza_adi(),3);
              $tbl->Sirkettype($kullanicilarim->get_kullanici_tip(),$kullanicilarim->get_kullanici_magaza());
              $tbl->addRow($kullanicilarim->get_kullanici_ad(),4);
              $tbl->addRow($kullanicilarim->get_kullanici_soyad(),5);
              $tbl->addRow($kullanicilarim->get_kullanici_mail(),6);
              $tbl->addRow($kullanicilarim->get_kullanici_gsm(),7);


              ?>

              <td>
                <?php

                echo $admindbservices->magazaToplamSatisHesapla($kullanicilarim->get_kullanici_id());
                ?>
              </td>

              <?php

              $tbl->AddButton("magaza-onay-islemleri.php?kullanici_id=".$kullanicilarim->get_kullanici_id(),8,"Mağaza İnceleme","primary");

              if($durum==1) {

                $tbl->AddButton("../netting/islem.php?kullanici_id=".$kullanicilarim->get_kullanici_id()."&mengel_kaldir=ok",9,"ENGEL KALDIR","success");

              }

              else{ 

                $tbl->AddButton("../netting/islem.php?kullanici_id=".$kullanicilarim->get_kullanici_id()."&mengelle=ok",9,"ENGELLE","danger");


              } ?>


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
