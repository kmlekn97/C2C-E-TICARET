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


        <div class="settings-details tab-content" style="width: 120%">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Ürünleriniz</h2>
            <div class="personal-info inner-page-padding"> 

             <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
             <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>

             <br>
             <br>
             <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Resim</th>
                  <th scope="col">Barkod</th>
                  <th scope="col">Ürün Eklenme Tarihi</th>
                  <th scope="col">Ürün adı</th>
                  <th scope="col">Marka</th>
                  <th scope="col">Fiyat</th>
                  <th scope="col">Ürün Stok</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                
                $say=0;

                $arraylisturun=array();
                $urunlist=new ArrayList($arraylisturun);
                $urunlist=$dbservice->kullaniciurunleriListeleme();
                $urunlist=$urunlist->toArray();
                foreach ($urunlist as $urunlerim) 
                {
                  $say++;
                  ?>
                  <tr>
                   <th scope="row"><?php echo $say ?></th>
                   <td width="0.5px"> <img src="<?php echo $urunlerim->get_urunfoto_resimyol();?>" alt="<?php echo $urunlerim->get_urun_ad();?>" class="img-responsive"/>
                    <div style="display: none; "> <?php echo $urunlerim->get_urunfoto_resimyol(); ?></div>
                  </td>
                  <td><?php echo $urunlerim->get_barkod_no() ?></td>
                  <td><?php echo $urunlerim->get_urun_zaman() ?></td>
                  <td><?php

                  $arraylistrenk=array();
                  $renklist=new ArrayList($arraylistrenk);
                  $renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
                  $renkliste=$renkliste->toArray();
                  foreach ($renkliste as $renklerim) 
                  {
                    $renk=$renklerim->get_renk_adi();
                  }

                  $arraylistbeden=array();
                  $bedenlist=new ArrayList($arraylistbeden);
                  $bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
                  $bedenlist=$bedenlist->toArray();
                  foreach ($bedenlist as $bedenlerim) 
                  {
                    $beden=$bedenlerim->get_beden_icerik();
                  }

                  echo $renk." ".$urunlerim->get_urun_ad()." ".$beden; ?></td>
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
                <td><?php echo number_format($urunlerim->get_urun_fiyat(), 2, ',', '.'); ?></td>
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
              <td>
                <center>
                  <?php 

                  $formpanel->Button_Href("Ürün Özellik","urun-ozellik.php?alt_kategori_detay_id=".$urunlerim->get_alt_kategori_detay_id()."&urun_id=".$urunlerim->get_urun_id(),"primary");

                  ?>
                </center>
              </td>

              <td>
                <center>
                  <?php

                  $formpanel->Button_Href("Resim İşlemleri","urun-galeri.php?urun_id=".$urunlerim->get_urun_id(),"success");

                  ?>
                </center>
              </td>

              <td>
                <center>
                  <?php 

                  if ($urunlerim->get_urun_onecikar()==0) {

                    $formpanel->Button_Href("Öne Çıkar","nedmin/netting/islem.php?urun_id=".$urunlerim->get_urun_id()."&urun_one=1&urun_vitrin=ok","success");
                  } elseif ($urunlerim->get_urun_onecikar()==1) {

                    $formpanel->Button_Href("Kaldır","nedmin/netting/islem.php?urun_id=".$urunlerim->get_urun_id()."&urun_one=0&urun_vitrin=ok","warning");
                  }

                  ?>

                </center>
              </td>

              <td>

                <?php

                $formpanel->Button_Href("Düzenle","urun-duzenle?urun_id=".$urunlerim->get_urun_id(),"primary");

                ?>

              </td>

              <td>

                <?php if ($urunlerim->get_urun_durum()==0) {?>

                  <button class="btn btn-warning btn-xs">Onay Bekliyor</button>

                <?php } else {


                  $formpanel->Button_Href("Sil","nedmin/netting/islem.php?urunsil=ok&urun_id=".$urunlerim->get_urun_id()."&urunfoto_resimyol=".$urunlerim->get_urunfoto_resimyol(),"danger","Bu ürünü silmek istiyormusunuz? İşlem geri alınamaz...");
                }

                ?>


              </td>
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