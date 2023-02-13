<?php 
//include başka php dosyalarını projemize çalıştığımız sayfaya dahil eder.
include 'header.php';
require_once '../netting/Istatistik.php';
require_once '../../services/chartDBServices.php';
$chartdbservices=new chartDBServices($dbsql,$cons);
$istatistik=new hesap();
function istatisitik_yaz($siparisyil=null,$cari_yil=null)
{
  $istatistik=new hesap();
  ?>
  <div class="row tile_count" style="width: 125%">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-pie-chart" aria-hidden="true"></i>
      Toplam Satış</span>
      <div class="count green"><?php echo number_format($istatistik->siparis($siparisyil,"satis"), 2, ',', '.'); ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-sort-asc" aria-hidden="true"></i>
      </i> Toplam Gelir</span>
      <div class="count green"><?php echo number_format($istatistik->siparis($siparisyil,"satis")+$istatistik->cari($cari_yil,"gelir"), 2, ',', '.'); ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-sort-desc" aria-hidden="true"></i>
      Toplam Gider</span>
      <div class="count red"><?php echo number_format($istatistik->siparis($siparisyil,"kargo")+$istatistik->cari($cari_yil,"gider"), 2, ',', '.'); ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-university" aria-hidden="true"></i>
      Kasa</span>
      <div class="count green"><?php echo number_format(($istatistik->siparis($siparisyil,"satis")+$istatistik->cari($cari_yil,"gelir"))-($istatistik->siparis($siparisyil,"kargo")+$istatistik->cari($cari_yil,"gider")), 2, ',', '.'); ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-university" aria-hidden="true"></i>
      Net Kasa</span>
      <div class="count"><?php echo number_format((($istatistik->siparis($siparisyil,"satis")+$istatistik->cari($cari_yil,"gelir"))-($istatistik->siparis($siparisyil,"kargo")+$istatistik->cari($cari_yil,"gider")))-(($istatistik->siparis($siparisyil,"satis")+$istatistik->cari($cari_yil,"gelir"))-($istatistik->siparis($siparisyil,"kargo")+$istatistik->cari($cari_yil,"gider")))*18/100, 2, ',', '.'); ?></div>
    </div>

  </div>
  <?php
}
?>

<?php 


if ($yetkide->yetkikontrol("index.php",$_SESSION['kullanici_id'])==0)
  { ?>


    <!-- page content -->
    <div class="right_col" role="main">
      <div class="raporla">

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Admin Panel <small> Panele Hoşgeldiniz.</small></h2>
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
                <p style="float: left;">Sitenizin içeriğini yanda ki menüler aracılığı ile yönetebilirsiniz.</p>
                <button style="float: right;" id="btnExport" onclick="RAPOR()">RAPORLA <i class="fa fa-pie-chart" aria-hidden="true"></i>

                </button>
              </div>
            </div>
          </div>
          <!-- Bitiyor -->
        </div>
        <div class="raporum">
         <div style="font-size: 45px;"><div style="font-size: 55px;"><center>ANALİZ</center></div> <br> Genel Cari Durum</div>
         <?php istatisitik_yaz(); ?>


         <div style="font-size: 45px;">Yıllık Cari Durum</div>
         <?php 
         $siparisyil=$chartdbservices->findSorguType("yıl");
         $cari_yil=$chartdbservices->findCariSorguType("gün");
         istatisitik_yaz($siparisyil,$cari_yil);
         ?>

         <div style="font-size: 45px;">Aylık Cari Durum</div>
         <?php 
         $siparisyil=$chartdbservices->findSorguType("ay");
         $cari_yil=$chartdbservices->findCariSorguType("gün");
         istatisitik_yaz($siparisyil,$cari_yil);
         ?>

         <div style="font-size: 45px;">Günlük Cari Durum</div>
         <?php 
         $siparisyil=$chartdbservices->findSorguType("gün");
         $cari_yil=$chartdbservices->findCariSorguType("gün");
         istatisitik_yaz($siparisyil,$cari_yil);
         ?>

         <?php 

         chart("Genel","canvas1"); 
         chart("Yıllık","canvas2",$chartdbservices->findSorguType("yıl")); 
         chart("Aylık","canvas3",$chartdbservices->findSorguType("ay")); 
         chart("Günlük","canvas4",$chartdbservices->findSorguType("gün")); 



         ?>





       </div>
     </div>
   </div>

 <?php } else { ?>


  <div class="right_col" role="main">
    <div class="raporla">

      <div class="clearfix"></div>

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Admin Panel <small> Panele Hoşgeldiniz.</small></h2>
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



              <p>Sitenizin içeriğini yanda ki menüler aracılığı ile yönetebilirsiniz.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>




<?php } ?>

</div>
</div>
<!-- /page content -->

<?php 
function chart($baslik,$canvas,$sorgu=null)
{
  $istatistik=new hesap();
  $renkler = array("#3498DB", "#26B99A", "#9B59B6", "#CFD4D8","#E74C3C","gold","olive","maroon");
  require_once '../netting/class.crud-guncel.php';
  $dbsql=new crud();
  $chartdbservices=new chartDBServices($dbsql,$cons);
  $katagorisor=$chartdbservices->kategoriSiraliListele();
  ?>
  <div class="raporum">
    <div class="x_panel tile fixed_height_320 overflow_hidden" style="width: 48%;float: left;margin-left: 20px;">
      <div class="x_title">
        <h2><?php echo $baslik; ?></h2>
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
        <table class="" style="width:100%">
          <tbody><tr>


          </tr>
          <tr>
            <td><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; inset: 0px;"></iframe>
              <canvas id="<?php echo $canvas; ?>" height="175" width="175" style="margin: 15px 10px 10px 0px; width: 140px; height: 140px;"></canvas>
            </td>
            <td>
              <table class="tile_info">
                <tbody>
                  <?php 
                  $say=0;
                  while($kategoricek=$chartdbservices->vericek($katagorisor))
                  {
                    $cons=new Sınıf_Islem();
                    $kategoriler=$cons->Kategori_ekle($kategoricek);
                    ?>
                    <tr>
                      <td>
                        <p><i style="color: <?php echo $renkler[$say]; ?>" class="fa fa-square"></i><?php echo $kategoriler->get_kategori_ad(); ?> </p>
                      </td>
                      <td style="padding-right: 120px;"><?php echo number_format($istatistik->kategorihesapla("toplam",$kategoriler->get_kategori_id(),$sorgu), 2, ',', '.');?></td>
                      <td>
                        <?php
                        if ($istatistik->kategorihesapla("genel_toplam",$kategoriler->get_kategori_id(),$sorgu)==0)
                          echo "<b>0<b>";
                        else
                         echo "<b>".number_format(($istatistik->kategorihesapla("toplam",$kategoriler->get_kategori_id(),$sorgu)*100)/$istatistik->kategorihesapla("genel_toplam",$kategoriler->get_kategori_id(),$sorgu), 2, '.', '')."<b>";
                       ?>
                     </td>
                   </tr>
                   <?php 
                   $say++;
                 } ?>
               </tbody></table>
             </td>
           </tr>
         </tbody></table>
       </div>
     </div>
   </div>
 <?php } ?>



 <?php include 'footer.php'; ?>

