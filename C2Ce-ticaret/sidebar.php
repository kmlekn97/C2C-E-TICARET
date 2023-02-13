<?php 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");

}
?>


<div class="fox-sidebar">
    <div class="sidebar-item" style="width: 115%">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title"> Alt Kategoriler</h3>
            <ul class="sidebar-categories-list">

             <?php 
             $arraylistaltkategori=array();
             $altkategorilist=new ArrayList($arraylistaltkategori);
             $altkategorilist=$dbservice->sidealtkategoriListele();
             $altkategorilist=$altkategorilist->toArray();
             foreach ($altkategorilist as $altkategorilerim) 
             {
                ?>


                <li><a href="altkategoriler-<?=seo($altkategorilerim->get_alt_kategori_ad())."-".$altkategorilerim->get_alt_kategori_id() ?>"><?php echo $altkategorilerim->get_alt_kategori_ad() ?><span>(

                    <?php 

                       
                    echo $dbservice->altKategoriListeAdetHesapla($altkategorilerim->get_alt_kategori_id());

                    ?>

                )</span></a></li>

            <?php } ?>


        </ul>
    </div>
</div>
    <!--<div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title">Fiyat Aralığı</h3>
            <div id="price-range-wrapper" class="price-range-wrapper">
                <div id="price-range-filter"></div>
                <div class="price-range-select">
                    <div class="price-range" id="price-range-min"></div>
                    <div class="price-range" id="price-range-max"></div>
                </div>
                <button class="sidebar-full-width-btn disabled" type="submit" value="Login"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
            </div>
        </div>
    </div>-->


</div>
