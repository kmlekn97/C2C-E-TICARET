                <?php 
                if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

                    exit("Bu sayfaya erişim yasak");

                }
                ?>
                <div class="container">
                    <h2 class="title-default">Çok Satanlar</h2>  
                </div>
                <div class="container=fluid">
                    <div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">

                     <?php 

                     $urunsor=$dbservice->urunlistecoksatan();

                     while($uruncek=$dbservice->uruncek($urunsor)) { 

                        $urunlerim=$cons->Urun_ekle($uruncek);
                        $kategoriler=$cons->Kategori_ekle($uruncek);
                        $kullanicilarim=$cons->Kullanici_ekle($uruncek);


                        ?>


                        <!-- Çok Satanlar Start -->
                        <div class="single-item-grid">
                            <div class="item-img">
                                <a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><img style="width: 451px; height: 385px;" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>" alt="product" class="img-responsive"></a>
                                <div class="trending-sign" data-tips="Çok Satan Ürün"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                            </div>
                            <div class="item-content"  style="word-wrap:break-word;">
                                <div class="item-info">
                                    <h3><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"> 


                                     <?php
                                     $arraylistrenk=array();
                                     $renklist=new ArrayList($arraylistrenk);
                                     $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                                     $renkliste=$renkliste->toArray();
                                     foreach ($renkliste as $renklerim) 
                                     {
                                        $renk=$renklerim->get_renk_adi();
                                    }
                                    $urunadsor=$dbservice->urunadsorliste($urunlerim->get_urun_id());

                                    $say=$urunadsor->rowCount();
                                    while($urunadcek=$dbservice->urunadcek($urunadsor)) {

                                        $urunlerim=$cons->Urun_ekle($urunadcek);
                                        $ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
                                        $ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
                                        $detaylarim=$ozellik_detaylarim->get_ozellik_detay();


                                        if (isset($detaylarim))
                                            $kapasite=$detaylarim." GB ";

                                    }
                                    if ($say==0)
                                        $kapasite="";


                                    ?>


                                    <?php 
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
                                        <?php

                                        $yazi=$urunlerim->get_urun_ad();
                                        $detay = $yazi;
                                                    //Var olan metin içindeki karakter sayısı
                                        $uzunluk = strlen($detay);
                                                    //Kaç Karakter Göstermek İstiyorsunuz
                                        $limit = 48;
                                                    //Uzun olan yer "devamı..." ile değişecek.
                                        if ($uzunluk > $limit) {
                                            $detay = substr($detay,0,$limit);
                                            echo " ".$detay." ".$kapasite." ".$renk."...<br>";
                                        }           
                                        else

                                           echo " ".$detay." ".$kapasite." ".$renk."<br>"; ?>
                                   </a></h3>
                               <?php } ?>

                               <span><a href="kategoriler-<?=seo($kategoriler->get_kategori_ad())."-".$urunlerim->get_kategori_id() ?>"><?php echo $kategoriler->get_kategori_ad() ?></a></span>
                               <div class="price" style="float: left;">
                                <br>
                                <br>
                                <br>
                                <?php 

                                $fiyat=$urunlerim->get_urun_fiyat(); 
                                $yedek_fiyat=number_format($urunlerim->get_urun_fiyat_yedek(), 2, ',', '.');
                                $tl_formati = number_format($fiyat, 2, ',', '.'); 
                                if ($urunlerim->get_urun_fiyat_yedek() == NULL)
                                   {?>
                                       <div style="float: left;height: 3px;"><?php echo "<br><br>".$tl_formati; ?> TL </div>

                                       <?php
                                   }
                                   else
                                    {?>
                                        <div style="float: left;text-decoration: line-through; color:grey;height: 0.1px;padding-top: 35px;"><?php echo  "<br>".$yedek_fiyat; ?></div>
                                        <div style="padding-left: 5px;"></div>

                                        <div style="float: left;height: 0.1px;padding-bottom: 25px;"><?php echo "<br><br>   ".$tl_formati; ?> TL </div>
                                    <?php }
                                    ?> 



                                </div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">

                                    <div class="img-wrapper"><img style="width: 38px; height: 38px;" src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" alt="profile" class="img-responsive img-circle"></div>
                                    <span><a href="satici-<?=seo($kullanicilarim->get_kullanici_ad()."-".$kullanicilarim->get_kullanici_soyad())."-".$kullanicilarim->get_kullanici_id() ?>"><b><?php echo $kullanicilarim->get_magaza_adi(); ?></b></a></span>

                                </div>
                                <div class="profile-rating">

                           <!-- <ul>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> 05</span> )</li>
                            </ul>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Çok Satanlar Finish -->


        <?php } ?>



    </div>
