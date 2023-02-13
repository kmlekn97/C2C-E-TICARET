
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

       $value=array("hata","ok");
       $key=array("Hata!","Bilgi!");
       $text=array("İşlem Başarısız","Beden Eklenmiştir...");
       $formpanel->Durum_cek($value,$text,$key);

       ?>
       <script src="js/jquery-footer.js"></script>


       <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Beden Ekleme</h2>
            <div class="personal-info inner-page-padding"> 


              <div class="form-group">
                <label class="col-sm-3 control-label">Kategori</label>
                <div class="col-sm-9">
                  <div class="custom-select">
                    <select name="kategori_id" id="select1" class='select2'>
                      <option>Bir Kategori Seçiniz...</option>
                      <?php 
                      $arraylist=array();
                      $kategorilist=new ArrayList($arraylist);
                      $kategorilist=$dbservice->kategorilisteleme();
                      $kategorilist=$kategorilist->toArray();

                      foreach ($kategorilist as $kategorilerim) 
                      {
                        if ($kategorilerim->get_kategori_id()==4 || $kategorilerim->get_kategori_id()==15) { ?> 
                          <option value="<?php echo $kategorilerim->get_kategori_id() ?>"><?php echo $kategorilerim->get_kategori_ad() ?></option>
                          <?php 
                        } 
                      } 
                      ?>

                    </select>
                  </div>
                </div>
              </div>

              <?php 

              $formpanel->Alt_Kategori_listele("alt_kategori_id","Alt Kategori");
              $formpanel->Alt_Kategori_Detay_Listele("alt_kategori_detay_id","Alt Kategori İçerik");
              $formpanel->TextBox("beden_icerik",null,"Adı",true,null,"Beden Adı...");

              ?>


              <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> 




              <?php 

              $formpanel->Button("update-btn","magazabedenekle","login-update","Beden Ekle","Bu Beden Eklemek istiyormusunuz? İşlem geri alınamaz...");

              ?>       


            </div> 
          </div> 



        </div> 

      </form> 
    </div>  
  </div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer_sorgulu.php'; ?>
