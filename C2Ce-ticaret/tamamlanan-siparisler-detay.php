<?php 

require_once 'header.php'; 

islemanakontrol();

$kdvtoplam=0;
$aratoplam=0;
$toplam=0;
$siparissorkargo=$dbservice->tamamlanansiparisdetaykargogetir();
$kargo=$dbservice->vericek($siparissorkargo);
$siparislerim=$cons->Siparis_ekle($kargo);
$siparis_detaylarim=$cons->Siparis_Detay_ekle($kargo);
$kullanicilarim=$cons->Kullanici_ekle($kargo);
$urunlerim=$cons->Urun_ekle($kargo);

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

        <div class="settings-details tab-content" style="width: 120%">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Tamamlanan Siparişler</h2>
            <div class="personal-info inner-page-padding"> 
             <div style="float: right;">
              <?php echo "Kargo No: ".$siparis_detaylarim->get_siparisdetay_kargono(); ?>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th>Barkod</th>  
                  <th scope="col">Tarih</th>
                  <th scope="col">Sipariş No</th>    
                  <th scope="col">Ürün Ad</th>
                  <th scope="col">Marka</th>
                  <th scope="col">Renk</th>
                  <th scope="col">Beden</th>
                  <th scope="col">Ürün Fiyat</th>
                  <th scope="col">Adet</th>
                  <th scope="col">Durum</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                <?php 
                $siparissor=$dbservice->tamamlanansiparisdetaykargogetir();

                while($sipariscek=$dbservice->vericek($siparissor)) {


                  $siparislerim=$cons->Siparis_ekle($sipariscek);
                  $siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
                  $kullanicilarim=$cons->Kullanici_ekle($sipariscek);
                  $urunlerim=$cons->Urun_ekle($sipariscek); 


                  $say=0; 
                  $say++;
                  $toplam+=$sipariscek['satis_fiyat']*$siparis_detaylarim->get_urun_adet();
                  $kdvtoplam+=($sipariscek['satis_fiyat']*$urunlerim->get_urun_kdv())/100;


                  ?>


                  <tr>
                    <th scope="row"><?php echo $say ?></th>
                    <td><?php echo $urunlerim->get_barkod_no() ?></td>
                    <td><?php echo $siparislerim->get_siparis_zaman() ?></td>
                    <td><?php echo $siparislerim->get_siparis_id() ?></td>
                    <td><?php echo $urunlerim->get_urun_ad() ?></td>

                    <td>  <?php 
                    $arraylistmarka=array();
                    $markalist=new ArrayList($arraylistmarka);
                    $markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
                    $markalist=$markalist->toArray();
                    foreach ($markalist as $markalarim)
                    {
                      $marka=$markalarim->get_marka_adi();
                    }
                    echo $marka; ?>


                  </td>
                  <td>
                    <?php 
                    $arraylistrenk=array();
                    $renklist=new ArrayList($arraylistrenk);
                    $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                    $renkliste=$renkliste->toArray();
                    foreach ($renkliste as $renklerim) 
                    {
                      $renk=$renklerim->get_renk_adi();
                    }
                    echo $renk;

                    ?>
                  </td>
                  <td>
                    <?php

                    $arraylistbeden=array();
                    $bedenlist=new ArrayList($arraylistbeden);
                    $bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
                    $bedenlist=$bedenlist->toArray();
                    foreach ($bedenlist as $bedenlerim) 
                    {
                      $beden=$bedenlerim->get_beden_icerik();
                    }
                    echo $beden;
                    ?>
                  </td>
                  <td><?php echo number_format($sipariscek['satis_fiyat'], 2, ',', '.'); ?></td>
                  <td><?php echo $siparis_detaylarim->get_urun_adet();?></td>
                  <td><?php 

                  if ($siparis_detaylarim->get_siparisdetay_onay()==0) {

                    $formpanel->Button_Href("Teslim Et","nedmin/netting/kullanici.php?urunteslim=ok&siparisdetay_id=".$siparis_detaylarim->get_siparisdetay_id()."&siparis_id=".$siparislerim->get_siparis_id(),"warning","Ürünü Teslim Ediyorsunuz Bu İşlem Geri Alınamaz");

                    ?>


                  <?php  } else if ($siparis_detaylarim->get_siparisdetay_onay()==1) {?>

                    <button class="btn btn-success btn-xs"> Alıcıdan Onay Bekliyor</button>


                  <?php  }



                  else if ($siparis_detaylarim->get_siparisdetay_onay()==2) {?>

                    <button class="btn btn-success btn-xs"> Kargoda</button>


                  <?php  }
                  else
                    {?>
                      <button class="btn btn-success btn-xs"> Teslim Edildi</button>
                    <?php }

                    ?>


                  </td>
                  <td>

                    <?php $formpanel->Button_Href("Bilgi","siparis-bilgi?siparis_id=".$siparislerim->get_siparis_id(),"primary"); ?>

                  </td>

                </tr>

              <?php } ?>


            </tbody>
          </table>

          <div style="float: right;">
            <?php echo "KDV:   ".number_format($kdvtoplam, 2, ',', '.')." T.L."?> 
            <br>
            <?php echo "Ara Toplam:   ".number_format($toplam-$kdvtoplam, 2, ',', '.')." T.L."?>    
            <br>
            <?php echo "Genel Toplam:   ".number_format($toplam, 2, ',', '.')." T.L."?>       
          </div> 
          <br>
          <br>


        </div> 
      </div> 



    </div> 


  </div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>

<script type="text/javascript">

  $(document).ready(function(){


    $("#kullanici_tip").change(function(){


      var tip=$("#kullanici_tip").val();

      if (tip=="PERSONAL") {


        $("#kurumsal").hide();
        $("#tc").show();



      } else if (tip=="PRIVATE_COMPANY") {

        $("#kurumsal").show();
        $("#tc").hide();

      }


    }).change();



  });

</script>