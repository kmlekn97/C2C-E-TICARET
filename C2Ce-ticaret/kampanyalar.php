
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






        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">kampanyabaslangic_tarihi</h2>
            <div class="personal-info inner-page-padding"> 

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th width="20%" scope="col">Logo</th>
                    <th scope="col">Kampanya Adı  </th>
                    <th scope="col">Başlama Tarihi</th>
                    <th scope="col">Bitiş Tarihi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php 

                  $arraylistkampanya=array();
                  $kampanyalist=new ArrayList($arraylistkampanya);
                  $kampanyalist=$dbservice->tumKampanyalariListele();
                  $kampanyalist=$kampanyalist->toArray();
                  foreach ($kampanyalist as $kampanyalarim) 
                  {
                    $say++
                    ?>


                    <tr>
                      <th scope="row"><?php echo $say ?></th>
                      <td> <img src="<?php echo $kampanyalarim->get_kampanya_logo();?>" width="50%" alt="<?php echo $kampanyalarim->get_kampanya_adi();?>" class="img-responsive"/></td>
                      <td><?php echo $kampanyalarim->get_kampanya_adi() ?></td>
                      <td><?php echo $kampanyalarim->get_kampanyabaslangic_tarihi() ?></td>
                      <td><?php echo $kampanyalarim->get_kampanyabitis_tarihi() ?></td>
                      <td>  <?php 
                      $arraylistkategori=array();
                      $kategorilist=new ArrayList($arraylistkategori);
                      $kategorilist=$dbservice->kampanyaKategoriListele($kampanyalarim->get_kategori_id());
                      $kategorilist=$kategorilist->toArray();
                      foreach ($kategorilist as $kategorilerim) 
                      {
                        $kategori=$kategorilerim->get_kategori_ad();
                      }

                      if ($kampanyalarim->get_kategori_id()==0)
                        $kategori="Genel";

                      echo $kategori; ?>


                    </td>

                    <?php 
                    echo "<td>";
                    $formpanel->Button_Href("Katıl","kampanya_onay?kampanya_id=".$kampanyalarim->get_kategori_id(),"danger");
                    echo "</td>";

                    ?>

                  </td>
                </tr>

              <?php } ?>


            </tbody>
          </table>


        </div> 
      </div> 



    </div> 


  </div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>