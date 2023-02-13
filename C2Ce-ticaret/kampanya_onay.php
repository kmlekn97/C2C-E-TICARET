
<?php 

require_once 'header.php'; 

islemanakontrol();

$kampanyalarim=$dbservice->KampanyaListele();

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


       <div class="form-group" style="word-wrap: break-word;">
        <label class="col-sm-3 control-label">KAMPANYA AÇIKLAMA:</label>
        <div class="col-sm-9">
          <?php echo htmlspecialchars_decode($kampanyalarim->get_kampanya_aciklama()); ?>
        </div>
      </div>
      <br>
      <div class="form-group">
        <label class="col-sm-3 control-label">İNDİRİM ORANI:</label>
        <div class="col-sm-9">
          <?php echo "<b>".$kampanyalarim->get_kampanya_oran()."</b>"; ?>
        </div>
      </div>
      <br>




      <div class="settings-details tab-content">
        <div class="tab-pane fade active in" id="Personal">
          <h2 class="title-section">Ürünleriniz</h2>
          <div class="personal-info inner-page-padding"> 

            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th width="20%" scope="col">Resim</th>
                  <th scope="col">Ürün Eklenme Tarihi</th>
                  <th scope="col">Ürün adı</th>
                  <th scope="col">Marka</th>
                  <th scope="col">Renk</th>
                  <th scope="col">Ürün Stok</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>

                <?php 


                $say=0;

                $arraylistkampanya=array();
                $kampanyalist=new ArrayList($arraylistkampanya);
                $kampanyalist=$dbservice->KampanyaOnayDurumCek($kampanyalarim->get_kampanya_id());
                $kampanyalist=$kampanyalist->toArray();
                foreach ($kampanyalist as $urunlerim) 
                {
                  $say++;

                  ?>


                  <tr>
                    <th scope="row"><?php echo $say ?></th>
                    <td> <img src="<?php echo $urunlerim->get_urunfoto_resimyol();?>" width="50%" alt="<?php echo $urunlerim->get_urun_ad();?>" class="img-responsive"/></td>
                    <td><?php echo $urunlerim->get_urun_zaman() ?></td>
                    <td><?php echo $urunlerim->get_urun_ad() ?></td>
                    <td>  <?php 
                    $arraylistmarka=array();
                    $markalist=new ArrayList($arraylistmarka);
                    $markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
                    $markalist=$markalist->toArray();
                    foreach ($markalist as $markalarim)
                    {
                      echo $markalarim->get_marka_adi(); 
                    } 

                    ?>


                  </td>
                  <td>
                    <?php
                    $arraylistrenk=array();
                    $renkliste=new ArrayList($arraylistrenk);
                    $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                    $renkliste=$renkliste->toArray();
                    foreach ($renkliste as $renklerim) 
                    {
                      echo $renklerim->get_renk_adi();
                    }
                    ?>
                  </td>
                  <td><?php  
                  if ($urunlerim->get_urun_stok()==0)
                  {
                    $formpanel->Button_Href($urunlerim->get_urun_stok(),"stokislem?urun_id=".$urunlerim->get_urun_id(),"danger");
                  }

                  else if ($urunlerim->get_urun_stok()<=10 and $urunlerim->get_urun_stok()>0)
                  {

                    $formpanel->Button_Href($urunlerim->get_urun_stok(),"stokislem?urun_id=".$urunlerim->get_urun_id(),"warning");

                  }

                  else 
                  {
                    $formpanel->Button_Href($urunlerim->get_urun_stok(),"stokislem?urun_id=".$urunlerim->get_urun_id(),"success");
                  }


                  ?>


                </td>

                <td><center><?php 



                $kampanya_detaylarim=$dbservice->KampanyaDetayListele($urunlerim->get_urun_id());

                if ($kampanya_detaylarim->get_durum()==0) {

                  $formpanel->Button_Href("Ekle","nedmin/netting/islem.php?kampanya_urun_ekle=ok&urun_id=".$urunlerim->get_urun_id()."&kampanya_id=".$kampanyalarim->get_kampanya_id(),"primary");

                } 
                else {

                  $formpanel->Button_Href("Kaldır","nedmin/netting/islem.php?kampanya_urun_kaldir=ok&urun_id=".$urunlerim->get_urun_id()."&kampanya_id=".$kampanyalarim->get_kampanya_id(),"warning");


                } ?>


              </center> </td>

            </tr>

          <?php } ?>


        </tbody>
      </table>


    </div> 
  </div> 



</div> 


</div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>