<?php 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");

}
?>

<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
    <div class="inner-page-main-body">

        <div class="single-banner">
            <img src="img\banner\marketing.jpg" alt="product" class="img-responsive" style="height: 425px;">
        </div>
        

        <div class="author-summery">
            <div class="single-item">
                <div class="item-title">Bölge:</div>
                <div class="item-details"><?php echo $kullanicilarim->get_kullanici_ilce()." / ".$kullanicilarim->get_kullanici_il(); ?></div>                                       
            </div>
            <div class="single-item">
                <div class="item-title">Kayıt Tarihi</div>
                <div class="item-details"><?php echo $kullanicilarim->get_kullanici_zaman(); ?></div>                                       
            </div>
            <div class="single-item">
                <div class="item-title">Puan:</div>
                <div class="item-details">
                   <?php 

                   $deger=$dbservice->SaticiPuanHesapla($_GET['kullanici_id']);
                   $puan=floor($deger);

                   ?>
                   <ul class="default-rating">
                     <?php include 'rating.php'; ?>
                </ul>
            </div>                                       
        </div>
        <div align="center" class="single-item">
            <div class="item-title">Toplam Satış:</div>
            <div class="item-name">
                <?php 

                $saycek=$dbservice->SaticitotalsatisHesapla($_GET['kullanici_id']);
                echo $saycek['say'];

                ?>
            </div>                                       
        </div>
    </div>
</div>
</div>