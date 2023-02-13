<?php 
require_once 'header.php'; 


$kullanicisor=$dbservice->usersaticigetir();
$say=$kullanicisor->rowCount();

if ($say==0) {

 Header("Location:404.php");
}

$kullanicicek=$dbservice->vericek($kullanicisor);
$kullanicilarim=$cons->Kullanici_ekle($kullanicicek);

?>
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
  <div class="container">

  </div>
</div>
<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Profile Page Start Here -->
<div class="profile-page-area bg-secondary section-space-bottom">                
  <div class="container">
    <div class="row">

      <!-- Ust Banner User -->
      <?php require_once 'user-header.php' ?>

      <!-- User Üst Banner -->

      <?php 

      $deger=$dbservice->SaticiPuanHesapla($_GET['kullanici_id']);
      $puan=floor($deger);

      ?>
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
        <div class="fox-sidebar">
          <div class="sidebar-item">
            <div class="sidebar-item-inner">
              <h3 class="sidebar-item-title"> Satıcı   &nbsp;&nbsp; &nbsp;<?php if ($deger>=4)
              {?>
                <div type="button" title="Mağaza Puan" class="btn btn-success btn-xs"> <?php echo $deger;?></div>
              <?php } 
              else if ($deger>=2.5)
                {?>
                  <div type="button"  title="Mağaza Puan" class="btn btn-warning btn-xs"> <?php echo $deger;?></div>
                <?php } 
                else
                  {?>
                    <button type="button"  title="Mağaza Puan" class="btn btn-danger btn-xs"> <?php echo $deger;?></button>
                    <?php } ?></h3>

                    <div class="sidebar-author-info">
                      <div class="sidebar-author-img">
                        <img src="<?php echo $kullanicilarim->get_kullanici_magazafoto(); ?>" alt="product" class="img-responsive">
                      </div>
                      <div class="sidebar-author-content">
                        <h3><?php echo $kullanicilarim->get_magaza_adi()." "?></h3>




                        <?php 





                        $kullanici_sonzaman= strtotime($kullanicicek['kullanici_sonzaman']);

                        $suan=time();

                        $fark=($suan-$kullanici_sonzaman);

                        if ($fark<6) {?>

                          <a href="#" class="view-profile"><i class="fa fa-circle" aria-hidden="true"></i> online</a>

                        <?php } else {?>


                          <a href="#" class="view-profile"><i style="color:red" class="fa fa-circle" aria-hidden="true"></i> offline</a>

                        <?php }
                        ?>




                      </div>
                    </div>



                    <ul class="sidebar-badges-item">
                      <?php 

                      $saycek=$dbservice->SaticitotalsatisHesapla($_GET['kullanici_id']);

                      if ($saycek['say']>1 and $saycek['say']<=9) {?>

                        <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>

                      <?php }  else if ($saycek['say']>9 and $saycek['say']<=99) {?>

                        <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>

                      <?php }  else if ($saycek['say']>99 and $saycek['say']<=999) {?>

                        <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>

                      <?php }  else if ($saycek['say']>999 and $saycek['say']<=9999) {?>

                        <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>

                      <?php }  else if ($saycek['say']>9999) {?>

                        <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                        <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>

                      <?php }?>







                    </ul>
                  </div>
                </div>

                <ul class="sidebar-product-btn">


                 <?php 

                 if (empty($_SESSION['userkullanici_id'])) {?>

                   <li><a href="login" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj Gönder</a></li>

                 <?php }

                 else if ($_SESSION['userkullanici_id']==htmlspecialchars($_GET['kullanici_id'])) {?>

                   <li><button disabled=""  class="buy-now-btn" id="buy-button"><i class="fa fa-ban" aria-hidden="true"></i> Mesaj Gönder</button></li>

                 <?php } else {?>

                   <li><a href="mesaj-gonder?kullanici_gel=<?php echo htmlspecialchars($_GET['kullanici_id']) ?>" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj Gönder</a></li>

                 <?php } ?>
               </ul>



             </div>
           </div>                                                
         </div>


         <div  class="row profile-wrapper">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
           <?php require_once 'user-sidebar.php' ?>
         </div>

         <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12"> 
          <div class="tab-content">



            <div class="tab-pane fade active in" id="Products">
              <h3 class="title-inner-section">Ürünleri</h3>
              <div class="inner-page-main-body"> 
               <div class="row more-product-item-wrapper">

                <?php 

                $urunsor=$dbservice->saticiUrunleriGetir();


                while($uruncek=$dbservice->vericek($urunsor)) { 
                  $urunlerim=$cons->Urun_ekle($uruncek);
                  $kategorilerim=$cons->Kategori_ekle($uruncek);
                  ?>


                  <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                    <div class="more-product-item">
                      <div class="more-product-item-img">
                        <a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
                          <img style="width: 100px; height: 90px;" src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>" alt="<?php echo $urunlerim->get_urun_ad() ?>" class="img-responsive">
                        </a>
                      </div>
                      <div class="more-product-item-details">
                        <h4><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><?php echo mb_substr($urunlerim->get_urun_ad(), 0,20,'UTF-8') ?></a></h4>
                        <div class="p-title"><?php echo $kategorilerim->get_kategori_ad() ?></div>
                        <div class="p-price"><?php echo $urunlerim->get_urun_fiyat(); ?> TL</div>
                      </div>

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

                   </div>
                    <div class="more-product-item">
                       <ul class="default-rating">
                         <?php include 'rating.php'; ?>
                       </ul>
                     </div>
                 </div> 


               <?php } ?>



             </div>
                        <!--<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="pagination-align-left">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                            </div>  
                          </div>-->
                        </div> 
                      </div>

                    </div> 
                  </div>  
                </div>
              </div>
            </div>
            <!-- Profile Page End Here -->            
            <?php 
            require_once 'footer.php'; 

          ?>