</div>
<?php 
$arraylist=array();
$kategorilist=new ArrayList($arraylist);
$kategorilist=$dbservice->kategorilisteleme();
$kategorilist=$kategorilist->toArray();

foreach ($kategorilist as $kategorilerim) { 

    ?>



    <div class="container">
        <br>
        <h2 class="title-default">Çok Satanlar <?php echo $kategorilerim->get_kategori_ad(); ?></h2>  
    </div>
    <div class="container=fluid">
        <div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">



         <?php 
         $urunsor=$dbservice->urunlistecoksatan($kategorilerim->get_kategori_id());

         while($uruncek=$dbservice->uruncek($urunsor)) { 

             $urunlerim=$cons->Urun_ekle($uruncek);
             $kategoriler=$cons->Kategori_ekle($uruncek);
             $kullanicilarim=$cons->Kullanici_ekle($uruncek);


             ?>


             <!-- Çok Satanlar Start -->
             <div class="single-item-grid">
                <div class="item-img">
                    <a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><img style="width: 451px; height: 385px;" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>" alt="product" class="img-responsive"></a>
                    <div class="trending-sign" data-tips="Çok Satanlar Ürün"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                </div>
                <div class="item-content" style="word-wrap:break-word;">
                    <div class="item-info">
                        <h3><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>""> 


                         <?php
                         $arraylistrenk=array();
                         $renklist=new ArrayList($arraylistrenk);
                         $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                         $renkliste=$renkliste->toArray();
                         foreach ($renkliste as $renklerim) 
                         {
                            $renk=$renklerim->get_renk_adi();
                        }

                        $urunadsor=$dbservice->urunadsorliste($urunlerim->get_urun_id());

                        $say=$urunadsor->rowCount();
                        while($urunadcek=$dbservice->urunadcek($urunadsor)) {


                            $urunlerim=$cons->Urun_ekle($urunadcek);
                            $ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
                            $ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
                            $detaylarim=$ozellik_detaylarim->get_ozellik_detay();


                            if (isset($detaylarim))
                                $kapasite=$detaylarim." GB ";

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
                            <?php
                            $yazi=$urunlerim->get_urun_ad();
                            $detay = $yazi;
                                                    //Var olan metin içindeki karakter sayısı
                            $uzunluk = strlen($detay);
                                                    //Kaç Karakter Göstermek İstiyorsunuz
                            $limit = 48;
                                                    //Uzun olan yer "devamı..." ile değişecek.
                            if ($uzunluk > $limit) {
                                $detay = substr($detay,0,$limit);
                                echo " ".$detay." ".$kapasite." ".$renk."...<br>";
                            }           
                            else

                               echo " ".$detay." ".$kapasite." ".$renk."<br>"; ?>
                       </a></h3>
                   <?php } ?>
                   <span><a href="kategoriler-<?=seo($kategoriler->get_kategori_ad())."-".$kategoriler->get_kategori_id() ?>"><?php echo $kategoriler->get_kategori_ad() ?></a></span>
                   <div class="price" style="float: left;">
                    <br>
                    <br>
                    <br>
                    <?php 

                    $fiyat=$urunlerim->get_urun_fiyat(); 
                    $yedek_fiyat=number_format($urunlerim->get_urun_fiyat_yedek(), 2, ',', '.');
                    $tl_formati = number_format($fiyat, 2, ',', '.'); 
                    if ($urunlerim->get_urun_fiyat_yedek() == NULL)
                     {?>
                         <div style="float: left;height: 3px;"><?php echo "<br><br>".$tl_formati; ?> TL </div>

                         <?php
                     }
                     else
                        {?>
                            <div style="float: left;text-decoration: line-through; color:grey;height: 0.1px;padding-top: 35px;"><?php echo  "<br>".$yedek_fiyat; ?></div>
                            <div style="padding-left: 5px;"></div>

                            <div style="float: left;height: 0.1px;padding-bottom: 25px;"><?php echo "<br><br>   ".$tl_formati; ?> TL </div>
                        <?php }
                        ?> 



                    </div>
                </div>
                <div class="item-profile">
                    <div class="profile-title">

                        <div class="img-wrapper"><img style="width: 38px; height: 38px;" src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" alt="profile" class="img-responsive img-circle"></div>
                        <span><a href="satici-<?=seo($kullanicilarim->get_kullanici_ad()."-".$kullanicilarim->get_kullanici_soyad())."-".$kullanicilarim->get_kullanici_id() ?>"><b><?php echo $kullanicilarim->get_magaza_adi(); ?></b></a></span>

                    </div>
                    <div class="profile-rating">

                           <!-- <ul>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> 05</span> )</li>
                            </ul>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Çok Satanlar Finish -->


        <?php } ?>






    </div>
<?php } ?>
</div>

