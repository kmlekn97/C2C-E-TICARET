<?php 

include 'header.php'; 

require_once '../netting/Istatistik.php';
$istatistik=new hesap();

$kategorialtdetaycek=$admindbservices->altkategoricek($_GET['alt_kategori_id']);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>İstatistik <small>,

             <?php $form->Durum_cek(); ?>



           </small></h2>
           <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />


          <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
          <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
          </button>


          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <?php
            $tbl=new CreateTable(10);
            $tbl->addcolumn("S.No",0);
            $tbl->addcolumn("Alt Kategori",1);
            $tbl->addcolumn("Genel Ciro",2);
            $tbl->addcolumn("Genel Yüzde",3);
            $tbl->addcolumn("Günlük Ciro",4);
            $tbl->addcolumn("Günlük Yüzde",5);
            $tbl->addcolumn("Aylık Ciro",6);
            $tbl->addcolumn("Aylık Yüzde",7);
            $tbl->addcolumn("Yıllık Ciro",8);
            $tbl->addcolumn("Yıllık Yüzde",9);
            $tbl->addcolumn("",10);
            $tbl->TableBaslik();
            ?>

            <tbody>

              <?php 

              $say=0;

              $arraylistaltkategoridetay=array();
              $altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
              $altkategoridetaylist=$admindbservices->altkategoriSiraliListele($_GET['kategori_id'],$kategorialtcek);
              $altkategoridetaylist=$altkategoridetaylist->toArray();
              foreach ($altkategoridetaylist as $altkategori) 
              {

                $gunluk="WHERE DAY(siparis.siparis_zaman)=DAY(CURDATE()) AND MONTH(siparis.siparis_zaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
                $aylik="WHERE MONTH(siparis.siparis_zaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
                $yillik="WHERE YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";

                $say++;
                ?>

                <tr>
                  <?php
                  $tbl->addRow($say,0,"20");
                  $tbl->addRow($altkategori->get_alt_kategori_ad(),1,"sortable");
                  $tbl->addRow(number_format($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),null), 2, ',', '.'),2);
                  $tbl->addRow(number_format(($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),null)*100)/$istatistik->altkategorihesapla("kategori_top",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),null), 2, '.', ''),3);
                  $tbl->addRow(number_format($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$gunluk), 2, ',', '.'),4);
                  $tbl->addRow(number_format(($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$gunluk)*100)/$istatistik->altkategorihesapla("kategori_top",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$gunluk), 2, '.', ''),5);
                  $tbl->addRow(number_format($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$aylik), 2, ',', '.'),6);
                  $tbl->addRow(number_format(($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$aylik)*100)/$istatistik->altkategorihesapla("kategori_top",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$aylik), 2, '.', ''),7);
                  $tbl->addRow(number_format($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$yillik), 2, ',', '.'),8);
                  $tbl->addRow(number_format(($istatistik->altkategorihesapla("toplam",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$yillik)*100)/$istatistik->altkategorihesapla("kategori_top",$altkategori->get_kategori_id(),$altkategori->get_alt_kategori_id(),$yillik), 2, '.', ''),9);
                  $tbl->AddButton("altkategori_detay_istatistik.php?alt_kategori_id=".$altkategori->get_alt_kategori_id(),10,"Alt Kategori Detay İstatistik","primary");
                  ?>

                </tr>



              <?php  }

              ?>


            </tbody>
          </table>



        </div>
      </div>
    </div>
  </div>



  <hr>
  <hr>
  <hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>

