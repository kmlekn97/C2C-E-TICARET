<?php require_once 'header.php'; ?>
<style type="text/css">

    @media (min-width: 500px) {

      .main-banner2-area
      {
        margin-top: 43px;
    }


}
</style>

<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">                       
            <h1>Udemy C2C Projemize Hoşgeldiniz</h1>
            <p>Aramak istediğiniz ürünü lütfen giriniz...</p>
            <form action="arama-detay" method="POST">
                <div class="banner-search-area input-group">


                    <input class="form-control" required="" minlength="3" name="searchkeyword" id="search" placeholder="Ne aramıştınız . . ." type="text">

                    <div style="margin-top: 5rem;">

                       <div class="kelimeler">

                       </div>
                   </div>




                   <span class="input-group-addon">
                    <button type="submit" name="searchsayfa">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>  
                </span>

            </form>


        </div>

    </div>
</div>
</div>
<div style="font-size: 55px;background-color:#f2f2f2;"><center><b>AYRICALIKLAR</b></center></div>
<?php require_once 'slider.php'; ?>

<!-- Trending Products Area Start Here -->
<!-- Trending Products Area End Here -->
<!-- Main Banner 1 Area End Here -->            
<!-- Newest Products Area Start Here -->
<div class="">                
    <div class="container">
        <h2 class="title-default">Öne Çıkan Ürünler</h2>  
    </div>
    <div class="container-fluid" id="isotope-container">
        <div class="isotope-classes-tab isotop-box-btn-white"> 




        </div>

        <div class="row featuredContainer">


          <?php 
          
          $urunsor=$dbservice->vitrinUrunListeleme();

          while($uruncek=$dbservice->vericek($urunsor)) { 

            $urunlerim=$cons->Urun_ekle($uruncek);
            $kategorilerim=$cons->Kategori_ekle($uruncek);
            $kullanicilarim=$cons->Kullanici_ekle($uruncek);

            ?>

            <!-- Start Ürün Anasayfa Listeleme -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 yenigelen plugins">
                <?php $islem->kategori_onecikanlar($uruncek); ?>
            </div>

        <?php } ?>

        <!-- Finish Ürün Anasayfa Listeleme -->

    </div>

</div>
<?php 
$arraylist=array();
$kategorilist=new ArrayList($arraylist);
$kategorilist=$dbservice->kategorilisteleme();
$kategorilist=$kategorilist->toArray();

foreach ($kategorilist as $kategorilerim) { ?>



 <div class="container">
    <br>
    <h2 class="title-default">Öne Çıkanlar <?php echo $kategorilerim->get_kategori_ad() ?></h2>  
</div>
<div class="container=fluid">
    <div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">

        <?php 

        $dbservice->KategoriOneCikanlar($kategorilerim->get_kategori_id(),$islem);

        ?>

        
    </div>
<?php } ?>
</div>


</div>


<!-- Newest Products Area End Here -->

<div class="">

    <?php require_once 'cok-satanlar.php' ?>
</div>



<!-- Why Choose Area Start Here -->
<div class="why-choose-area bg-primaryText section-space-default">                
    <div class="container">
        <h2 class="title-textPrimary">Why You Choose Foxtar Market Place?</h2>  
    </div>
    <div class="container">
        <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="why-choose-box">
                <a href="#"><i class="fa fa-gift" aria-hidden="true"></i></a>
                <h3><a href="#">Easily Buy & Sell </a></h3>
                <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="why-choose-box">
                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                <h3><a href="#">Quality Products</a></h3>
                <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="why-choose-box">
                <a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a>
                <h3><a href="#">100% Secure Payment</a></h3>
                <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Why Choose Area End Here -->

<!-- Author Banner Area Start Here -->
<div class="author-banner-area">
    <div class="author-banner-wrapper">
        <div id="ri-grid" class="author-banner-bg ri-grid header text-center">
            <ul class="ri-grid-list">
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>                            
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>

            </ul>
        </div>
        <div class="author-banner-content">
            <ul>
                <li><p>Over <span> 20,000</span> Author Are Involved Here!</p></li>
                <li><a href="#" class="btn-fill-textPrimary">Become A Author</a></li>
            </ul>
        </div>
    </div>               
</div>
<!-- Author Banner Area End Here -->            

<?php require_once 'footer.php'; ?>
