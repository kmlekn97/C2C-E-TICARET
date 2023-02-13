<?php 

include 'header.php'; 
require_once 'CLASS/Renk.php';

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Renk Listeleme <small>

              <?php $form->Durum_cek(); ?>


            </small></h2>

            <div class="clearfix"></div>

            <?php  
            $form->Buttonhref("Yeni Ekle","renk-ekle.php");
            ?>

          </div>
          <div class="x_content">


           <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
           <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
           </button>


           <!-- Div İçerik Başlangıç -->

           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(4);
            $tbl->addcolumn("S.No",0);
            $tbl->addcolumn("Renk Ad",1);
            $tbl->addcolumn("",2);
            $tbl->addcolumn("",3);
            $tbl->TableBaslik();

            ?>


            <tbody>

              <?php 

              $say=0;

              $arraylistrenk=array();
              $renklist=new ArrayList($arraylistrenk);
              $renklist=$admindbservices->AllRenkleriListele();
              $renklist=$renklist->toArray();
              foreach ($renklist as $renklerim) 
              {


                 $say++;?>

                 <tr>

                  <?php

                  $tbl->addRow($say,0,20);
                  $tbl->addRow($renklerim->get_renk_adi(),1);
                  $tbl->AddButton("renk-duzenle.php?renk_id=".$renklerim->get_renk_id(),2,"Düzenle","primary");
                  $tbl->AddButton("../netting/islem.php?renk_id=".$renklerim->get_renk_id()."&renksil=ok",3,"Sil","danger");

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
