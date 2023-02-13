<?php 

include 'header.php'; 
require_once 'CLASS/Cari_Islem.php';


$Gelir=0;
$Gider=0;
//Belirli veriyi seçme işlemi

$hesapsiparissor=$admindbservices->HesapSiparisGetir();
$toplamcek=$admindbservices->Cari_TOPLAM_Hesapla();
$cari_islem=$cons->Cari_Islem_ekle($hesapcek,$toplamcek);

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

          </div>
          <div class="x_content">

            <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
            <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </button>

            <br>
            <br>


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

             <?php

             $tbl=new CreateTable(7);
             $tbl->addcolumn("S.No",0);
             $tbl->addcolumn("İşlem Tipi",1);
             $tbl->addcolumn("Hesap Adı",2);
             $tbl->addcolumn("işlem Tarih",3);
             $tbl->addcolumn("Hesap IBAN",4);
             $tbl->addcolumn("Miktar",5);
             $tbl->addcolumn("Açıklama",6);
             $tbl->TableBaslik();

             ?>

             <tbody>

              <?php 

              $say=0;
              $arraylisthesap=array();
              $hesaplist=new ArrayList($arraylisthesap);
              $hesaplist=$admindbservices->CariIslemcek($toplamcek);
              $hesaplist=$hesaplist->toArray();
              foreach ($hesaplist as $cari_islem) 
              {

               $say++;
               ?>
               <tr>
                <?php
                $tbl->addRow($say,0,"20");

                ?>
                <td>
                  <?php if ($cari_islem->get_islem_tip()=="Gelir")
                  {
                    $Gelir+=$cari_islem->get_islem_ucret();
                    ?>
                    <button class="btn btn-success btn-xs"><?php echo $cari_islem->get_islem_tip(); ?></button>
                  <?php }else {
                    $Gider+=$cari_islem->get_islem_ucret();
                    ?>
                    <button class="btn btn-danger btn-xs"><?php echo $cari_islem->get_islem_tip() ?></button>
                  <?php } ?>
                </td>
                <?php
                $tbl->addRow($cari_islem->get_hesap_adi(),1);
                $tbl->addRow($cari_islem->get_islem_tarih(),2);
                $tbl->addRow($cari_islem->get_hesap_iban(),3);
                $tbl->addRow($cari_islem->get_islem_ucret(),4);
                $tbl->addRow($cari_islem->get_islem_aciklama(),5);

                ?> 

              </tr>
              <?php
              while($hesapsipariscek=$admindbservices->vericek($hesapsiparissor)) {
                $say++;
                $hesapsiparis=$cons->Siparis_Detay_ekle($hesapsipariscek);

                $kullanicilarim=$cons->Kullanici_ekle($hesapsipariscek);

                $kategorim=$cons->Kategori_ekle($hesapsipariscek);
                ?>

                <tr>
                 <td width="20"><?php echo $say; ?></td>
                 <td>
                  <button class="btn btn-success btn-xs"><?php echo "Gelir" ?></button>
                </td>
                <td><?php echo $kullanicilarim->get_magaza_adi(); ?></td>
                <td><?php echo $hesapsiparis->get_siparis_zaman(); ?></td>
                <td><?php echo $kullanicilarim->get_kullanici_iban(); ?></td>
                <td><?php echo number_format(($hesapsiparis->get_urun_fiyat()*$hesapsiparis->get_urun_adet())*$kategorim->get_kategori_oran()/100   , 2, ',', '.'); ?></td>
                <td><?php echo "Satış Raporu" ?></td>

              </tr>


              <tr>
                <?php
                $tbl->addRow($say,0,"20");
                ?>
                <td>
                  <button class="btn btn-danger btn-xs"><?php echo "Gider" ?></button>
                </td>
                <?php 
                $tbl->addRow($cari_islem->get_hesap_adi(),1);
                $tbl->addRow($hesapsiparis->get_siparis_zaman(),2);
                $tbl->addRow($cari_islem->get_hesap_iban(),3);
                $tbl->addRow(number_format($hesapsiparis->get_siparis_kargoucret(), 2, ',', '.'),4);
                $tbl->addRow("Kargo Raporu",5);
                ?>

              </tr>




            <?php }

            ?>

          <?php  }

          ?>


        </tbody>
      </table>

      <!-- Div İçerik Bitişi -->

    </div>
  </div>
  <div style="float: right;font-size: 25px;">
    <b>
      Satıcı Gelir:
    </b>
    <?php echo number_format($cari_islem->get_gelir(), 2, ',', '.'); ?>
    <br>
    <b>
      Toplam Gelir:
    </b>
    <?php echo number_format($cari_islem->get_gelir()+$Gelir, 2, ',', '.'); ?>
    <br>
    <b>
      Kargo Gider:
    </b>
    <?php echo number_format($cari_islem->get_kargogider(), 2, ',', '.'); ?>
    <br>
    <b>
      Toplam Gider:
    </b>
    <?php echo number_format($cari_islem->get_kargogider()+$Gider, 2, ',', '.'); ?>
    <br>
    <b>
      Kasa:
      <?php echo number_format(($cari_islem->get_gelir()+$Gelir)-($cari_islem->get_kargogider()+$Gider), 2, ',', '.'); ?>
    </b>
    <br>
    <b>
      Kasa KDV:
      <?php echo number_format((($cari_islem->get_gelir()+$Gelir)-($cari_islem->get_kargogider()+$Gider))*18/100, 2, ',', '.'); ?>
    </b>
    <br>
    <b>
      Net Kasa:
      <?php echo number_format((($cari_islem->get_gelir()+$Gelir)-($cari_islem->get_kargogider()+$Gider))-(($cari_islem->get_gelir()+$Gelir)-($cari_islem->get_kargogider()+$Gider))*18/100, 2, ',', '.'); ?>
    </b>
  </div>
</div>
</div>
</div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
