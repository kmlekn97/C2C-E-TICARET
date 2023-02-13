<?php 

include 'header.php'; 

$ozellikcek=$admindbservices->OzellikGetir("ozellik_detay_id",$_GET['alt_kategori_detay_id']);
$urunozellikcek=$admindbservices->urunOzellikGetir("urun_ozellikleri_id",$_GET['urun_ozellikleri_id']);

$ozellik=$cons->Alt_kategori_ozellik_detay_ekle($ozellikcek,$urunozellikcek);

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Özellik Listeleme <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                <?php $form->TextBox("ozellik_detay",null,"Özellik Detay Ad",null,"Özellik adını giriniz") ?>

                <input type="hidden" name="ozellik_detay_id" value="<?php echo $ozellik->get_ozellik_detay_id(); ?>">

                <input type="hidden" name="urun_ozellikleri_id" value="<?php echo $ozellik->get_urun_ozellikleri_id(); ?>"> 

                <div class="ln_solid"></div>

                <?php $form->Button("ozellikdetayekle","Kaydet"); ?>

              </form>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php
              $tbl=new CreateTable(4);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Özellik Detay Ad",1);
              $tbl->addcolumn("",2);
              $tbl->addcolumn("",3);
              $tbl->TableBaslik();
              ?>

              <tbody>

                <?php 

                $say=0;
                $ozellikdetaysor=$admindbservices->ozellikDetayListele($_GET['urun_ozellikleri_id']);
                while($ozellikdetaycek=$admindbservices->vericek($ozellikdetaysor)) { 
                  $ozellik=$cons->Alt_kategori_ozellik_detay_ekle($ozellikdetaycek,$ozellikdetaycek);
                  $say++;?>

                  <tr>

                    <?php 
                    $tbl->addRow($say,0,"20");
                    $tbl->addRow($ozellik->get_ozellik_detay(),1);
                    $tbl->AddButton("altkategoridetayozellik-duzenle.php?ozellik_detay_id=".$ozellik->get_ozellik_detay_id(),2,"Düzenle","primary");
                    $tbl->AddButton("../netting/islem.php?ozellik_detay_id=".$ozellik->get_ozellik_detay_id()."&urun_ozellikleri_id=".$ozellik->get_urun_ozellikleri_id()."&ozellikdetaysil=ok",4,"Sil","danger");
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
