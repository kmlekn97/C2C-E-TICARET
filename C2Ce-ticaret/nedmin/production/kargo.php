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
            <h2>Kargo Listeleme <small>

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
            $tbl->addcolumn("Sipariş Tarihi",0);
            $tbl->addcolumn("Alıcı Ad Soyad",1);
            $tbl->addcolumn("Satıcı Ad Soyad",2);
            $tbl->addcolumn("Adres",3);
            $tbl->addcolumn("Kargo Ücreti",4);
            $tbl->addcolumn("Kargo Kodu",5);
            $tbl->addcolumn("Teslim Durumu",6);
            $tbl->addcolumn("Detay",7);
            $tbl->addcolumn("",8);
            $tbl->TableBaslik();
            ?>

            <tbody>

              <?php 

              $arraylistkargo=array();
              $kargolist=new ArrayList($arraylistkargo);
              $kargolist=$admindbservices->kargoSiparisListele();
              $kargolist=$kargolist->toArray();
              foreach ($kargolist as $siparis_kargo) 
              {

                $siparissor2=$admindbservices->kullaniciGetir($siparis_kargo->get_kullanici_id());
                while($sipariscek2=$admindbservices->vericek($siparissor2)) {

                  $kullanicilarim=$cons->Kullanici_ekle($sipariscek2);
                  $ad=$kullanicilarim->get_kullanici_ad();
                  $soyad=$kullanicilarim->get_kullanici_soyad();
                  $adres=$kullanicilarim->get_kullanici_adres();
                }

                $siparissor4=$admindbservices->kullaniciGetir($siparis_kargo->get_kullanici_idsatici());

                while($sipariscek4=$admindbservices->vericek($siparissor4)) {

                 $satici=$cons->Kullanici_ekle($sipariscek4);
                 $saticiad=$satici->get_kullanici_ad();
                 $saticisoyad=$satici->get_kullanici_soyad();
               }



               ?>


               <tr>
                <?php
                $tbl->addRow($siparis_kargo->get_siparis_zaman(),0);
                $tbl->addRow($ad." ".$soyad,1);
                $tbl->addRow($saticiad." ".$saticisoyad,2);
                $tbl->addRow(wordwrap(html_entity_decode($adres),35,"<br>"),3);
                $tbl->addRow($siparis_kargo->get_siparis_kargoucret(),4);
                $tbl->addRow($siparis_kargo->get_siparisdetay_kargono(),5);

                $siparis_detay_onay=$siparis_kargo->get_siparisdetay_onay();
                $siparis_detay_id=$siparis_kargo->get_siparisdetay_id();

                if ($siparis_detay_onay==3) 
                {
                  ?>
                  <td><center><?php
                  $form->Buttonhref2("Teslim Edildi",null);
                  ?></center></td><?php
                } 
                else if ($siparis_detay_onay==2) 
                  {?><center><?php
                    $tbl->AddButton("../netting/islem.php?siparisdetay_id=".$siparis_kargo->get_siparisdetay_id()."&teslim_et=ok",6,"Ürün Kargoda","warning");
                    ?></center><?php
                  }
                  else if ($siparis_detay_onay==1) 
                  {
                    ?><center><?php
                    $tbl->AddButton("kargo_duzenle.php?siparisdetay_id=".$siparis_kargo->get_siparisdetay_id(),6,"Ürün İşlemleri Yapılıyor","warning");
                    ?></center><?php
                  }

                  else
                  {
                    ?>
                    <td><center><?php
                    $form->Buttonhref2("Satıcı Teslim Etmedi",null,"danger");?>
                    </center></td><?php
                  }
                  ?>



                  <td><center><a href="siparis-detay.php?kullanici_id=<?php echo $sipariscek['k_id'] ?>&siparis_zaman=<?php echo $siparis_kargo->get_siparis_zaman(); ?>&siparis_id=<?php echo $siparis_kargo->get_siparisdetay_id(); ?>"><button class="btn btn-primary btn-xs">Detay</button></a></center></td>




                  <td><center><a href="../netting/islem.php?siparis_id=<?php echo $siparis_kargo->get_siparisdetay_id(); ?>&siparissil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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