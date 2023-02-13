<?php 

require_once 'header.php'; 
islemanakontrol();
$urunfotosor=$dbservice->urunfotogaleriListesi();

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


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">


            </div>

            <div class="col-md-12">
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                  <form action="" method="POST" >
                    <div class="input-group">
                      <input type="text" class="form-control" name="aranan" placeholder="Anahtar Kelime Giriniz...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="arama">Ara!</button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>


            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                     <div align="left" class="col-md-6">
                      <h2 >Resim Ürün Fotoğraf İşlemleri <small>
                        <?php
                        echo $urunfotosor->rowCount()." kayıt listelendi.";
                        if (htmlspecialchars($_GET['durum'])=='ok') {?> 

                          <b style="color:green;">İşlem başarılı...</b>

                        <?php } elseif (htmlspecialchars($_GET['durum'])=='no')  {?>

                          <b style="color:red;">İşlem Başarısız...</b>

                          <?php } ?></small></h2><br>
                        </div>
                        <form  action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data">

                          <input type="hidden" name="urun_id" value="<?php echo htmlspecialchars($_GET['urun_id']); ?>">

                          <div align="right" class="col-md-6">
                            <button type="submit" name="urunfotomagazasil"  class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Seçilenleri Sil</button>
                            <a class="btn btn-success" href="urun-foto-yukle.php?urun_id=<?php echo htmlspecialchars($_GET['urun_id']);?>"><i class="fa fa-plus" aria-hidden="true"></i> Ürün Fotoğraf Yükle</a>
                          </div>
                          <div class="clearfix"></div>
                        </div>


                        <div class="x_content">


                          <?php

                $sayfada = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                $sorgu=$dbsql->read("urunfoto");
                $toplam_urunfoto=$sorgu->rowCount();

                $toplam_sayfa = ceil($toplam_urunfoto / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

          // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 

        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                $limit = ($sayfa - 1) * $sayfada;

                $urunfotosor=$dbsql->wread("urunfoto","urun_id",htmlspecialchars($_GET['urun_id']),[
                  "columns_name" => "urunfoto_id",
                  "columns_sort" => "DESC",
                  "limit" => $limit,$sayfada
                ]);
                while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) { 

                  $fotolarim=$cons->Urunfoto_ekle($urunfotocek);

                  ?>

                  <div class="col-md-55">
                   <label>
                    <div class="image view view-first">
                      <img style="width: 216px; height: 288px; display: block;" src="<?php echo $fotolarim->get_urunfoto_resimyol(); ?>" alt="image" />
                      <div class="mask">
                        <p><?php echo $urunfotocek['urunfoto_ad']; ?> <?php echo $fotolarim->get_urun_id(); ?></p>
                        <div class="tools tools-bottom">

                          <!--<a href="#"><i class="fa fa-times"></i></a>-->

                        </div>

                      </div>

                    </div>

                    <?php  array("$urunfotosec"); ?>

                    <?php  array("$urunfotosecyol"); ?>


                    <input type="checkbox" name="urunfotosec[]" id="urunfotosecyol[]"  value="<?php echo $urunfotocek['urunfoto_id']; $urunfotocek['urunfoto_resimyol']; ?>" > Seç
                  </label>


                </div>

              <?php } ?>

              <div align="right" class="col-md-12">
                <ul class="pagination">

                  <?php

                  $s=0;

                  while ($s < $toplam_sayfa) {

                    $s++; ?>

                    <?php 

                    if ($s==$sayfa) {?>

                      <li class="active">

                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                    <?php } else {?>


                      <li>

                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                    <?php   }

                  }

                  ?>

                </ul>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!-- /page content -->

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