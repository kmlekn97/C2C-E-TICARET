<?php 

include 'header.php'; 

$bedenlerim=$admindbservices->bedenListele($_GET['beden_id']);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Beden Düzenleme <small>

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
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

             <?php 
             $form->TextBox("beden_icerik",$bedenlerim->get_beden_icerik(),"Beden"); 
             $islem->Kategori_listele($bedenlerim->get_kategori_id(),"Kategori Seç");
             $islem->Alt_Kategori_listele($bedenlerim->get_alt_kategori_id(),$bedenlerim->get_kategori_id(),"Alt Kategori Seç");
             $islem->Alt_Kategori__detay_listele($bedenlerim->get_alt_kategori_detay_id(),$bedenlerim->get_alt_kategori_id(),"Alt Kategori Detay Seç");

             ?>


             <input type="hidden" name="beden_id" value="<?php echo htmlspecialchars($_GET['beden_id']) ?>"> 


             <div class="ln_solid"></div>
             <?php $form->Button("bedenduzenle","Güncelle"); ?>
           </form>



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
  $(document).ready(function(){

    $('#selectbeden').change(function(){
      $('#selectalt').empty();
      var deger2=$(this).val();
      $.post("post2.php",{altkategori:deger2},function(a){
        $('#selectalt').append(a);
      })
    });


  });

</script>
