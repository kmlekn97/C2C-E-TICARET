<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi



?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Beden Listeleme <small>,

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <div class="clearfix"></div>

            <?php $form->Buttonhref("Yeni Ekle","beden-ekle.php"); ?>

            
          </div>
          <div class="x_content">

            <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
            <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </button>


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(7);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Beden Ad",1);
              $tbl->addcolumn("",2);
              $tbl->addcolumn("",3);
              $tbl->addcolumn("",4);
              $tbl->addcolumn("",5);
              $tbl->addcolumn("",6);
              $tbl->TableBaslik();

              ?>

              <tbody>

                <?php 

                $say=0;

                $arraylistbeden=array();
                $bedenlist=new ArrayList($arraylistbeden);
                $bedenlist=$admindbservices->AllBedenDisplay();
                $bedenlist=$bedenlist->toArray();
                foreach ($bedenlist as $bedenler) 
                {

                 $arraylistkategori=array();
                 $kategorilist=new ArrayList($arraylistkategori);
                 $kategorilist=$admindbservices->kategoriListele($bedenler->get_kategori_id());
                 $kategorilist=$kategorilist->toArray();
                 foreach ($kategorilist as $kategorim) 
                 {
                   $kategori=$kategorim->get_kategori_ad();
                 }

                 $arraylistaltkategori=array();
                 $altkategorilist=new ArrayList($arraylistaltkategori);
                 $altkategorilist=$admindbservices->altKategoriListelearray($bedenler->get_alt_kategori_id());
                 $altkategorilist=$altkategorilist->toArray();
                 foreach ($altkategorilist as $alt_kategorilerim) 
                 {
                   $alt_kategori=$alt_kategorilerim->get_alt_kategori_ad();
                 }

                 $arraylistaltkategoridetay=array();
                 $altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
                 $altkategoridetaylist=$admindbservices->altKategoridetayListelearray($bedenler->get_alt_kategori_detay_id());
                 $altkategoridetaylist=$altkategoridetaylist->toArray();
                 foreach ($altkategoridetaylist as $alt_kategori_detay) 
                 {
                   $alt_kategori_detay=$alt_kategori_detay->get_alt_kategori_detay_ad();
                 }

                 if ($bedenler->get_alt_kategori_detay_id()==0)
                  $alt_kategori_detay="-";

                if ($bedenler->get_alt_kategori_id()==0)
                  $alt_kategori="-";
                $say++;?>

                <tr>
                  <?php

                  $tbl->addRow($say,0,"20");
                  $tbl->addRow($bedenler->get_beden_icerik(),1);
                  $tbl->addRow($kategori,2);
                  $tbl->addRow($alt_kategori,3);
                  $tbl->addRow($alt_kategori_detay,4);
                  $tbl->AddButton("beden-duzenle.php?beden_id=".$bedenler->get_beden_id(),5,"Düzenle","primary");
                  $tbl->AddButton("../netting/islem.php?beden_id=".$bedenler->get_beden_id()."&bedensil=ok",6,"Sil","danger");

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