<?php 
require_once 'header.php'; 

$uruncek=$dbservice->odemeurunListele();
$urunlerim=$cons->Urun_ekle($uruncek);
$kullanicilarim=$cons->Kullanici_ekle($uruncek);
?>
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h2 style="color:white;">Ödeme Yapılacak Ürün: <?php echo $urunlerim->get_urun_ad(); ?></h2>

        </div>
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
<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary">                
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <?php $adet=0; ?>
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:80%">Ürün Bilgisi</th>
                                    <th style="width:10%">Fiyat</th>
                                    <th style="width:10%">Adet</th>
                                    <th style="width:20%" class="text-center">Satıcı</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><img src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>" alt="<?php echo $urunlerim->get_urun_ad(); ?>" class="img-responsive"/></div>
                                            <div class="col-sm-10">
                                               <h2>    <?php 
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
                                        </h2>
                                        <div class="renklergel">
                                            <?php
                                            $arraylist=array();
                                            $renklist=new ArrayList($arraylist);
                                            $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                                            $renkliste=$renkliste->toArray();
                                            foreach ($renkliste as $renklerim) 
                                            {
                                              $renk=$renklerim->get_renk_adi();
                                          }
                                          ?>

                                          <?php
                                          $urunadsor=$dbservice->urunadsoradlilistele($urunlerim->get_urun_id(),$urunlerim->get_urun_ad());
                                          while($urunadcek=$dbservice->vericek($urunadsor)) {
                                            $urunlerim=$cons->Urun_ekle($urunadcek);
                                            $ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
                                            $ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
                                            $detaylarim=$ozellik_detaylarim->get_ozellik_detay();
                                            if (isset($detaylarim))
                                                $kapasite=$detaylarim." GB ";
                                        }?>

                                        <h3> 

                                           <?php   echo " ".$urunlerim->get_urun_ad()." ".$kapasite." ".$renk." ".$urunlerim->get_barkod_no(); ?>
                                       </a></h3>
                                   </div>
                               </h3>
                           </div>
                       </div>
                       <?php
                       $arraylistbeden=array();
                       $bedenlist=new ArrayList($arraylistbeden);
                       $bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
                       $bedenlist=$bedenlist->toArray();
                       foreach ($bedenlist as $bedenlerim) 
                       {
                        $beden=$bedenlerim->get_beden_icerik();
                    }
                    ?>

                    <?php if ($urunlerim->get_beden_id()!=0) { ?>
                        <p><b>Beden:</b><?php echo $beden?></p>
                    <?php } ?>
                </td>



                <td data-th="Price"><?php $fiyat=$urunlerim->get_urun_fiyat(); $tl_formati = number_format($fiyat, 2, ',', '.'); echo $tl_formati; ?> TL</td>
                <?php $adet=1; ?>
                <td><?php echo $adet;?></td>


                <td data-th="Subtotal" class="text-center"><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(); ?></td>

                <td></td>

            </tr>
        </tbody>


        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total 1.99</strong></td>
            </tr>
            <tr>
                <td><button onclick="geridon()" class="btn btn-warning"><i class="fa fa-angle-left"></i> Geri Dön</button></td>
                <td colspan="2" class="hidden-xs"></td>


                <form action="nedmin/netting/kullanici.php" method="POST">

                    <input type="hidden" name="kullanici_idsatici" value="<?php echo $kullanicilarim->get_kullanici_id() ?>">
                    <input type="hidden" name="urun_id" value="<?php echo $urunlerim->get_urun_id() ?>">
                    <input type="hidden" name="urun_fiyat" value="<?php echo $urunlerim->get_urun_fiyat()  ?>">

                    <input type="hidden" name="urun_adet" value="<?php echo $adet; ?>">

                    <td><button  name="sipariskaydet" type="submit" class="btn btn-success btn-block"> Siparişi Tamamla <i class="fa fa-angle-right"></i></button></td>

                </form>
            </tr>
        </tfoot>



    </table>

</div>                                

</div>
</div>



</div>
</div>
<!-- Product Details Page End Here -->


<?php 
require_once 'footer.php'; 
?>

<script type="text/javascript">

    function geridon(){

        window.history.back();
    }

</script>