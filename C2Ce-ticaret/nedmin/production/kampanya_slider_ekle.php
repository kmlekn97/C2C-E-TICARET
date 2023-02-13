<?php 

include 'header.php';
?>
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
              <h2 >Kampanya Fotoğraf İşlemleri <small>
                <?php
                echo $say." kayıt listelendi.";
                if (htmlspecialchars($_GET['durum'])=='ok') {?> 

                  <b style="color:green;">İşlem başarılı...</b>

                <?php } elseif (htmlspecialchars($_GET['durum'])=='no')  {?>

                  <b style="color:red;">İşlem Başarısız...</b>

                  <?php } ?></small></h2><br>
                </div>
                <form  action="../netting/islem.php" method="POST" enctype="multipart/form-data">

                  <input type="hidden" name="kampanya_id" value="<?php echo htmlspecialchars($_GET['kampanya_id']); ?>">

                  <div align="right" class="col-md-6">
                    <button type="submit" name="kampanyafotosil"  class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Seçilenleri Sil</button>
                    <a class="btn btn-success" href="kampanya-foto-yukle.php?kampanya_id=<?php echo htmlspecialchars($_GET['kampanya_id']);?>"><i class="fa fa-plus" aria-hidden="true"></i> Kampanya Fotoğraf Yükle</a>
                  </div>
                  <div class="clearfix"></div>
                </div>


                <div class="x_content">


                  <?php

                $sayfada = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                $sorgu=$admindbservices->kampanyaSorgugetir();
                $toplam_urunfoto=$sorgu->rowCount();

                $toplam_sayfa = ceil($toplam_urunfoto / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

          // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 

        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                $limit = ($sayfa - 1) * $sayfada;

                $arraylistkampanyafoto=array();
                $kampanyafotolist=new ArrayList($arraylistkampanyafoto);
                $kampanyafotolist=$admindbservices->kampanyaFotoGetir($_GET['kampanya_id'],$limit,$sayfada);
                $kampanyafotolist=$kampanyafotolist->toArray();
                foreach ($kampanyafotolist as $kampanya_galeri) 
                {

                  ?>

                  <div class="col-md-55">
                   <label>
                    <div class="image view view-first">
                      <img style="width: 250px; height: 100px; display: block;" src="../../<?php echo $kampanyafotocek['kampanya_resimyol']; ?>" alt="image" />
                      <div class="mask">
                        <p><?php echo $kampanyafotocek['urunfoto_ad']; ?> <?php echo $kampanya_galeri->get_kampanya_galeri_id(); ?></p>
                        <div class="tools tools-bottom">

                          <!--<a href="#"><i class="fa fa-times"></i></a>-->

                        </div>

                      </div>

                    </div>

                    <?php  array("$kampanyafotosec"); ?>

                    <?php  array("$kampanyafotosecyol"); ?>


                    <input type="checkbox" name="kampanyafotosec[]" id="kampanyafotosecyol[]"  value="<?php echo $kampanya_galeri->get_kampanya_galeri_id(); $kampanya_galeri->get_kampanya_resimyol(); ?>" > Seç
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

                        <a href="kampanyafoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                    <?php } else {?>


                      <li>

                        <a href="kampanyafoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

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



<?php include 'footer.php'; ?>
