<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$admindbservices->UrunGetir();
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Listeleme <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>

            <div class="clearfix"></div>

            <?php $form->Buttonhref("Yeni Ekle","urun-ekle.php"); ?>
          </div>


          <?php 

          $islem->Kategori_listele(null,"Kategori Seç",3,"urun-list");
          $islem->Renkleri_listele("renk","urun-list","margin-left: 3px");
          $islem->Beden_listele("urun-list","beden","margin-left: 3px");

          ?>


          <div class="x_content">



           <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
           <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
           </button>

           <!-- Div İçerik Başlangıç -->

           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
             <?php

             $beden="boş";
             $tbl=new CreateTable(15);
             $tbl->addcolumn("#",0);
             $tbl->addcolumn("S.No",1);
             $tbl->addcolumn("Barkod",2);
             $tbl->addcolumn("Ürün Ad",3);
             $tbl->addcolumn("Ürün Kategori",4);
             $tbl->addcolumn("Ürün Fiyat",5);
             $tbl->addcolumn("Ürünü Koyan",6);
             $tbl->addcolumn("Renk",7);
             $tbl->addcolumn("Beden",8);
             $tbl->addcolumn("Resim İşlemleri",9);
             $tbl->addcolumn("Öne Çıkar",10);
             $tbl->addcolumn("Durum",11);
             $tbl->addcolumn("",12);
             $tbl->addcolumn("",13);
             $tbl->addcolumn("",14);
             $tbl->TableBaslik();

             ?>
             <tbody>

              <?php 

              $say=0;

              while($uruncek=$admindbservices->vericek($urunsor)) {

                $Urunlerim=$cons->Urun_ekle($uruncek);

                $kategorim=$cons->Kategori_ekle($uruncek);

                $arraylistkullanici=array();
                $kullanicilist=new ArrayList($arraylistkullanici);
                $kullanicilist=$admindbservices->kullaniciListele($Urunlerim->get_kullanici_id());
                $kullanicilist=$kullanicilist->toArray();
                foreach ($kullanicilist as $kullanicilarim) 
                {
                 $ad=$kullanicilarim->get_kullanici_ad();
                 $soyad=$kullanicilarim->get_kullanici_soyad();
                 $yetki=$kullanicilarim->get_kullanici_yetki();
               }

               $arraylistrenk=array();
               $renklist=new ArrayList($arraylistrenk);
               $renklist=$admindbservices->renkleriListele($Urunlerim->get_renk_id());
               $renklist=$renklist->toArray();
               foreach ($renklist as $renklerim) 
               {
                $renk=$renklerim->get_renk_adi();
              }

              $arraylistbeden=array();
              $bedenlist=new ArrayList($arraylistbeden);
              $bedenlist=$admindbservices->bedenArrayListele($Urunlerim->get_beden_id());
              $bedenlist=$bedenlist->toArray();
              foreach ($bedenlist as $bedenlerim) 
              {
               $beden=$bedenlerim->get_beden_icerik();
             }

             $arraylistkategori=array();
             $kategorilist=new ArrayList($arraylistkategori);
             $kategorilist=$admindbservices->kategoriListele($Urunlerim->get_kategori_id());
             $kategorilist=$kategorilist->toArray();
             foreach ($kategorilist as $kategorim) 
             {
              $kategori=$kategorim->get_kategori_ad();
            }

            $say++;



            ?>

            <tr>
              <td> <img src="../../<?php echo $Urunlerim->get_urunfoto_resimyol();?>"  width="60"/></td>
              <?php

              $tbl->addRow($say,0,20);
              $tbl->addRow($Urunlerim->get_barkod_no(),1);
              $tbl->addRow($Urunlerim->get_urun_ad(),2);
              $tbl->addRow($kategori,3);
              $tbl->addRow($Urunlerim->get_urun_fiyat(),4);
              $tbl->AddSirkettur($yetki,$tip,$kullanicilarim->get_kullanici_ad(),$kullanicilarim->get_kullanici_soyad());
              $tbl->addRow($renk,6);
              $tbl->addRow($beden,7);
              $tbl->AddButton("urun-galeri.php?urun_id=".$Urunlerim->get_urun_id(),8,"Resim İşlemleri","success");
              $tbl->AddButton("urun-ozellik.php?alt_kategori_detay_id=".$Urunlerim->get_alt_kategori_detay_id()."&urun_id=".$Urunlerim->get_urun_id(),9,"Ürün Özellik","primary");

              if ($Urunlerim->get_urun_onecikar()==0) {
                $tbl->AddButton("../netting/islem.php?urun_id=".$Urunlerim->get_urun_id()."&urun_one=1&urun_onecikar=ok",10,"Öne Çıkar","success");
              } 
              else if ($Urunlerim->get_urun_onecikar()==1) {
                $tbl->AddButton("../netting/islem.php?urun_id=".$Urunlerim->get_urun_id()."&urun_one=0&urun_onecikar=ok",10,"Kaldır","warning");
              } ?>

              <td>
                <center>
                  <?php

                  if ($Urunlerim->get_urun_durum()==1) {
                    $form->Buttonhref2("Aktif",null);
                  }
                  else{
                    $form->Buttonhref2("Pasif",null,"danger");
                  }

                  ?>
                </center>
              </td>


              <?php

              $tbl->AddButton("urun-duzenle.php?urun_id=".$Urunlerim->get_urun_id(),11,"Düzenle","primary");
              $tbl->AddButton("../netting/islem.php?urun_id=".$Urunlerim->get_urun_id()."&urunfoto_resimyol=".$Urunlerim->get_urunfoto_resimyol()."&adminurunsil=ok",12,"Sil","danger","Ürünü silmek istediğinize emin misiniz?");

              ?>

            </tr>




          <?php  }

          ?>


        </tbody>
      </table>

      <!-- Div İçerik Bitişi -->


    </div>
  </div>
</div>
</div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>

<script type="text/javascript">

  $(document).ready(function(){


    $("#urun-list").change(function(){


      var tip=$("#urun-list").val();

      if (tip=="4") {


        $("#beden").show();
        $("#icerik").show();



      }
      else{
        $("#beden").hide();
        $("#icerik").hide();
      } 

    }).change();



  });

</script>

<script src="js/jquery-urun.js"></script>

