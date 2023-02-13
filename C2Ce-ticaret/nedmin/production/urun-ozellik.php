<?php 

include 'header.php'; 

$Urunlerim;
$arraylisturun=array();
$urunlist=new ArrayList($arraylisturun);
$urunlist=$admindbservices->UrunListele($_GET['urun_id']);
$urunlist=$urunlist->toArray();
foreach ($urunlist as $Urun) 
{
  $Urunlerim=$Urun;
}
$ozellikdetaysor=$admindbservices->ozellikDetayGetir($_GET['urun_id']);

?> 

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Özellik <small>

              <?php $form->Durum_cek(); ?>


            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" class="form-horizontal" id="personal-info-form">


              <?php
              $urun_ozelliksor=$admindbservices->urunozellikAllListeleme();
              while($urun_ozellikcek=$admindbservices->vericek($urun_ozelliksor)) {
               $value=array();
               $options=array();
               $urun_ozellik=$cons->Urun_Ozellik_ekle($urun_ozellikcek);
               $ozellik_detaysor=$admindbservices->ozellikDetayAllListeleme($urun_ozellikcek);
               while($ozellik_detaycek=$ozellik_detaysor->fetch(PDO::FETCH_ASSOC)) {
                $ozellik_detaylari=$cons->Ozellik_Detay_ekle($ozellik_detaycek);  
                array_push($value,$urun_ozellik->get_urun_ozellikleri_id());
                array_push($options,$ozellik_detaylari->get_ozellik_detay());

              }
              $form->ComboBoxValue($options,$urun_ozellik->get_urun_ozellikleri_id(),$value,null,$urun_ozellik->get_ozellik_adi());
            } 



            ?>  

            <input type="hidden" name="alt_kategori_detay_id" value="<?php echo htmlspecialchars($_GET['alt_kategori_detay_id']) ?>">

            <input type="hidden" name="urun_id" value="<?php echo $Urunlerim->get_urun_id(); ?>"> 




            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="urunozellikekle" class="btn btn-success">Kaydet</button>

              </div>
            </div>

          </form>



        </div>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
         <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Ürün Özellik</th>
            <th scope="col">Ürün Özellik adı</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

         <?php 

         $say=0;



         while($ozellidetaycek=$ozellikdetaysor->fetch(PDO::FETCH_ASSOC)) { 

          $ozellik_detay_icerik=$cons->Ozellik_Detay_Icerik_ekle($ozellidetaycek);

          $say++;?>

          <tr>
           <td width="20"><?php echo $say ?></td>

           <?php                 
           $arraylistozellik=array();
           $ozelliklist=new ArrayList($arraylistozellik);
           $ozelliklist=$admindbservices->urunozelliklerilisteyap($ozellik_detay_icerik->get_ozellik_detay_id());
           $ozelliklist=$ozelliklist->toArray();       
           for($i=0;$i<count($ozelliklist);$i++)
           {
            $ad=$ozelliklist[0];
            $detay=$ozelliklist[1];
            $urun_ozellikleri_id=$ozelliklist[2];
          }
          ?>

          <td><?php echo $ad;?></td>
          <td><?php echo $detay; ?></td>


          <td><center><a href="urun-ozellik-duzenle.php?alt_kategori_detay_id=<?php echo $Urunlerim->get_alt_kategori_detay_id(); ?>&urun_id=<?php echo $Urunlerim->get_urun_id(); ?>&ozellik_detay_icerik_id=<?php echo $ozellik_detay_icerik->get_ozellik_detay_icerik_id(); ?>&urun_ozellikleri_id=<?php echo $urun_ozellikleri_id; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
        </tr>



      <?php  }

      ?>

    </tbody>
  </table>
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
