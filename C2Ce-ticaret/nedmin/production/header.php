<?php
include '../netting/baglan.php';
include 'fonksiyon.php';
require_once '../netting/class.crud-guncel.php';
require_once '../../services/ArrayList.php';
require_once '../../services/SıkIslemlerServices.php';
require_once '../../services/OnPanelService.php';

$dbsql=new crud();
require_once 'CLASS/Sınıf_Islem.php';
require_once '../netting/Yetki.php';
$yetkide=new yetki();
$cons=new Sınıf_Islem();
require_once '../netting/Sık_Islemler.php';
$islem=new Sık_Islemler($dbsql,$cons);
require_once '../netting/Yonetim_form.php';
$form=new Yonetim_form();
require_once '../netting/CreateTable.php';
require_once '../netting/Foto_Yükle.php';

require_once '../../services/AdminDBServices.php';
$admindbservices=new AdminDBServices($dbsql,$cons);
//Belirli veriyi seçme işlemi

$ayarsor=$dbsql->wread("ayar","ayar_id",0);
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
$ayarlarim=$admindbservices->Ayar();
$kullanicisor=$admindbservices->Kullanicimailegoregetir();
$kullanicicek=$admindbservices->vericek($kullanicisor);
$kullanicilarim=$cons->Kullanici_ekle($kullanicicek);
$say=$kullanicisor->rowCount();
if ($say==0) {

  Header("Location:login.php?durum=izinsiz");
  exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Kemal EKIN SHOPPING CENTER</title>

  <?php
  ob_start();
  session_start();
  $dbc=new crud();
  $sonuc= $dbc->adminsLogin(htmlspecialchars($_SESSION['kullanici_mail']),htmlspecialchars($_COOKIE['remmeber_me']));

  if ($sonuc['status']==0) {
    Header("Location:login.php?durum=izinsiz");
    exit;

  }
  if(isset($_SESSION['kullanici_id']))
  {
    $kullanici_id=$_SESSION['kullanici_id'];   
  }
  else
  {
    $kullanici_id=0;
  }
  $kaydet=$dbsql->insert("kayit",array(

    'Kayit_detay' => htmlspecialchars($_SERVER['REQUEST_URI']),
    'Kayit_ip' => htmlspecialchars($_SERVER['REMOTE_ADDR']),
    'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id'])

  ));
  ?>



  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">



  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <link href="css/surukleme.css" rel="stylesheet">



  <!-- Dropzone.js -->

  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">



  <!-- Dropzone.js -->

  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
  <!-- Ck Editör -->
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>


  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md" style="background-color: #f2f2f2;">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php<?php  ?>" class="site_title"><i class="fa fa-paw"></i> <span>EKIN SHOPPİNG</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <a href="profilephoto.php"><img src="../../<?php echo $kullanicilarim->get_kullanici_resim(); ?>" alt="..." class="img-circle profile_img"></a>
            </div>
            <div class="profile_info">
              <span>Hoşgeldin</span>
              <h2><?php echo $kullanicilarim->get_kullanici_ad(); echo " "; echo $kullanicilarim->get_kullanici_soyad();  ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">

                <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa </a></li>

                <?php if ($yetkide->yetkikontrol("ayarlar.php",$_SESSION['kullanici_id'])==0)
                {?>


                 <li><a><i class="fa fa-cogs"></i> Site Ayarları <span class="fa fa-cogs"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="genel-ayar.php">Genel Ayarlar</a></li>
                    <li><a href="iletisim-ayarlar.php">İletişim Ayarlar</a></li>
                    <li><a href="api-ayarlar.php">Api Ayarlar</a></li>
                    <li><a href="sosyal-ayar.php">Sosyal Ayarlar</a></li>
                    <!--

                    Facebook
                    Twitter
                    Youtube
                    Google


                  -->
                  <li><a href="mail-ayar.php">Mail Ayarlar</a></li>

                     <!--

                   Smtp Host
                   Smtp User
                   Smtp Password
                   Smtp Port


                 -->

                 <li><a href="sirket-ayar.php">Şirket Ayarlar</a></li>



               </ul>
             </li>

           <?php } ?>

           <?php if ($yetkide->yetkikontrol("hakkimizda.php",$_SESSION['kullanici_id'])==0)
           {?>

             <li><a href="hakkimizda.php"><i class="fa fa-info"></i> Hakkımızda </a></li>

           <?php } ?>

           <?php if ($yetkide->yetkikontrol("cari.php",$_SESSION['kullanici_id'])==0)
           {?>

             <li><a><i class="fa fa-book"></i> Cari </a>
              <ul class="nav child_menu">
               <li><a href="hesap.php"><i class="fa fa-pencil-square-o"></i>Hesap</a>
                <li><a href="cari.php"><i class="fa fa-arrows-h"></i>Cari İşlem</a>
                </ul>

              </li>

            <?php } ?>


            <?php if ($yetkide->yetkikontrol("istatistik.php",$_SESSION['kullanici_id'])==0)
            {?>

              <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i>
              İstatistik </a>
              <ul class="nav child_menu">
                <li><a href="kategori_istatistik.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>Alt Kategori</a>
                </li>
              </ul>

            </li>

          <?php } ?>

          <?php if ($yetkide->yetkikontrol("magazalar.php",$_SESSION['kullanici_id'])==0)
          {?>

            <li><a><i class="fa fa-shopping-bag"></i> Mağaza İşlemleri </a>

              <ul class="nav child_menu">

               <li><a href="magazalar.php"><i class="fa fa-shopping-bag"></i> Mağazalar </a></li>

               <li><a href="magaza-onay.php"><i class="fa fa-shopping-bag"></i> Mağaza Başvuruları </a></li>

             </ul>

           </li>

         <?php } ?>

         <?php if ($yetkide->yetkikontrol("kullanici.php",$_SESSION['kullanici_id'])==0)
         {?>

           <li><a href="kullanici.php"><i class="fa fa-user"></i> Kullanıcılar </a></li>

         <?php } ?>

         <?php if ($yetkide->yetkikontrol("calisanlar.php",$_SESSION['kullanici_id'])==0)
         {?>

          <li><a href="calisanlar.php"><i class="fa fa-building"></i> Çalışanlar </a></li>

        <?php } ?>

        <?php if ($yetkide->yetkikontrol("kayit.php",$_SESSION['kullanici_id'])==0)
        {?>

         <li><a href="kayit.php"><i class="fa fa-eye"></i> Kayıtlar </a></li>

       <?php } ?>

       <?php if ($yetkide->yetkikontrol("kampanya.php",$_SESSION['kullanici_id'])==0)
       {?>

        <li><a href="kampanya.php"><i class="fa fa-percent"></i> Kampanyalar </a></li>

      <?php } ?>

      <?php if ($yetkide->yetkikontrol("urun.php",$_SESSION['kullanici_id'])==0)
      {?>

        <li><a href="urun.php"><i class="fa fa-shopping-basket"></i> Ürünler </a></li>

      <?php } ?>


      <?php if ($yetkide->yetkikontrol("markalar.php",$_SESSION['kullanici_id'])==0)
      {?>

       <li><a><i class="fa fa-copyright"></i> Marka İşlemleri </a>
         <ul class="nav child_menu">
          <li><a href="marka.php"><i class="fa fa-copyright"></i> Markalar </a></li>
          <li><a href="marka_onayla.php"><i class="fa fa-check"></i>Marka Başvuruları </a></li>
        </ul>
      </li>

    <?php } ?>

    <?php if ($yetkide->yetkikontrol("renkler.php",$_SESSION['kullanici_id'])==0)
    {?>

      <li><a href="renkler.php"><i class="fa fa-paint-brush"></i></i> Renkler </a></li>

    <?php } ?>

    <?php if ($yetkide->yetkikontrol("beden.php",$_SESSION['kullanici_id'])==0)
    {?>

      <li><a href="beden.php"><i class="fa fa-child"></i></i> Bedenler </a></li>

    <?php } ?>

    <?php if ($yetkide->yetkikontrol("kategori.php",$_SESSION['kullanici_id'])==0)
    {?>

      <li><a href="kategori.php"><i class="fa fa-list"></i> Kategoriler </a></li>

    <?php } ?>

    <?php if ($yetkide->yetkikontrol("slider.php",$_SESSION['kullanici_id'])==0)
    {?>

     <li><a href="slider.php"><i class="fa fa-image"></i> Slider </a></li>

   <?php } ?>


   <?php if ($yetkide->yetkikontrol("siparisler.php",$_SESSION['kullanici_id'])==0)
   {?>

     <li><a href="siparisler.php"><i class="fa fa-cart-plus"></i> Siparişler </a></li>

   <?php } ?>

   <?php if ($yetkide->yetkikontrol("kargo.php",$_SESSION['kullanici_id'])==0)
   {?>

     <li><a href="kargo.php"><i class="fa fa-cubes"></i> Kargo </a></li>

   <?php } ?>

   <?php if ($yetkide->yetkikontrol("iade.php",$_SESSION['kullanici_id'])==0)
   {?>

    <li><a><i class="fa fa-repeat"></i> İade </a>
     <ul class="nav child_menu">
      <li><a href="iadeler.php"><i class="fa fa-recycle"></i> Değişim </a></li>
      <li><a href="para_iadesi.php"><i class="fa fa-try"></i>Para İadeleri </a></li>
    </ul>
  </li>

<?php } ?>

