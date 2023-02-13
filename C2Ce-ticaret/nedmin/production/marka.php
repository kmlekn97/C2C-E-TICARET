<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$markasor=$admindbservices->MarkalariGetir(1);
  ?>

  
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">

      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Marka Listeleme <small> 

               <?php $form->Durum_cek(); ?>


             </small></h2>

             <div class="clearfix"></div>

             <div align="right">
              <a href="marka-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
              <a href="marka_detay.php"><button class="btn btn-primary btn-xs">Detay</button></a>
            </div>
          </div>

          <?php

          $islem->Kategori_listele(null,"Kategori",3,"marka-list");

          ?>

          <div class="x_content">



           <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
           <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
           </button>   

           
           <!-- Div İçerik Başlangıç -->

           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(5);
            $tbl->addcolumn("S.No",0);
            $tbl->addcolumn("Marka Ad",1);
            $tbl->addcolumn("Marka Kategori",2);
            $tbl->addcolumn("",3);
            $tbl->addcolumn("",4);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 

              $say=0;

              while($markacek=$admindbservices->vericek($markasor)) { 

                $markalarim=$cons->Marka_ekle($markacek);

                $kategorim=$cons->Kategori_ekle($markacek);


                $say++;?>

                <tr>
                  <?php

                  $tbl->addRow($say,0,20);
                  $tbl->addRow($markalarim->get_marka_adi(),1);
                  $tbl->addRow($kategorim->get_kategori_ad(),2);
                  $tbl->AddButton("marka-duzenle.php?marka_id=".$markalarim->get_marka_id(),3,"Düzenle","primary");
                  $tbl->AddButton("../netting/islem.php?marka_id=".$markalarim->get_marka_id()."&markasil=ok",4,"Sil","danger");

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
