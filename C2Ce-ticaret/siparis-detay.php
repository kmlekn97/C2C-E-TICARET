<?php 

require_once 'header.php'; 

islemanakontrol();

$kdvtoplam=0;
$aratoplam=0;
$toplam=0;

?>
<head>
  <style type="text/css">

    input {

      margin-left: 20px !important;

    }


  </style>
</head>

<?php 
$siparissor=$dbservice->siparisdetaygetir();

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
            <h2 class="title-section">sipariş detayı</h2>
            <div class="personal-info inner-page-padding"> 

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th>Barkod No</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Marka</th>
                    <th scope="col">Renk</th>
                    <th scope="col">Beden</th>
                    <th scope="col">Satıcı</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">Adet</th>
                    <th scope="col">Kargo No</th>
                    <th scope="col">Ürün Durumu</th>
                    <th scope="col">İade</th>
                    <?php 
                    $say=0;
                    while($sipariscek=$dbservice->vericek($siparissor)) {
                      date_default_timezone_set('Etc/GMT-3');
                      $tarih=date("Y.m.d  H:i:s");
                      $fark= (($tarih)-($sipariscek['siparisdetay_kargozaman']));
                      $toplam+=$sipariscek['satis_fiyat']*$sipariscek['urun_adet'];
                      $kdvtoplam+=($sipariscek['satis_fiyat']*$sipariscek['urun_kdv'])/100;

                      $siparislerim=$cons->Siparis_ekle($sipariscek);
                      $siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
                      $kullanicilarim=$cons->Kullanici_ekle($sipariscek);
                      $urunlerim=$cons->Urun_ekle($sipariscek);

                      if ($urunlerim->get_kategori_id()!=13 && $fark<15 && $siparis_detaylarim->get_iade_et()==0) {?> 

                      <?php } ?>


                    </tr>
                  </thead>
                  <tbody>

                    <?php 

                    $say++;


                    $siparisdetay_onay=$siparis_detaylarim->get_siparisdetay_onay();
                    $siparisdetay_yorum=$siparis_detaylarim->get_siparisdetay_yorum();
                    $urun_id.=$urunlerim->get_urun_id().",";

                    ?>


                    <tr>
                      <th scope="row"><?php echo $say ?></th>
                      <td><?php echo $urunlerim->get_barkod_no() ?></td>
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
                    <td><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad() ?></td>
                    <td><?php echo number_format($sipariscek['satis_fiyat'], 2, ',', '.'); ?></td>
                    <td><?php echo $siparis_detaylarim->get_urun_adet();?></td>

                    <td><?php 

                    if ($siparis_detaylarim->get_siparisdetay_onay()==2 || $siparis_detaylarim->get_siparisdetay_onay()==3) {

                      echo $siparis_detaylarim->get_siparisdetay_kargono();


                    } 
                    else
                    {
                      echo "Sipariş Onaylanmadı!!!";
                    }
                    ?>

                  </td>


                  <td><?php 

                  if ($siparis_detaylarim->get_siparisdetay_onay()==2) {?>

                   <button class="btn btn-warning btn-xs"> Kargoya Verildi</button>



                 <?php  } else if ($siparis_detaylarim->get_siparisdetay_onay()==3) {?>

                  <button class="btn btn-success btn-xs"> Teslim Edildi</button>


                <?php  } else if ($siparis_detaylarim->get_siparisdetay_onay()==0) {?>

                  <button class="btn btn-warning btn-xs"> Teslim Edilmesi Bekleniyor</button>


                  <?php  

                } else  {?>

                  <button class="btn btn-warning btn-xs"> Ürün İşlemleri Yapılıyor</button>


                <?php  }

                ?>



              </td>
              <td>

                <?php if ($urunlerim->get_kategori_id()!=13 && $fark<15 && $fark>0 && $siparis_detaylarim->get_iade_et()==0) {

                  $formpanel->Button_Href("İade","iade.php?siparis_id=".$siparislerim->get_siparis_id(),"danger");

                } ?>


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
      <br>
      <br>
      <?php 




      if ($siparisdetay_onay==3 and $siparisdetay_yorum==0) {?>



        <!-- Yorum Alanı Başlangıç -->
        <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
          <div class="settings-details tab-content">
            <div class="tab-pane fade active in" id="Personal">
              <h2 class="title-section">Deneyimine Yorumla ve Puanla</h2>
              <div class="personal-info inner-page-padding"> 

                <div class="form-group">
                  <label class="col-sm-3 control-label">Puanla</label>
                  <div class="col-sm-9">
                   <input type="radio" name="yorum_puan" value="1"> 1
                   <input type="radio" name="yorum_puan" value="2"> 2
                   <input type="radio" name="yorum_puan" value="3"> 3
                   <input type="radio" name="yorum_puan" value="4"> 4
                   <input type="radio" name="yorum_puan" value="5"> 5
                 </div>
               </div>
               
               <input type="hidden" value="<?php echo $urun_id ?>" name="urun_id">
               <input type="hidden" value="<?php echo htmlspecialchars($_GET['siparis_id']) ?>" name="siparis_id">



               <div class="form-group">
                <label class="col-sm-3 control-label">Yorumunuz</label>
                <div class="col-sm-9">
                  <textarea style="height: 200px;" class="form-control"  name="yorum_detay" placeholder="Yorumunuzu Giriniz" required="" type="text"></textarea>
                </div>
              </div>



              <div class="form-group">

                <div align="right" class="col-sm-12">
                 <button class="update-btn" name="puanyorumekle" id="login-update">Yorum ve Puanı Kaydet</button>

               </div>
             </div>                                        
           </div> 
         </div> 



       </div> 

     </form> 

     <!-- Yorum Alanı Finish -->

   <?php }  else if ($siparisdetay_onay==2 and $siparisdetay_yorum==1) {?>


     <p>Bu ürün için oylama ve yorum yapılmıştır.</p>

   <?php } ?>
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