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
            <h2>Ürün Düzenleme <small>,

              <?php $form->Durum_cek(); ?>


            </small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">


              <?php

              $form->TextBox("yetki_adi",null,"Bağlantı",null,"Yetki Tanımlayınız...");

              ?>


              <input type="hidden" name="kullanici_id" value="<?php echo htmlspecialchars($_GET['kullanici_id']) ?>"> 




              <div class="ln_solid"></div>

              <?php $form->Button("siteyetkile","Kaydet"); ?>

            </form>

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(4);
              $tbl->addcolumn("Yetki Tarih",0);
              $tbl->addcolumn("Bağlantı",1);
              $tbl->addcolumn("Düzenle",2);
              $tbl->addcolumn("",3);
              $tbl->TableBaslik();

              ?> 

              <tbody>

                <?php 

                $arraylistyetki=array();
                $yetkilist=new ArrayList($arraylistyetki);
                $yetkilist=$admindbservices->yetkiListele($_GET['kullanici_id']);
                $yetkilist=$yetkilist->toArray();
                foreach ($yetkilist as $yetkiler) 
                {

                  ?>
                  <tr>

                    <?php

                    $tbl->addRow($yetkiler->get_yetki_tarih(),0);
                    $tbl->addRow($yetkiler->get_yetki_adi(),1);
                    $tbl->AddButton("yetki-duzenle.php?yetki_id=".$yetkiler->get_yetki_id(),2,"Düzenle","primary");
                    $tbl->AddButton("../netting/islem.php?yetki_id=".$yetkiler->get_yetki_id()."&kullanici_id=".$yetkiler->get_kullanici_id()."&yetkisil=ok",3,"Sil","danger");

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


<script type="text/javascript">

 $('#kullanici_tc').change(function(){

  $('#kullanici_passwordone').val( $('#kullanici_tc').val());
  $('#kullanici_passwordtwo').val( $('#kullanici_tc').val());

});
 
</script>
