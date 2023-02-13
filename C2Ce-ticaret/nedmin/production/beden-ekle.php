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
            <h2>Beden Ekleme <small>,

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />



          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <?php

            $form->TextBox("beden_icerik",null,"Beden Ad",0,"Beden adını giriniz"); 
            $islem->Kategori_listele(null,"Kategori Seç");
            $islem->Alt_Kategori_listele(null,null,"Alt Kategori Seç");
            $islem->Alt_Kategori__detay_listele(null,null,"Alt Kategori Detay Seç"); 

            ?>


        <div class="ln_solid"></div>

        <?php $form->Button("bedenekle","Kaydet"); ?>

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