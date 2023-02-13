<?php 

include 'header.php'; 

$kampanyalar=$admindbservices->Kampanya($_GET['kampanya_id']);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kampanya Düzenleme <small>,

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kampanya Resim <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <img width="200" src="../../<?php echo $kampanyalar->get_kampanya_logo(); ?>">
             </div>
           </div>

           <?php 
           $form->FileChooser("kampanya_logo",null,"Kampanya Resim");
           $form->TextBox("kampanya_adi",$kampanyalar->get_kampanya_adi(),"Kampanya Adı"); 
           $form->TextArea("kampanya_aciklama",($kampanyalar->get_kampanya_aciklama()),"Kampanya Detay",null,null,"ckeditor");
           $form->TextBox("kampanya_oran",$kampanyalar->get_kampanya_oran(),"İndirim Oranı"); 
           $form->DateTime("kampanyabaslangic_tarihi",str_replace(' ','T',$kampanyalar->get_kampanyabaslangic_tarihi()),"Başlangıç Tarihi");
            $form->DateTime("kampanyabitis_tarihi",str_replace(' ','T',$kampanyalar->get_kampanyabitis_tarihi()),"Bitiş Tarihi");

           ?>


           <script src="js/CK.js"></script>


              <?php $islem->Kategori_listele($kampanyalar->get_kategori_id(),"Kategori"); ?>


          <input type="hidden" name="kampanya_id" value="<?php echo $kampanyalar->get_kampanya_id(); ?>"> 
          <input type="hidden" value="<?php echo $kampanyalar->get_kampanya_logo(); ?>" name="eski_yol">


          <div class="ln_solid"></div>

          <?php $form->Button("kampanyaduzenle","Güncelle"); ?>

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