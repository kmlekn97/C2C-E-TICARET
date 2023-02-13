<?php 
require_once 'header.php'; 
$s;
/*if (empty($_POST)) {
   
   Header("Location:404.php");
   exit;
}
*/
require_once 'nedmin/netting/kategori-sorgula.php';
$ksorgu=new Kategori();
if (isset($_POST['searchkeyword']))
{
  $searchkeyword=htmlspecialchars(trim($_POST['searchkeyword']));
}
else
{
  $searchkeyword=htmlspecialchars(trim($_GET['arama']));
}
$kategorilerim=$dbservice->aramaListelemetekil($searchkeyword);
$kategorim=$kategorilerim->get_kategori_id();

if (!isset($_GET['sayfa']))
{
  ?>
  <script type="text/javascript">
    var kategori_id="&kategori_id="+<?php echo $kategorilerim->get_kategori_id();  ?>;
    history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id); 
    $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+' .product-list-view');
  </script>
  <?php
}

$sayfada = 2;
$sorgu=$dbservice->PacinationArama($searchkeyword);
$toplam_icerik=$sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;

?>


<!-- Header Area End Here -->
<?php require_once 'search.php' ?>
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Product Page Grid Start Here -->
<div class="product-page-list bg-secondary section-space-bottom">                
  <div class="container">
    <div class="row">                        
      <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
        <div class="inner-page-main-body">
          <div class="page-controls">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                <div class="page-controls-sorting">
                  <div class="dropdown">
                    <!--<button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Default Sorting<i class="fa fa-sort" aria-hidden="true"></i></button>-->
                    <ul class="dropdown-menu">
                      <li><a href="#">Date</a></li>
                      <li><a href="#">Best Sale</a></li>
                      <li><a href="#">Rating</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                <div class="layout-switcher">
                  <ul>
                    <!--<li><a href="#gried-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large"></i></a></li>-->    
                    <li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <form action="nedmin/netting/islem.php" method="POST" class="form-horizontal" id="personal-info-form">

            <div class="sirala-aramam" style="float: right;background: #9ACD32;width: 14rem;">
              <select name="sirala-arama" id="sirala-arama"  class='select2'>  
                <option value="RastgeleSırala">Rastgele Sırala</option>
                <option value="FiyataGöreArtan">Fiyata Göre Artan</option>
                <option value="FiyataGöreAzalan">Fiyata Göre Azalan</option>
                <option value="EnYeniler">En Yeniler</option>
                <option value="EnÇokSatanlar">En Çok Satanlar</option>
                
              </select>
            </div>
          </form>  

          <div class="bosluk" style="margin-top: 6rem;"></div>
          <div class="tab-content">
            <div id="renklerim"></div>
            <div id="fiyatlarim"></div>
            <div id="bedenim"></div>
            <div id="markam"></div>
            <div id="temizle-arama" style="margin-bottom: 1rem;">

              <button type="button" class="btn btn-default">Tümünü Kaldır</button>
            </div>
            
            <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
              <div class="product-list-view">

                <?php 
                if (isset($_GET['arama'])) {

                 $searchkeyword=htmlspecialchars(trim($_GET['arama']));
                 $kategorilerim=$dbservice->aramaListelemetekil($searchkeyword);
                 $kategorim=$kategorilerim->get_kategori_id();
                 $toplam_urun=0;
                 $durum=0;
                 $sira="";
                 if (htmlspecialchars($_get['kategori_id'])==13 || $kategorim==13)
                 {
                  $sira=$dbservice->SiralamaSorguelektronik($sira);
                }
                else
                {
                  $sira=$dbservice->SiralamaSorgu($sira);
                }

                if (htmlspecialchars(isset($_GET['siralama'])))
                {
                  if (htmlspecialchars($_GET['siralama'])=="ASC") {
                  }
                  else if (htmlspecialchars($_GET['siralama'])=="DESC") {
                  }
                  else if (htmlspecialchars($_GET['siralama'])=="yeni") {
                  }
                  else
                  {
                    $urunsor=$dbservice->aramacoksatan($searchkeyword,$sira,$sayfada,$limit);
                    $adet=$dbservice->pagearamaadet($searchkeyword,$sira);
                    $say=$urunsor->rowCount();
                    $toplam_urun=$urunsor->rowCount();

                    $durum=1;

                    if ($say==0) {
                    }
                  }
                }

                $wherearama=$dbservice->SorguAramam($searchkeyword,$sira);

                if ($durum==0)
                {
                  $sorgu=$dbservice->siraliaramasorgu($wherearama,$limit,$sayfada);
                  $urunsor=$dbservice->siraliaramaurunlistesi($searchkeyword,$sira,$limit,$sayfada);
                  $adet=$dbservice->pagearamaadet($searchkeyword,$sira);
                  $say=$sorgu->rowCount();
                  $toplam_urun=$urunsor->rowCount();

                  if ($say==0) {
                                           //echo "Ürün Bulunamadı";
                   exit();
                 }
               }
             } 

             $where="";
             $where.=$ksorgu->sorgula($kategorim,0,null); 

             if($ksorgu->adet>0)
             {
               $searchkeyword=htmlspecialchars(trim($_GET['arama']));
               $durum=0;
               $sira="";
               if ($sira=="")
               {
                 if (htmlspecialchars($_get['kategori_id'])==13 || $kategorim==13)
                 {
                   $sira=$dbservice->SiralamaSorguelektronik($sira);
                 }
                 else
                 {
                  $sira=$dbservice->SiralamaSorgu($sira);
                }
                
              }
              if (htmlspecialchars(isset($_GET['siralama'])))
              {
                if (htmlspecialchars($_GET['siralama'])=="ASC") {
                }
                else if (htmlspecialchars($_GET['siralama'])=="DESC") {
                }
                else if (htmlspecialchars($_GET['siralama'])=="yeni") {
                }
                else
                {
                 $urunsor=$dbservice->siraliaramasorgulucoksatan($where,$searchkeyword,$sira,$limit,$sayfada);
                 $durum=1;
                 $adet=$dbservice->pagearamaadet($searchkeyword,$sira,$where,"dfs");
                 $toplam_urun=$urunsor->rowCount();
               }
             }

             if ($durum==0)
             {

              $urunsor=$dbservice->aramakosulluurunlisteleme($searchkeyword,$sira,$where,$limit,$sayfada);
            }
            $adet=$dbservice->pagearamaadet($searchkeyword,$sira,$where,"dfs");
            $say=$urunsor->rowCount();
            $toplam_urun=$urunsor->rowCount();
            if ($say==0) {
              echo "<b>Ürün Bulunamadı</b>";
              exit();
            }
          } 
          if (htmlspecialchars(isset($_POST['searchsayfa']))) {

            $searchkeyword=htmlspecialchars(trim($_POST['searchkeyword']));

            $wherearama=$dbservice->SorguAramam($searchkeyword,null);

            $sorgu=$dbservice->siraliaramasorgugroupby($wherearama,$limit,$sayfada);

            if ($kategorim==13)
            {

              $urunsor=$dbservice->aramakosulsuzsiraliurunlistelemegroupby($searchkeyword,$limit,$sayfada);
              $adet=$dbservice->pagearamaadet($searchkeyword,$sira);
              $say=$sorgu->rowCount();
              $toplam_urun=$urunsor->rowCount();

              if ($say==0) {
              }
            }

            else
            {
              $urunsor=$dbservice->aramakosulsuzsiraliurunlistelemegroupby($searchkeyword,$limit,$sayfada);
              $adet=$dbservice->pagearamaadet($searchkeyword,$sira);
              $say=$sorgu->rowCount();
              $toplam_urun=$urunsor->rowCount();

              if ($say==0) {
              }
            }
          } 

          $where="";
          $where.=$ksorgu->sorgula($kategorim,0,-1); 

          if($ksorgu->adet>0)
          {
            $searchkeyword=htmlspecialchars(trim($_GET['arama']));
            $durum=0;
            $sira="";
            if (htmlspecialchars($_get['kategori_id'])==13 || $kategorim==13)
            {
              $sira=$dbservice->SiralamaSorguelektronik($sira);
            }
            else
            {
             $sira=$dbservice->SiralamaSorgu($sira);
           }

           if (htmlspecialchars(isset($_GET['siralama'])))
           {
            if (htmlspecialchars($_GET['siralama'])=="ASC") {
            }
            else if (htmlspecialchars($_GET['siralama'])=="DESC") {
            }
            else if (htmlspecialchars($_GET['siralama'])=="yeni") {
            }
            else
            {
             $urunsor=$dbservice->siraliaramasorgulucoksatan($where,$searchkeyword,$sira,$limit,$sayfada);
             $adet=$dbservice->pagearamaadet($searchkeyword,$sira,$where,"dfs");
             $toplam_urun=$urunsor->rowCount();
             $durum=1;
           }
         }
         if ($durum==0)
         {
          $urunsor=$dbservice->aramakosulluurunlisteleme($searchkeyword,$sira,$where,$limit,$sayfada);
          $adet=$dbservice->pagearamaadet($searchkeyword,$sira,$where,"dfs");
          $say=$urunsor->rowCount();
          $toplam_urun=$urunsor->rowCount();
          $durum=1;
          if ($say==0) {
          }
        }
      } 

      echo "<b> $adet Adet Ürün Listelendi...</b> <br>";

      $toplam_icerik=$adet;
      $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
      $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
      if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
      if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
      $limit = ($sayfa - 1) * $sayfada;

      while($uruncek=$dbservice->uruncek($urunsor)) {                     
        $urunlerim=$cons->Urun_ekle($uruncek);
        $kategorilerim=$cons->Kategori_ekle($uruncek);
        $kullanicilarim=$cons->Kullanici_ekle($uruncek);

        ?>

        <div class="single-item-list">

          <div class="item-img">
            <a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><img style="width: 238px; height: 178px;" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>" alt="<?php echo $urunlerim->get_urun_ad() ?>" class="img-responsive"></a>
            <!-- <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>-->
          </div>
          <div class="item-content">
            <div class="item-info">
              <div class="item-title">
                <h3><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
                 <?php
                 $arraylist=array();
                 $renklist=new ArrayList($arraylist);
                 $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                 $renkliste=$renkliste->toArray();
                 foreach ($renkliste as $renklerim) 
                 {
                  $renk=$renklerim->get_renk_adi();
                }

                $urunadsor=$dbservice->urunadsorliste($urunlerim->get_urun_id());

                $say=$urunadsor->rowCount();
                $toplam_urun=$urunsor->rowCount();
                while($urunadcek=$dbservice->uruncek($urunadsor)) {

                  $urunlerim=$cons->Urun_ekle($urunadcek);
                  $ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
                  $ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
                  $detay=$ozellik_detaylarim->get_ozellik_detay();

                  if (isset($detay))
                    $kapasite=$detay." GB ";

                }
                if ($say==0)
                  $kapasite="";

                $arraylistmarka=array();
                $markalist=new ArrayList($arraylistmarka);
                $markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
                $markalist=$markalist->toArray();
                foreach ($markalist as $markalarim)
                {
                  ?>
                  <strong>
                    <?php echo $markalarim->get_marka_adi(); 

                    ?>
                  </strong>


                <?php } ?>



                <?php   echo " ".$urunlerim->get_urun_ad()." ".$kapasite." ".$renk; ?></a></h3>
                <span><?php echo $kategorilerim->get_kategori_ad(); ?></span>
              </div>
              <div class="item-sale-info">
                <div class="price"><?php echo $urunlerim->get_urun_fiyat() ?> <span style="font-size:12px;">TL</span></div>
                <div class="sale-qty"> <?php 



                echo "Satış ( ".$dbservice->SatisAdetHesapla($urunlerim->get_urun_id())." )";

              ?></div>
            </div>
          </div>
          <?php
          
          $mkullanici=$dbservice->magazabilgi($urunlerim->get_urun_id());
          ?>
          <div class="item-profile">
            <div class="profile-title">
              <div class="img-wrapper"><img src="<?php echo $mkullanici->get_kullanici_magazafoto() ?>" height="50rem;" width="50rem;" alt="profile" class="img-responsive img-circle"></div>
            </div>
            <a href="satici-<?=seo($mkullanici->get_kullanici_ad()."-".$mkullanici->get_kullanici_soyad())."-".$mkullanici->get_kullanici_id() ?>">
              <br>
              <?php echo $kullanicilarim->get_magaza_adi(); ?></a>
              <?php

              $arraylistpuan=array();
              $puanlist=new ArrayList($arraylistpuan);
              $puanlist=$dbservice->PuanHesapla($urunlerim->get_urun_id());
              $puanlist=$puanlist->toArray();
              foreach ($puanlist as $puanlarim)
              {
               $yorum_adet=$puanlarim;
               $deger=$puanlarim;
               $puan=$puanlarim;
             }?>
             <div class="profile-rating-info">
              <ul>
                <li>
                  <ul class="profile-rating">
                   <?php include 'rating.php'; ?>
                 </ul>
               </li>
               <li><i class="fa fa-comment-o" aria-hidden="true"></i>( <?php echo $yorum_adet; ?> )</li>

             </ul>
           </div>

         </div>
       </div>
     </div>



   <?php } ?>

   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <ul class="pagination-align-left">

        <?php

        $s=0;
        while ($s < $toplam_sayfa) {

          if (!isset($searchkeyword))
          {
            $searchkeyword=$_GET['arama'];
          }

          $s++; 
          $id=$_GET['kategori_id'];
          $link=$_SERVER['REQUEST_URI'];
          $metinbol=explode("?",$link);
          if (isset($metinbol))
          {
            $link=$metinbol[1];
          }
          if (!isset($_GET['arama'])){
            $link="&arama=$searchkeyword&kategori_id=".$kategorilerim->get_kategori_id();
          }
          $link=str_replace("&sayfa=".$_GET['sayfa'],"",$link);
          if (!empty($id)) {  

            if ($s==$sayfa) {

              ?>

              <li class="active"><a href="<?php echo "arama-detay?&sayfa=".$s.$link ?>"><?php echo $s; ?></a></li>


            <?php } 
            else 
            {
              ?>



              <li class="active"><a href="<?php echo "arama-detay?&sayfa=".$s.$link ?>"><?php echo $s; ?></a></li>


            <?php   }


          } else {


            if ($s==$sayfa) {?>



             <li class="active"><a href="<?php echo "arama-detay?&sayfa=".$s.$link ?>"><?php echo $s; ?></a></li>



           <?php } else { ?>

             <li class="active"><a href="<?php echo "arama-detay?&sayfa=".$s.$link ?>"><?php echo $s; ?></a></li>



           <?php   }


         }
       }
       ?>

     </ul>
   </div>  
 </div>


</div>
</div>                               
</div>                                
</div>
</div>


<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">

  <?php require_once 'sidebararama.php' ?>
</div>
</div>
</div>
</div>
<!-- Product Page Grid End Here -->
<?php 
require_once 'footer_sorgulu.php'; 

?>