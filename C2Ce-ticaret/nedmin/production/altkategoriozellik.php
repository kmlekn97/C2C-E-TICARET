<?php 

include 'header.php'; 

$urunozellikcek=$admindbservices->urunOzellikGetir("urun_ozellikleri_id",$_GET['urun_ozellikleri_id']);

$urunozellik=$cons->Alt_kategori_ozellik_ekle($urunozellikcek);

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

                <?php $form->TextBox("ozellik_adi",null,"Özellik Ad",null,"Özellik adını giriniz"); ?>

                <?php $form->ComboBoxDurum("ozellik_durum",null,"Özellik Durum"); ?> 

                <input type="hidden" name="alt_kategori_detay_id" value="<?php echo htmlspecialchars($_GET['alt_kategori_detay_id']) ?>">

                <input type="hidden" name="urun_ozellikleri_id" value="<?php echo $urunozellik->get_urun_ozellikleri_id(); ?>"> 

                <div class="ln_solid"></div>
                <?php $form->Button("ozellikekle","Kaydet"); ?>

              </form>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(4);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Özellik Ad",1);
              $tbl->addcolumn("Özellik Durum",2);
              $tbl->addcolumn("",3);
              $tbl->TableBaslik();

              ?>

              <tbody>

                <?php 

                $say=0;


                $arraylisturunozellik=array();
                $urunozelliklist=new ArrayList($arraylisturunozellik);
                $urunozelliklist=$admindbservices->UrunOzellikDetayListele($_GET['alt_kategori_detay_id']);
                $urunozelliklist=$urunozelliklist->toArray();
                foreach ($urunozelliklist as $urunozellik) 
                {


                  $say++;?>

                  <tr>

                    <?php 
                    $tbl->addRow($say,0,"20");
                    $tbl->addRow($urunozellik->get_ozellik_adi(),1);
                    $tbl->AddDurum($urunozellik->get_ozellik_durum(),2);
                    $tbl->AddButton("altkategoridetayozellik.php?urun_ozellikleri_id=".$urunozellik->get_urun_ozellikleri_id(),3,"Alt Kategori Detay Özellik Ekle","primary");
                    $tbl->AddButton("altkategoriozellik-duzenle.php?urun_ozellikleri_id=".$urunozellik->get_urun_ozellikleri_id(),4,"Düzenle","primary");
                    $tbl->AddButton("../netting/islem.php?urun_ozellikleri_id=".$urunozellik->get_urun_ozellikleri_id()."&alt_kategori_detay_id=".$urunozellik->get_alt_kategori_detay_id()."&ozelliksil=ok",5,"Sil","danger");
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
