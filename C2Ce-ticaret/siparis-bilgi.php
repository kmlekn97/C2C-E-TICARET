
<?php 

require_once 'header.php'; 

islemanakontrol();

$siparissor=$dbservice->siparis_bilgi_getir();

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






        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Müşteri Bilgileri</h2>
            <div class="personal-info inner-page-padding"> 
              <div style="margin-left: 15rem;">
                <?php
                while($sipariscek=$dbservice->vericek($siparissor)) { 
                  
                  $urunlerim=$cons->Urun_ekle($sipariscek);
                  $kullanicilarim=$cons->Kullanici_ekle($sipariscek);
                  $siparislerim=$cons->Siparis_ekle($sipariscek);
                  $siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);

                  ?>
                  <div class="form-group">
                    <label><b>Ad:</b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $kullanicilarim->get_kullanici_ad() ?></label>
                  </div>
                  <div class="form-group">
                    <label><b>Soyad:&emsp;&emsp;&emsp;&emsp;&nbsp;</b><?php echo $kullanicilarim->get_kullanici_soyad() ?></label>
                  </div>
                  <div class="form-group">
                    <label><b>Tel No:&emsp;&emsp;&emsp;&emsp;&nbsp;</b><?php echo $kullanicilarim->get_kullanici_gsm() ?></label>
                  </div>
                  <div class="form-group">
                    <label><b>Mail Adresi:&emsp;&nbsp;&nbsp;&nbsp;  </b><?php echo $kullanicilarim->get_kullanici_mail() ?></label>
                  </div>
                  <div class="form-group">
                    <label><b>Açık Adres:&emsp;&emsp;&nbsp;</b><?php echo html_entity_decode($kullanicilarim->get_kullanici_adres()) ?></label>
                  </div>
                  <div class="form-group">
                    <label><b>İl:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</b><?php echo $kullanicilarim->get_kullanici_il() ?></label>
                  </div>
                  <div class="form-group">
                    <label><b>İlçe:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</b><?php echo $kullanicilarim->get_kullanici_ilce() ?></label>
                  </div>
                  <?php
                }
                ?>
              </div>
              

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