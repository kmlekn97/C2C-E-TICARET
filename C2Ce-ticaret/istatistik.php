
<?php 

require_once 'header.php'; 

islemanakontrol();

require_once 'nedmin/netting/Istatistik.php';
$istatistik=new hesap();

?>

<!-- Header Area End Here -->

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">



    <div class="row settings-wrapper">


      <?php require_once 'hesap-sidebar.php' ?>


      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

        <div class="settings-details tab-content" style="width: 120%">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">İSTATİSTİK</h2>
            <div class="personal-info inner-page-padding" id="rapor"> 
              <div class="row tile_count" style="width: 120%;margin-left: 10%;margin-right: 10%" id="rapor">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                  Toplam Satış</span>
                  <div class="count green" style="font-size: 30px;"><?php echo number_format($istatistik->satici_siparis(null,$_SESSION['userkullanici_id']), 2, ',', '.'); ?></div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                  Yıllık Satış</span>
                  <div class="count green" style="font-size: 30px;"><?php echo number_format($istatistik->satici_siparis("and YEAR(siparis_detay.siparisdetay_kargozaman)=YEAR(CURDATE())",$_SESSION['userkullanici_id']), 2, ',', '.'); ?></div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                  Aylık Satış</span>
                  <div class="count green" style="font-size: 30px;"><?php echo number_format($istatistik->satici_siparis("and MONTH(siparis_detay.siparisdetay_kargozaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())",$_SESSION['userkullanici_id']), 2, ',', '.'); ?></div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-pie-chart" aria-hidden="true"></i>
                  Günlük Satış</span>
                  <div class="count green" style="font-size: 30px;"><?php echo number_format($istatistik->satici_siparis("and DAY(siparis.siparis_zaman)=DAY(CURDATE()) AND MONTH(siparis.siparis_zaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())",$_SESSION['userkullanici_id']), 2, ',', '.'); ?></div>
                </div>
              </div>
              <button style="float: right;" id="btnExport" onclick="RAPOR()">RAPORLA <i class="fa fa-pie-chart" aria-hidden="true"></i>

              </button>

              <br>
              <br>
              <table class="table table-striped" id="rapor">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sipariş No</th>
                    <th scope="col">Alıcı</th>
                    <th scope="col">Ürün Ad</th>
                    <th scope="col">Marka</th>
                    <th scope="col">Ürün Fiyat</th>
                    <th scope="col">Adet</th>
                  </tr>

                </thead>
                <tbody>
                  <?php 
                  $siparissor=$dbservice->istatistiksiparisListele();

                  $say=0;

                  while($sipariscek=$dbservice->vericek($siparissor)) { 

                    $siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
                    $kullanicilarim=$cons->Kullanici_ekle($sipariscek);
                    $urunlerim=$cons->Urun_ekle($sipariscek);
                    $say++;
                   ?>



                   <tr>
                    <td scope="row"><?php echo $say ?></td>
                    <td><?php echo $siparis_detaylarim->get_siparisdetay_kargozaman(); ?></td>
                    <td><?php echo $siparis_detaylarim->get_siparis_id(); ?></td>
                    <td><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad() ?></td>
                    <td><?php

                    $renksor=$dbsql->wread("renkler","renk_id",htmlspecialchars($urunlerim->get_renk_id()));
                    $renkcek=$renksor->fetch(PDO::FETCH_ASSOC);
                    $renklerim=$cons->Renk_ekle($renkcek);

                    $bedensor=$dbsql->wread("beden","beden_id",htmlspecialchars($urunlerim->get_beden_id()));
                    $bedencek=$bedensor->fetch(PDO::FETCH_ASSOC);
                    $bedenlerim=$cons->Beden_ekle($bedencek);

                    echo $renklerim->get_renk_adi()." ".$urunlerim->get_urun_ad()." ".$bedenlerim->get_beden_icerik(); ?></td>
                    <td>  <?php 
                    $markasor=$dbsql->wread("marka","marka_id",$urunlerim->get_marka_id());
                    $markacek=$markasor->fetch(PDO::FETCH_ASSOC);
                    $markalarim=$cons->Marka_ekle($markacek);


                    echo $markalarim->get_marka_adi(); ?>


                  </td>
                  <td><?php echo number_format($sipariscek['satis_fiyat'], 2, ',', '.'); ?></td>
                  <td><?php echo $siparis_detaylarim->get_urun_adet();?></td>

                </tr>


              <?php } ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Yıllık Satış</b></td>
                <td><b>Aylık Satış</b></td>
                <td><b>Günlük Satış</b></td>
                <td><b>Toplam Satış</b></td>
                <td></td>
              </tr>

              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo number_format($istatistik->satici_siparis($dbservice->IstatistikSorguType("yıl"),$_SESSION['userkullanici_id']), 2, ',', '.'); ?></td>
                <td><?php echo number_format($istatistik->satici_siparis($istatistik->satici_siparis($dbservice->IstatistikSorguType("ay"),$_SESSION['userkullanici_id']), 2, ',', '.')); ?></td>
                <td><?php echo number_format($istatistik->satici_siparis($istatistik->satici_siparis($dbservice->IstatistikSorguType("gün"),$_SESSION['userkullanici_id']), 2, ',', '.')); ?></td>
                <td><?php echo number_format($istatistik->satici_siparis(null,$_SESSION['userkullanici_id']), 2, ',', '.');?></td>
                <td></td>
              </tr>
            </tbody>
          </table>




        </div> 
      </div> 



    </div> 


  </div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->




<?php require_once 'footer.php'; ?>