<?php if ($yetkide->yetkikontrol("yorum.php",$_SESSION['kullanici_id'])==0)
{?>

 <li><a href="yorum.php"><i class="fa fa-commenting"></i> Yorumlar </a></li>

<?php } ?>

<?php if ($yetkide->yetkikontrol("sikayetler.php",$_SESSION['kullanici_id'])==0)
{?>

 <li><a href="sikayetler.php"><i class="fa fa-exclamation "></i> Şikayetler </a></li>

<?php } ?>

<?php if ($yetkide->yetkikontrol("mesaj.php",$_SESSION['kullanici_id'])==0)
{?>

  <li><a><i class="fa fa-comments-o"></i> Mesaj </a>
    <ul class="nav child_menu">
     <li><a href="mesaj-gonder.php"><i class="fa fa-plus"></i> Mesaj  Oluştur</a>
       <li><a href="gelen-mesajlar.php"><i class="fa fa-comments-o"></i>Gelen Mesajlar</a>
         <li><a href="giden-mesajlar.php"><i class="fa fa-comments-o"></i>Giden Mesajlar</a>
         </ul>

       </li>

     <?php } ?>

     <?php if ($yetkide->yetkikontrol("banka.php",$_SESSION['kullanici_id'])==0)
     {?>

      <li><a href="banka.php"><i class="fa fa-bank"></i> Bankalar </a></li>

    <?php } ?>


    <?php for ($i=1;$i<=26;$i++)
    {?>
     <li>&nbsp; </li>
   <?php } ?>

 </ul>
