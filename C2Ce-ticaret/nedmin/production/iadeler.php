<?php 
include 'header.php'; 
//Belirli veriyi seçme işlemi
$iadesor=$admindbservices->iadeGetir();
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
            $tbl=new CreateTable(9);
            $tbl->addcolumn("İade Tarihi",0);
            $tbl->addcolumn("Alıcı Ad Soyad",1);
            $tbl->addcolumn("Satıcı Ad Soyad",2);
            $tbl->addcolumn("Adres",3);
            $tbl->addcolumn("Kargo Ücreti",4);
            $tbl->addcolumn("Kargo Kodu",5);
            $tbl->addcolumn("Teslim Durumu",6);
            $tbl->addcolumn("Detay",7);
            $tbl->addcolumn("Fatura",8);
            $tbl->TableBaslik();
            ?>

            <tbody>

              <?php 




              while($iadecek=$admindbservices->vericek($iadesor)) {

                $iadeler=$cons->Iade_ekle($iadecek);

                $siparissor2=$admindbservices->kullaniciGetir($iadeler->get_kullanici_id());

                while($sipariscek2=$admindbservices->vericek($siparissor2)) {

                  $alici=$cons->Kullanici_ekle($sipariscek2);
                  $ad=$alici->get_kullanici_ad();
                  $soyad=$alici->get_kullanici_soyad();
                  $adres=$alici->get_kullanici_adres();
                }

                $siparissor4=$admindbservices->kullaniciGetir($iadeler->get_kullanici_idsatici());

                while($sipariscek4=$admindbservices->vericek($siparissor4)) {

                 $satici=$cons->Kullanici_ekle($sipariscek4);
                 $saticiad=$satici->get_kullanici_ad();
                 $saticisoyad=$satici->get_kullanici_soyad();
               }

               ?>


               <tr>

                <?php 

                $tbl->addRow($iadeler->get_iade_tarihi(),0);
                $tbl->addRow($ad." ".$soyad,1);
                $tbl->addRow($saticiad." ".$saticisoyad,2);
                $tbl->addRow(wordwrap($adres,35,"<br>"),3);
                $tbl->addRow($iadeler->get_kargo_ucret(),4);
                $tbl->addRow($iadeler->get_kargo_no(),5);

                $iade_onay=$iadeler->get_iade_durum();
                $iade_id=$iadeler->get_iade_id();

                if ($iade_onay==3) 
                  {?>
                    <td> </center> <?php
                    $form->Buttonhref2("Teslim Edildi",null);
                    ?> </td> </center> <?php
                  } 
                  else if ($iade_onay==2) 
                  {
                    $tbl->AddButton("../netting/islem.php?iade_id=".$iadeler->get_iade_id()."&iade_et=ok",6,"Ürün Kargoda","warning"); 
                  }
                  else if ($iade_onay==1) 
                  {
                    $tbl->AddButton("iade_duzenle.php?iade_id=".$iadeler->get_iade_id(),6,"Ürün İşlemleri Yapılıyor","warning"); 
                  }
                  else
                  {
                    ?>
                    <td><center> <?php
                    $form->Buttonhref2("Satıcı Teslim Etmedi",null,"danger");
                    ?> </td> </center><?php
                  }
                  $tbl->AddButton("iade_urun_detay.php?kullanici_id=".$iadecek['k_id']."&siparis_zaman=".$iadeler->get_siparis_zaman()."&siparis_id=".$iadeler->get_siparis_id(),7,"Detay","primary");
                  $tbl->AddButton("../../fatura/iade-fatura.php?siparis_zaman=".$iadeler->get_siparis_zaman()."&kullanici_id=".$iadecek['k_id']."&skullanici_id=".$iadecek['ks_id']."&siparis_id=".$iadeler->get_siparis_id(),8,"Fatura","success");
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