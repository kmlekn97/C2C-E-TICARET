<?php 

include 'header.php'; 

$Urunlerim;
$arraylisturun=array();
$urunlist=new ArrayList($arraylisturun);
$urunlist=$admindbservices->UrunListele($_GET['urun_id']);
$urunlist=$urunlist->toArray();
foreach ($urunlist as $Urun) 
{
  $Urunlerim=$Urun;
}


$ozellik_detay_icerik=$admindbservices->urunOzellikDetayiçerikGetir();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Özellik Düzenleme <small>

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php" method="POST" class="form-horizontal" id="personal-info-form">

            <?php

            $arraylistozellik=array();
            $ozelliklist=new ArrayList($arraylistozellik);
            $ozelliklist=$admindbservices->urunozellikduzenleislem();
            $ozelliklist=$ozelliklist->toArray();
            for($i=0;$i<count($ozelliklist);$i++)
            {
              for($j=0;$j<count($ozelliklist);$j++)
              {
                $urunozellikleriid=$ozelliklist[2][0];
                $ozellikadi=$ozelliklist[2][1];
              }
            }

            $form->ComboBoxValue($ozelliklist[0],$urunozellikleriid,$ozelliklist[1],$ozellik_detay_icerik->get_ozellik_detay_id(),$ozellikadi);


            ?>  






            <input type="hidden" name="ozellik_detay_icerik_id" value="<?php echo htmlspecialchars($_GET['ozellik_detay_icerik_id']) ?>">

            <input type="hidden" name="alt_kategori_detay_id" value="<?php echo htmlspecialchars($_GET['alt_kategori_detay_id']) ?>">

            <input type="hidden" name="urun_id" value="<?php echo $Urunlerim->get_urun_id(); ?>"> 


            <div class="ln_solid"></div>

            <?php $form->Button("urunozellikduzenle","Güncelle"); ?>

          </form>




        </div>
      </div>
    </div>
  </div>



  <hr>
  <hr>
  <hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
