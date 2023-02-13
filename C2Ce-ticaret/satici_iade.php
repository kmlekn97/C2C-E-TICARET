<?php 

require_once 'header.php'; 

islemanakontrol();

?>
<head>
  <style type="text/css">

    input {

      margin-left: 20px !important;

    }


  </style>
</head>

<?php 
$siparissor=$dbservice->satici_iade_liste();

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
            <h2 class="title-section">Ürün İadeleri</h2>
            <div class="personal-info inner-page-padding"> 

             <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
             <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>

             <br>
             <br>

             <table class="table table-striped">
              <thead>
                <tr>

                  <th scope="col">#</th>
                  <th scope="col">Ürün Adı</th>
                  <th scope="col">Marka</th>
                  <th scope="col">Satıcı</th>
                  <th scope="col">Fiyat</th>
                  <th scope="col">Adet</th>
                  <th scope="col">Kargo No</th>
                  <th scope="col">İade Durumu</th>
                  <th scope="col">Detay</th>
                  <th scope="col">Fatura</th>

                </tr>
              </thead>
              <tbody>

                <?php 

                while($sipariscek=$dbservice->vericek($siparissor)) {
                  $urunlerim=$cons->Urun_ekle($sipariscek);
                  $kullanicilarim=$cons->Kullanici_ekle($sipariscek);
                  $siparislerim=$cons->Siparis_ekle($sipariscek);
                  $siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
                  $iadelerim=$cons->Iade_ekle($sipariscek);
                  $say=0;
                  $say++;
                  $urun_id=$urunlerim->get_urun_id();

                  ?>


                  <tr>
                    <th scope="row"><?php echo $say ?></th>
                    <td><?php echo $urunlerim->get_urun_ad(); ?></td>
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
                  <td><?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad() ?></td>
                  <td><?php echo $siparis_detaylarim->get_urun_fiyat(); ?></td>
                  <td><?php echo $siparis_detaylarim->get_urun_adet();?></td>

                  <td><?php 

                  if ($iadelerim->get_iade_durum()==1 || $iadelerim->get_iade_durum()==2 || $iadelerim->get_iade_durum()==3) {
                    echo $iadelerim->get_kargo_no();
                  } 
                  else
                  {
                    echo "İade Onaylanmadı!!!";
                  }
                  ?>

                </td>


                <td><?php 

                if ($iadelerim->get_iade_durum()==2) {?>

                 <button class="btn btn-warning btn-xs"> Kargoda</button>



               <?php  } else if ($iadelerim->get_iade_durum()==3) {?>

                <button class="btn btn-success btn-xs"> İade Tamamlandı</button>


              <?php  } else if ($iadelerim->get_iade_durum()==0) {

                $formpanel->Button_Href("Teslim Edilmesi Bekleniyor","nedmin/netting/islem.php?iade_id=".$iadelerim->get_iade_id()."&siparis_id=".$iadelerim->get_siparis_id()."&iade_onay=ok","warning");

              } else  {?>

                <button class="btn btn-warning btn-xs"> İade İşlemleri Yapılıyor</button>


              <?php  }

              ?>



            </td>

            <td>

              <?php 

              $formpanel->Button_Href("Detay","iade-detay?iade_id=".$iadelerim->get_iade_id()."&siparis_id=".$iadelerim->get_siparis_id(),"primary");

              ?>

            </td>
            <?php

            if ($iadelerim->get_iade_durum() != 0)
            {

              echo "<td>";
              $formpanel->Button_Href("Fatura","fatura/iade-satici-fatura.php?siparis_zaman=".$siparislerim->get_siparis_zaman()."&kullanici_id=".$sipariscek['k_id']."&skullanici_id=".$sipariscek['ks_id']."&siparis_id=".$siparislerim->get_siparis_id(),"success");
              echo "</td>";

            } else { ?>

              <td>Daha Oluşmadı.</td>

            <?php    }
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