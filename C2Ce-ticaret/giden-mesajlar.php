
<?php 

require_once 'header.php'; 

islemanakontrol();

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
            <h2 class="title-section">Giden Mesajlar</h2>
            <div class="personal-info inner-page-padding"> 

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mesaj Tarihi</th>
                    <th scope="col">Gönderilen Kullanıcı</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Detay</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php 

                  $mesajsor=$dbservice->mesajgidenlistele();

                  $say=0;

                  while($mesajcek=$dbservice->vericek($mesajsor)) { 

                    $mesajlarim=$cons->Mesaj_ekle($mesajcek);
                    $kullanicilarim=$cons->Kullanici_ekle($mesajcek);
                    $say++;
                    $kullanici_gon=$mesajlarim->get_kullanici_gon();
                    ?>

                    <tr>
                      <th scope="row"><?php echo $say ?></th>
                      <td><?php echo $mesajlarim->get_mesaj_zaman(); ?></td>
                      <td><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad() ?></td>
                      <td><?php echo $kullanicilarim->get_kullanici_mail(); ?></td>

                      <?php

                      echo "<td>";
                      $formpanel->Button_Href("Mesajı Oku","mesaj-detay?gidenmesaj=ok&mesaj_id=".$mesajlarim->get_mesaj_id()."&kullanici_gon=".$mesajlarim->get_kullanici_gon(),"primary");
                      echo "</td>";
                      echo "<td>";
                      $formpanel->Button_Href("Sil","nedmin/netting/kullanici.php?gidenmesajsil=ok&mesaj_id=".$mesajlarim->get_mesaj_id(),"danger","Bu mesajı silmek istiyormusunuz? İşlem geri alınamaz...");
                      echo "</td>";

                      ?>

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