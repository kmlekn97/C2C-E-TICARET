<?php 

include 'header.php';

$kategorialtcek=$admindbservices->altkategoricek($_GET['alt_kategori_id']);
$altkategori=$cons->Alt_kategori_ekle($kategorialtcek);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Alt Kategori Detay <small>

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

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php $form->TextBox("alt_kategori_detay_ad",null,"Alt Kategori Detay Ad"); ?>

              <?php $form->TextBox("alt_kategori_detay_sira",null,"Alt Kategori Detay Sıra"); ?>

              <?php $form->ComboBoxDurum("alt_kategori_detay_durum",null,"Kategori Durum"); ?>


              <input type="hidden" name="alt_kategori_id" value="<?php echo $altkategori->get_alt_kategori_id(); ?>">

              <input type="hidden" name="alt_kategori_detay_id" value="<?php echo htmlspecialchars($_GET['alt_kategori_detay_id']) ?>"> 


              <div class="ln_solid"></div>

              <?php $form->Button("altkategoridetayekle","Ekle"); ?>

            </form>


            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(7);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Alt Kategori Detay",1);
              $tbl->addcolumn("Alt Kategori Detay Sıra",2);
              $tbl->addcolumn("Alt Kategori Detay Sıra",3);
              $tbl->addcolumn("",4);
              $tbl->addcolumn("",5);
              $tbl->addcolumn("",6);
              $tbl->TableBaslik();
              ?>

              <tbody id="sortable">

                <?php 

                $say=0;
                $arraylistaltkategoridetay=array();
                $altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
                $altkategoridetaylist=$admindbservices->altkategoridetayListele($_GET['alt_kategori_id'],$kategorialtcek);
                $altkategoridetaylist=$altkategoridetaylist->toArray();
                foreach ($altkategoridetaylist as $alt_kategori_detay) 
                {


                  $say++;?>

                  <tr id="item-<?php echo $alt_kategori_detay->get_alt_kategori_detay_id(); ?>">
                    <?php
                    $tbl->addRow($say,0,"20");
                    $tbl->addRow($alt_kategori_detay->get_alt_kategori_detay_ad(),1,"sortable");
                    $tbl->addRow($alt_kategori_detay->get_alt_kategori_detay_sira(),2);
                    $tbl->AddDurum($alt_kategori_detay->get_alt_kategori_detay_durum(),3);
                    $tbl->AddButton("altkategoriozellik.php?alt_kategori_detay_id=".$alt_kategori_detay->get_alt_kategori_detay_id(),4,"Alt Kategori Özellik Ekle","primary");
                    $tbl->AddButton("altkategoridetay-duzenle.php?alt_kategori_detay_id=".$alt_kategori_detay->get_alt_kategori_detay_id(),5,"Düzenle","primary");
                    $tbl->AddButton("../netting/islem.php?alt_kategori_detay_id=".$alt_kategori_detay->get_alt_kategori_detay_id()."&alt_kategori_id=".$alt_kategori_detay->get_alt_kategori_id()."&altkategoridetaysil=ok",6,"Sil","danger");
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

  $(function() {
    $("#sortable").sortable({
      revert:true,
      handle:".sortable",
      stop:function(event,ui) {
        var data=$(this).sortable('serialize');
        console.log(data);
        $.ajax({
          type:"POST",
          dataType:"json",
          data:data,
          url:"../netting/order-ajax.php?altkategoridetay_sirala=true",
          success:function(msg) {
           alert("Sıralama Başarılı...");
         }
       });
      }



    });
    $("#sortable").disableSelection();
  });

</script>

