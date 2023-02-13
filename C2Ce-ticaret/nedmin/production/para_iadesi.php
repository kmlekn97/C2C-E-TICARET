<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi

//$iadesor=$dbsql->wread("iade","iade_turu","Para İadesi");

$iadesor=$admindbservices->ParaIadesiGetir();

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>İade Listeleme <small>

             <?php $form->Durum_cek(); ?>


           </small></h2>
           <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

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
            $tbl->addcolumn("İade Tarihi",0);
            $tbl->addcolumn("Alıcı Ad Soyad",1);
            $tbl->addcolumn("Adres",2);
            $tbl->addcolumn("Kargo Ücreti",3);
            $tbl->addcolumn("Kargo Kodu",4);
            $tbl->addcolumn("Teslim Durumu",5);
            $tbl->addcolumn("Detay",6);
            $tbl->addcolumn("Fatura",7);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 




              while($iadecek=$admindbservices->vericek($iadesor)) {

               $siparis_detay=$cons->Siparis_Detay_ekle($iadecek);
               $iadeler=$cons->Iade_ekle($iadecek);

               $siparissor2=$admindbservices->kullaniciGetir($iadeler->get_kullanici_id());
               while($sipariscek2=$admindbservices->vericek($siparissor2)) {

                $kullanicilarim=$cons->Kullanici_ekle($sipariscek2);
                $ad=$kullanicilarim->get_kullanici_ad();
                $soyad=$kullanicilarim->get_kullanici_soyad();
                $adres=$kullanicilarim->get_kullanici_adres();
              }


              ?>


              <tr>

                <?php

                $tbl->addRow($iadeler->get_iade_tarihi(),0);
                $tbl->addRow($ad." ".$soyad,1);
                $tbl->addRow(wordwrap($adres,35,"<br>"),2);
                $tbl->addRow($iadeler->get_kargo_ucret(),3);
                $tbl->addRow($iadeler->get_kargo_no(),4);

                ?>

                <td><center><?php 

                $iade_onay=$iadeler->get_iade_durum();
                $siparis_detay_id=$siparis_detay->get_siparisdetay_id();
                $iade_id=$iadeler->get_iade_id();

                if ($iade_onay==3) {

                  $form->Buttonhref("Teslim Edildi",null);
                } else if ($iade_onay==2) {

                  $form->Buttonhref("Ürün Kargoda","../netting/islem.php?iade_id=".$iadeler->get_iade_id()."&iade_et=ok","warning");
                }
                else if ($iade_onay==1) {
                 $form->Buttonhref("Ürün İşlemleri Yapılıyor","iade_duzenle.php?iade_id=".$iadeler->get_iade_id(),"warning");
               }

               else {
                $form->Buttonhref("Satıcı Teslim Etmedi",null);
              }

              ?>
            </center>


          </td>


          <?php

          $tbl->AddButton("iade_urun_detay.php?kullanici_id=".$iadecek['k_id']."&siparis_zaman=".$siparis_detay->get_siparis_zaman()."&siparis_id=".$siparis_detay->get_siparis_id(),5,"Detay","primary");
          $tbl->AddButton("../../fatura/iade-fatura.php?siparis_zaman=".$siparis_detay->get_siparis_zaman()."&kullanici_id=".$iadecek['k_id']."&skullanici_id=".$iadecek['ks_id']."&siparis_id=".$siparis_detay->get_siparis_id(),6,"Fatura","success");

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