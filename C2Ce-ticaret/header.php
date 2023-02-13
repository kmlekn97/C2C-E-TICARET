<!doctype html>

    <?php
    require_once 'nedmin/netting/On_panel_Form.php';
    require_once 'nedmin/netting/baglan.php';
    require_once 'nedmin/production/fonksiyon.php';
    require_once 'nedmin/netting/class.crud-guncel.php';
    require_once 'nedmin/netting/Foto_Yükle.php';
    require_once 'CLASS/Sınıf_Islemleri.php';
    require_once 'services/DBService.php';
    require_once 'services/ArrayList.php';
    require_once 'services/SıkIslemlerServices.php';
    require_once 'services/OnPanelService.php';
    $dbsql=new crud();
    $cons=new Sınıf_Islemleri();
    $dbservice=new DBService($dbsql,$cons);
    $formpanel=new On_panel_Form($dbsql,$cons);
    require_once 'nedmin/netting/Sık_Islemler.php';
    $islem=new Sık_Islemler($dbsql,$cons);
    ob_start();
    session_start();
    date_default_timezone_set('Europe/Istanbul');

    ?>
    <html class="no-js" lang="">
    <head>
        <link rel="stylesheet" type="text/css" href="css/menuduzeltme.css" />
        <link rel="shortcut icon" href="img/logo.png" type="image/png" />
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 0) {
                        $('#dropdown').addClass('fix');
                    } else {
                        $('#dropdown').removeClass('fix');
                    }
                });
            });

        </script>

        <?php 

//error_reporting(0); //Hatalar Gizlenir => Hatalarınızı göremezsiniz. /tüm işler bittikten sonra kullanın.

        if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {
            exit("Bu sayfaya erişim yasak");
        }
/*
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    echo basename($_SERVER['PHP_SELF']);
    echo basename(__FILE__);
    exit("Bu sayfaya erişim yasak");

} else {


    echo basename($_SERVER['PHP_SELF']);
    echo basename(__FILE__);


}
*/

$dbu=new crud();
$sonuc= $dbu->kullaniciLogin(htmlspecialchars($_SESSION['userkullanici_mail']),htmlspecialchars($_COOKIE['remmeber_me']));
//Ayar Tablosundan Site Ayarlarımızı Çekiyoruz
$ayarlarim=$dbservice->ayarListele();
if (isset($_SESSION['userkullanici_mail'])) {

    $say=$dbservice->kullaniciAdetbul();
    $kullanicilarim=$dbservice->kullaniciListe();

    //Kullanıcı ID Session Atama
    if (isset($_SESSION['userkullanici_id'])) {

       $_SESSION['userkullanici_id']=$kullanicilarim->get_kullanici_id();

       setcookie("karsilastir", $karsilastir_id,strtotime("-30 day"),'/');

       $dbservice->sepetislemheader();

       setcookie("userid", $userid,strtotime("-1 day"),'/'); 
   }



}
$kullanici_id=$_SESSION['userkullanici_id'];
if(isset($_SESSION['userkullanici_id']))
{
    $kullanici_id=$_SESSION['userkullanici_id'];   
}
else
{
    $kullanici_id=0;
}

$dbservice->ipkayit($kullanici_id);

$kullanici_sonzaman= $_SESSION['userkullanici_sonzaman'];
$suan=time();

$fark=($suan-$kullanici_sonzaman);

if ($fark>600) {

    $dbservice->zamanguncelle();
    $kullanici_sonzaman= $_SESSION['userkullanici_sonzaman'];

}
?>
<title>

    <?php if (empty($title)) {


        echo $ayarlarim->get_ayar_title();


    } else {

        echo $title;
    } 

    ?>

</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $ayarlarim->get_ayar_description(); ?>">
<meta name="keywords" content="<?php echo $ayarlarim->get_ayar_keywords(); ?>">
<meta name="author" content="<?php echo $ayarlarim->get_ayar_author(); ?>">



<!-- Dropzone.js -->

<link href="nedmin/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">


<!-- Dropzone.js -->

<script src="nedmin/vendors/dropzone/dist/min/dropzone.min.js"></script>

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

<!-- Normalize CSS --> 
<link rel="stylesheet" href="css\normalize.css">

<!-- Main CSS -->         
<link rel="stylesheet" href="css\main.css">

<!-- Bootstrap CSS --> 
<link rel="stylesheet" href="css\bootstrap.min.css">

