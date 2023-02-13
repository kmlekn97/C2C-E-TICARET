<?php 

require_once 'header.php'; 

islemanakontrol();

$urunlerim=$dbservice->urunozellikurungetir();
$ozellik_detay_icerik=$dbservice->urunozellikdetaygetir();

?>

<!-- Header Area End Here -->

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">



    <div class="row settings-wrapper">


      <?php require_once 'hesap-sidebar.php' ?>


      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

       <?php $formpanel->Durum_cek(); ?>



       <form action="nedmin/netting/islem.php" method="POST" class="form-horizontal" id="personal-info-form">


        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Özellik Düzenle</h2>
            <div class="personal-info inner-page-padding"> 

              <?php

              $arraylistozellik=array();
              $ozelliklist=new ArrayList($arraylistozellik);
              $ozelliklist=$dbservice->urunozellikduzenleislem();
              $ozelliklist=$ozelliklist->toArray();
              for($i=0;$i<count($ozelliklist);$i++)
              {
                for($j=0;$j<count($ozelliklist);$j++)
                {
                  $urunozellikleriid=$ozelliklist[2][0];
                  $ozellikadi=$ozelliklist[2][1];
                }
              }

              $formpanel->ComboBoxValue($ozelliklist[0],$urunozellikleriid,$ozelliklist[1],$ozellik_detay_icerik->get_ozellik_detay_id(),$ozellikadi);


              ?>  



              <input type="hidden" name="ozellik_detay_icerik_id" value="<?php echo htmlspecialchars($_GET['ozellik_detay_icerik_id']) ?>">

              <input type="hidden" name="alt_kategori_detay_id" value="<?php echo htmlspecialchars($_GET['alt_kategori_detay_id']) ?>">

              <input type="hidden" name="urun_id" value="<?php echo $urunlerim->get_urun_id() ?>"> 


              <?php $formpanel->Button("update-btn","magazaurunozellikduzenle","login-update","Özellik Düzenle"); ?>


            </div> 
          </div> 
        </div> 

      </form> 
    </div>  
  </div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>
