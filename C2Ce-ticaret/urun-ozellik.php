<?php 

require_once 'header.php'; 
islemanakontrol();

$urunlerim=$dbservice->urunozellikurungetir();

$ozellikdetaysor=$dbservice->urunozellikListegetir();

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

      </script>


      <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">



        <?php
        $adetsor=$dbservice->urunozellikListegetir();
        $say=$adetsor->rowCount();
        if ($say==0)
          {?>
            <div class="settings-details tab-content">
              <div class="tab-pane fade active in" id="Personal">
                <h2 class="title-section">Özellik Ekleme</h2>
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

                  $formpanel->ComboBoxValue($ozelliklist[0],$urunozellikleriid,$ozelliklist[1],null,$ozellikadi);


                  ?>


                  <input type="hidden" name="alt_kategori_detay_id" value="<?php echo htmlspecialchars($_GET['alt_kategori_detay_id']) ?>">

                  <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> 

                  <?php $formpanel->Button("update-btn","magazaurunozellikekle","login-update","Özellik Ekle"); ?>


                <?php } ?>  
              </form>
              <div class="settings-details tab-content">
                <div class="tab-pane fade active in" id="Personal">
                  <h2 class="title-section">Ürünleriniz</h2>
                  <div class="personal-info inner-page-padding"> 

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Ürün Özellik</th>
                          <th scope="col">Ürün Özellik adı</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>


                       <?php 

                       $say=0;



                       while($ozellidetaycek=$dbservice->vericek($ozellikdetaysor)) { 

                        $say++;
                        $ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($ozellidetaycek);

                        ?>

                        <tr>
                         <td width="20"><?php echo $say ?></td>



                         <?php          
                         $arraylistozellik=array();
                         $ozelliklist=new ArrayList($arraylistozellik);
                         $ozelliklist=$dbservice->urunozelliklerilisteyap($ozellik_detay_iceriklerim->get_ozellik_detay_id());
                         $ozelliklist=$ozelliklist->toArray();       
                         for($i=0;$i<count($ozelliklist);$i++)
                         {
                          $ad=$ozelliklist[0];
                          $detay=$ozelliklist[1];
                          $urun_ozellikleri_id=$ozelliklist[2];
                        }
                        ?>

                        <td><?php echo $ad;?></td>
                        <td><?php echo $detay; ?></td>
                        <td>

                          <?php 

                          $formpanel->Button_Href("Düzenle","urun-ozellik-duzenle.php?alt_kategori_detay_id=".$urunlerim->get_alt_kategori_detay_id()."&urun_id=".$urunlerim->get_urun_id()."&ozellik_detay_icerik_id=".$ozellik_detay_iceriklerim->get_ozellik_detay_icerik_id()."&urun_ozellikleri_id=".$urun_ozellikleri_id,"primary"); 

                          ?>
                        </td>

                      </tr>



                    <?php  }

                    ?>


                  </tbody>
                </table>


              </div> 
            </div> 

          </div> 
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
