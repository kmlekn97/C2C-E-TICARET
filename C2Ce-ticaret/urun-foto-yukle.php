
<?php 

require_once 'header.php'; 

islemanakontrol();

?>

<!-- Header Area End Here -->

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">



    <div class="row settings-wrapper">


      <?php require_once 'hesap-sidebar.php' ?>


      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

        <?php 
        $foto=new Foto_Yükle("urun-galeri.php?urun_id=".htmlspecialchars($_GET['urun_id']),"nedmin/netting/urungaleri.php","urun_id",htmlspecialchars($_GET['urun_id'])); 
        ?>

      </div>
    </div> 
  </div> 

</div> 
</div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>