<!-- Animate CSS --> 
<link rel="stylesheet" href="css\animate.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="css\select2.min.css">

<!-- Font-awesome CSS-->
<link rel="stylesheet" href="css\font-awesome.min.css">

<!-- Owl Caousel CSS -->
<link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
<link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

<!-- Main Menu CSS -->      
<link rel="stylesheet" href="css\meanmenu.min.css">

<!-- Datetime Picker Style CSS -->
<link rel="stylesheet" href="css\jquery.datetimepicker.css">

<!-- ReImageGrid CSS -->
<link rel="stylesheet" href="css\reImageGrid.css">

<!-- Switch Style CSS -->
<link rel="stylesheet" href="css\hover-min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="style.css">


<link href="stil2.css" rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="galery.css">


<!-- fancy Style -->
<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">


<!-- Modernizr Js -->
<script src="js\modernizr-2.8.3.min.js"></script>


<!-- Ck Editör -->
<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>



</head>
<body style="background-color: #fff">

    <?php 
    if ($ayarlarim->get_ayar_bakim()==0) {
        header("Location: bakimda.php");
    }

    ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://owsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

            <!-- Add your site or application content here -->
            <!-- Preloader Start Here -->
            <div id="preloader"></div>
            <!-- Preloader End Here -->
            <!-- Main Body Area Start Here -->
            <div id="wrapper"  style="background-color: #fff;">
                <!-- Header Area Start Here -->
                <header>                
                    <div id="header2" class="header2-area right-nav-mobile">
                        <div class="header-top-bar">
                            <div class="container">
                                <div class="row">                         
                                    <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                        <div class="logo-area">
                                            <a href="index.php"><img class="img-responsive" src="<?php echo $ayarlarim->get_ayar_logo(); ?>" alt="logo"></a>
                                        </div>
                                    </div> 
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <ul class="profile-notification">                                            
                                        <!--<li>
                                            <div class="notify-contact"><span>Need help?</span> Talk to an expert: +61 3 8376 6284</div>
                                        </li>-->  

                                        <?php 

                                        if (isset($_SESSION['userkullanici_mail'])) {?>

                                            <?php

                                            $kampanyasor=$dbservice->kampanyalistesor();

                                            ?>
                                            <li>
                                                <div class="notify-notification">
                                                    <?php
                                                    if($kullanicilarim->get_kullanici_magaza()==2)  
                                                        {?>
                                                            <a href="kampanyalar"><i class="fa fa-bell-o" aria-hidden="true"></i><span><?php 
                                                            echo $kampanyasor->rowCount(); 

                                                            ?>

                                                        </span></a>
                                                        <?php
                                                    }  

                                                    else
                                                      {?>
                                                        <a><i class="fa fa-bell-o" aria-hidden="true"></i><span><?php 
                                                        echo $kampanyasor->rowCount(); 

                                                        ?>



                                                    </span></a>
                                                    <?php
                                                }

                                                ?>
                                                <ul>
                                                    <?php
                                                    while($kampanyacek=$dbservice->vericek($kampanyasor))

                                                    {
                                                      $kampanyalarim=$cons->Kampanya_ekle($kampanyacek);    
                                                      if($kampanyacek['bitis']>0)
                                                      {
                                                        ?>
                                                        <li>
                                                            <?php
                                                            if($kullanicilarim->get_kullanici_magaza()==2)  
                                                            {
                                                                ?>
                                                                <a href="kampanya_onay?kampanya_id=<?php echo $kampanyalarim->get_kampanya_id(); ?>">
                                                                   <div class="notify-notification-img">
                                                                    <img class="img-responsive" src="<?php echo $kampanyalarim->get_kampanya_logo(); ?>" alt="profile">
                                                                </div>
                                                            </a>

                                                        <?php } 
                                                        else
                                                            {?>
                                                                <div class="notify-notification-img">
                                                                    <img class="img-responsive" src="<?php echo $kampanyalarim->get_kampanya_logo(); ?>" alt="profile">
                                                                </div>
                                                            <?php }
                                                            ?>

                                                            <div class="notify-notification-info">
                                                                <div class="notify-notification-subject"><?php echo $kampanyalarim->get_kampanya_adi(); ?></div>
                                                                <div class="notify-notification-date"><?php echo $kampanyalarim->get_kampanyabaslangic_tarihi(); ?> / <?php echo $kampanyalarim->get_kampanyabitis_tarihi(); ?></div>
                                                            </div>

                                                        </li>

                                                    <?php }?>



                                                <?php } ?>
                                                <?php
                                                if ($kampanyasor->rowCount()==0)
                                                    echo "Kamyanya Yok";
                                                ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notify-message">
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>

                                             <?php 

                                             echo $dbservice->mesajadetbul();

                                             ?>

                                         </span></a>
                                         <ul>

                                            <?php 

                                            $mesajsor=$dbservice->mesajlistelelimitli(5);

                                            if ($mesajsor->rowCount()==0) {?>
                                                <li>
                                                    <div class="notify-message-info">
                                                        <div style="color:black !important" class="notify-message-subject">Hiç Mesajınız Yok</div>

                                                    </div>
                                                </li>

                                            <?php }

                                            while($mesajcek=$dbservice->vericek($mesajsor)) {
                                                $mesajlarim=$cons->Mesaj_ekle($mesajcek);
                                                $kullanicilarim=$cons->Kullanici_ekle($mesajcek);
                                                ?>

                                                <li>
                                                    <div class="notify-message-img">
                                                        <img class="img-responsive" src="<?php echo $kullanicilarim->get_kullanici_magazafoto(); ?>" alt="profile">
                                                    </div>
                                                    <div class="notify-message-info">
                                                        <div class="notify-message-sender"><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(); ?></div>
                                                        <div class="notify-message-sender"><?php echo "<b>".$mesajlarim->get_mesaj_konu()."</b>"?></div>
                                                        <div class="notify-message-subject">Mesaj Detayı</div>
                                                        <div class="notify-message-date"><?php echo $mesajlarim->get_mesaj_zaman();?></div>
                                                    </div>
                                                    <div class="notify-message-sign">
                                                        <a  href="mesaj-detay?mesaj_id=<?php echo $mesajlarim->get_mesaj_id() ?>&kullanici_gon=<?php echo $mesajlarim->get_kullanici_gon() ?>"><i style="color:orange !important" class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                                    </div>
                                                </li>

                                            <?php } ?>


                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <?php 
                                    $favorisor=$dbservice->favorilistesor();
                                    $favorilistele=$dbservice->favorilisteme();
                                    ?>
                                    <div class="cart-area">
                                        <ul>
                                            <?php  while($favoriler=$dbservice->vericek($favorilistele)) {
                                                $favorilerim=$cons->Favori_ekle($favoriler);
                                                $urunlerim=$cons->Urun_ekle($favoriler);
                                                $markalarim=$cons->Marka_ekle($favoriler);
                                                $renklerim=$cons->Renk_ekle($favoriler);
                                                $urunadsor=$dbservice->urunadsorliste($favorilerim->get_urun_id());

                                                $say=$urunadsor->rowCount();
                                                while($urunadcek=$dbservice->vericek($urunadsor)) {
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
                                            <li>
                                                <div class="cart-single-product">
                                                    <div class="media">
                                                        <div class="pull-left cart-product-img">
                                                            <a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
                                                                <img class="img-responsive" alt="product" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>">
                                                            </a>
                                                        </div>
                                                        <div class="media-body cart-content">
                                                            <ul>
                                                                <li>
                                                                    <h1><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><?php echo " ".$markalarim->get_marka_adi()." ".$urunlerim->get_urun_ad()." ".$kapasite." ".$renklerim->get_renk_adi()." ".$favoriler['beden_icerik']." ".$urunlerim->get_barkod_no(); ?></a></h1>
                                                                </li>
                                                                <li>
                                                                    <?php echo number_format($urunlerim->get_urun_fiyat(), 2, ',', '.')." T.L."; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <a href="favoriler"><i class="fa fa-heart-o" aria-hidden="true">

                                    </i><span>

                                        <?php echo $favorilistele->rowCount(); ?>

                                    </span>
                                </a>
                            </div>
                        </li>
                        <li id="gelensepet">
                            <?php $islem->cart(); ?>

                        </li>
                        

                    <?php } ?>



                    <?php 

                    if (isset($_SESSION['userkullanici_mail'])) {?>

                        <li>
                            <div class="user-account-info">
                                <div class="user-account-info-controler">
                                    <div class="user-account-img">
                                        <img style="border-radius: 30px;" width="32" height="32" class="img-responsive" src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" alt="Profil Resmi">
                                    </div>
                                    <div class="user-account-title">
                                        <div class="user-account-name"><?php echo $kullanicilarim->get_kullanici_ad()." ".substr($kullanicilarim->get_kullanici_soyad(), 0,1) ?>.</div>
                                        <div class="user-account-balance">

                                            <?php 
                                            $totalsatis=$dbservice->totalsatisHesapla();
                                            if (isset($totalsatis)) {
                                                echo number_format($totalsatis, 2, ',', '.')." TL";

                                            } else {

                                                echo "0.00 TL";
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="user-account-dropdown">
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <ul>
                                    <li><a href="hesabim">Hesap Bilgilerim</a></li>
                                    <?php
                                    if($kullanicilarim->get_kullanici_magaza()==2) 
                                    {
                                        ?>
                                        <li><a href="istatistik">İstatistik</a></li> 
                                    <?php }  ?>
                                </ul>

                            </div>

                        </li>

                        <li><a class="apply-now-btn" href="logout.php" id="logout-button">Çıkış</a></li>

                    <?php } else {?>

                     <li id="gelensepet">
                        <?php $islem->cart(); ?>

                    </li>

                    <li> <a class="apply-now-btn hidden-on-mobile" id="login" href="login" >Üye Girişi</a></li>
                    <li><a class="apply-now-btn-color hidden-on-mobile" id="register" href="register">Kayıt</a></li>




                <?php }

                ?>




            </ul>
        </div>                          
    </div>                          
</div>
</div>

<div class="main-menu-area bg-primaryText" id="sticker">
    <div class="container">
        <nav id="desktop-nav" style="margin-left: 15rem;font-size: 17px; word-wrap: break-word;">

         <?php $islem->kategori_listesi(); ?> 

     </nav>
 </div>
</div>
</div>
<!-- Mobile Menu Area Start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-menu">


                 <nav id="dropdown">


                   <?php 
                   $islem->kategori_listesi(5); 
                   ?> 
                   <div class="ayar">
                    <a href="index.php"><img width="100px" class="img-responsive" src="<?php echo $ayarlarim->get_ayar_logo() ?>" alt="logo"></a>
                </div>

            </nav>
        </div>           
    </div>
</div>
</div>
</div>  
<!-- Mobile Menu Area End -->
</header>


<?php 
$favorisor=$dbservice->favorilistesor();
while($favoricek=$dbservice->vericek($favorisor))
{
    $favorilerim=$cons->Favori_ekle($favoricek);
    $urunlerim=$cons->Urun_ekle($favoricek);
    $markalarim=$cons->Marka_ekle($favoricek);
    if ($_SESSION['userkullanici_id']==$favoricek['id'])
    {
     $url=seo($urunlerim->get_urun_ad())."-".$favorilerim->get_urun_id();
     ?>
     <script src="node_modules/push.js/bin/push.js"></script>
     <script type="text/javascript">


        let permission = Push.Permission.has();

     //alert(permission);

     Push.create("Kampanya!!!", {
        body: "Favori <?php echo $markalarim->get_marka_adi()." ".$urunlerim->get_urun_ad(); ?> indirimde",
        icon: "<?php echo $ayarlarim->get_ayar_logo(); ?>",
        timeout: 8000,
        onClick: function () {
            window.focus();
            window.history.pushState('', 'Campany Page Title', 'urun-<?php echo $url;?>');
            location.reload();
            this.close();
        }
    });


</script>

<?php

$dbservice->favoridurumguncelle($favorilerim->get_urun_id());

?>

<?php } ?>

<?php } ?>

<script type="text/javascript">


    $(document).ready(function () {



        $('.trash').click(function(){

            var id=jQuery(this).attr("id");
            $.post("sepeteekle.php",{sepet_id:id,durum:-1},function(a){
                $('#silme').load(window.location.pathname+' #silme');
            })

            $('#total').load(window.location.pathname+' #total');


        });

    });

</script>

<?php 
if (isset($_SESSION['userkullanici_mail']))
{
    if ($kullanicilarim->get_kullanici_magaza() == 1 && $kullanicilarim->get_magaza_adi() != "")
        { ?>

            <div class="alert alert-danger">
                <strong>Bilgi!</strong> Mağaza Blokeli
            </div>                   

        <?php }
    }

    ?>

