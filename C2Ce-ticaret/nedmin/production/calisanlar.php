<?php 

include 'header.php'; 
require_once 'CLASS/Hesap.php';

//Belirli veriyi seçme işlemi
$calisansor=$admindbservices->calisanOku();

$hesapsor=$admindbservices->hesapgetir();

$Calisanlarim=$admindbservices->calisanMaasGetir();

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Çalışan Listeleme <small>,

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
          <form action="../netting/islem.php" method="POST">
            <?php $islem->Hesap_Listele($hesapsor); ?>
            <div align="right">
              <button onclick="return confirm('<?php echo $Calisanlarim->get_toplammaas(); ?> Tutarında Maaş Ödeniyor \n İşlem geri alınamaz...')" name="maasode" class="btn btn-success btn-xs">Maaş Öde</button>
            </div>
          </form>
        </div>
        <div class="x_content">


         <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
         <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
         </button>

         <!-- Div İçerik Başlangıç -->

         <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

           <?php

           $tbl=new CreateTable(6);
           $tbl->addcolumn("Ad Soyad",0);
           $tbl->addcolumn("Maaş",1);
           $tbl->addcolumn("Departman",2);
           $tbl->addcolumn("Ünvan",3);
           $tbl->addcolumn("",4);
           $tbl->addcolumn("",5);
           $tbl->TableBaslik();

           ?>

           <tbody>

            <?php 

            while($calisancek=$admindbservices->vericek($calisansor)) {
              $Calisanlarim=$cons->Calisan_ekle($calisancek);
              ?>


              <tr>
                <?php 

                $tbl->addRow($Calisanlarim->get_calisan_ad()." ".$Calisanlarim->get_calisan_soyad(),0);
                $tbl->addRow($Calisanlarim->get_calisan_maas(),1);
                $tbl->addRow($Calisanlarim->get_calisan_departman(),2);
                $tbl->addRow($Calisanlarim->get_calisan_unvan(),3);
                $tbl->AddButton("calisan-duzenle.php?calisan_id=".$Calisanlarim->get_calisan_id(),4,"Düzenle","primary");
                $tbl->AddButton("../netting/islem.php?calisan_id=".$Calisanlarim->get_calisan_id()."&calisansil=ok",5,"Sil","danger");

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
