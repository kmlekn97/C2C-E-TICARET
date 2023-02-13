<?php 

include 'header.php';

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>İstatistik Listeleme <small>

              <?php $form->Durum_cek(); ?>



            </small></h2>

            <div class="clearfix"></div>
          </div>

          <div class="x_content">
           <!-- Div İçerik Başlangıç -->

           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(3);
            $tbl->addcolumn("S.No",0);
            $tbl->addcolumn("Kategori Ad",1);
            $tbl->addcolumn("",2);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 

              $say=0;

              $arraylistkategori=array();
              $kategorilist=new ArrayList($arraylistkategori);
              $kategorilist=$admindbservices->kategoriListeleall();
              $kategorilist=$kategorilist->toArray();
              foreach ($kategorilist as $kategoriler) 
              {


                $say++;?>

                <tr>

                  <?php

                  $tbl->addRow($say,0,20);
                  $tbl->addRow($kategoriler->get_kategori_ad(),1);
                  $tbl->AddButton("altkategori_istatistik.php?kategori_id=".$kategoriler->get_kategori_id(),2,"Alt Kategori İstatistik","primary");

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