</div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" onclick="toggleFullScreen()" data-placement="top" title="FullScreen" style="width: 50%">
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" href="logout.php" data-placement="top" title="Logout" style="width: 50%">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="../../<?php echo $kullanicilarim->get_kullanici_resim(); ?>" alt=""><?php echo $kullanicilarim->get_kullanici_ad(); echo " "; echo $kullanicilarim->get_kullanici_soyad();  ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="profilephoto.php"> Profil Bilgilerim</a></li>


            <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Güvenli Çıkış</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green"> <?php 

            echo $admindbservices->MesajSayHesapla();
          ?></span>
        </a>
        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
         <?php 

         $mesajsor=$admindbservices->MesajAliciLimitli();

        if ($mesajsor->rowCount()==0) {?>
          <li>
            <div class="notify-message-info">
              <div style="color:black !important" class="notify-message-subject">Hiç Mesajınız Yok</div>

            </div>
          </li>

        <?php }

        while($mesajcek=$admindbservices->vericek($mesajsor)) {
          $mesajlarim=$cons->Mesaj_ekle($mesajcek);
          $kullanicilarim=$cons->Kullanici_ekle($mesajcek);
          ?>
          <li>
            <a  href="mesaj-detay?mesaj_id=<?php echo $mesajlarim->get_mesaj_id(); ?>&kullanici_gon=<?php echo $mesajlarim->get_kullanici_gon(); ?>">
              <span class="image">
                <img src="<?php echo "../../".$kullanicilarim->get_kullanici_magazafoto(); ?>" alt="Profile Image" /></span>
                <span>
                  <span><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(); ?></span>
                  <span class="time"><?php echo $mesajlarim->get_mesaj_zaman(); ?></span>
                </span>
                <span class="message">
                 <?php
                 echo "<b>".$mesajlarim->get_mesaj_konu()."</b>"."<br><br>";
                 $yazi=htmlspecialchars_decode($mesajlarim->get_mesaj_detay());
                 $detay = $yazi;
                                                    //Var olan metin içindeki karakter sayısı
                 $uzunluk = strlen($detay);
                                                    //Kaç Karakter Göstermek İstiyorsunuz
                 $limit = 250;
                                                    //Uzun olan yer "devamı..." ile değişecek.
                 if ($uzunluk > $limit) {
                  $detay = substr($detay,0,$limit);
                  echo $detay." ...<br>";
                }           
                else
                 echo htmlspecialchars_decode($mesajlarim->get_mesaj_detay());



               ?>
             </span>
           </a>
         </li>
       <?php } ?>    
       <li>
        <div class="text-center">
          <a>
            <strong><a href="gelen-mesajlar.php">Gelen Mesajlar</a></strong>
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </li>



    </ul>
  </li>
</ul>
</nav>
</div>
</div>

<!-- /top navigation -->

<script type="text/javascript">
  function toggleFullScreen(elem) {
   var el = document.documentElement
, rfs = // for newer Webkit and Firefox
el.requestFullScreen
|| el.webkitRequestFullScreen
|| el.mozRequestFullScreen
|| el.msRequestFullScreen
;
if(typeof rfs!="undefined" && rfs){
  rfs.call(el);
} else if(typeof window.ActiveXObject!="undefined"){
  // for Internet Explorer
  var wscript = new ActiveXObject("WScript.Shell");
  if (wscript!=null) {
   wscript.SendKeys("{F11}");
 }
}
}
</script>

