<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/production/fonksiyon.php';
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

  exit("Bu sayfaya erişim yasak");

}
?>
<div class="fox-sidebar">
  <div class="sidebar-item" style="width: 115%">
    <div class="sidebar-item-inner">
      <h3 class="sidebar-item-title"> İlgili Kategoriler</h3>
      <ul class="sidebar-categories-list">

       <?php 

       $uruncek=$dbservice->sidealtkategoridetayurungetir();

       $arraylistaltkategoridetay=array();
       $altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
       $altkategoridetaylist=$dbservice->sidealtdetaylariListele();
       $altkategoridetaylist=$altkategoridetaylist->toArray();
       foreach ($altkategoridetaylist as $altkategoridetaylarim) 
       {

        ?>


        <li><a href="altkategoridetay-<?=seo($altkategoridetaylarim->get_alt_kategori_detay_ad())."-".$altkategoridetaylarim->get_alt_kategori_detay_id() ?>"><?php echo $altkategoridetaylarim->get_alt_kategori_detay_ad() ?><span>(
          
          <?php 

          echo $dbservice->altKategoridetayListeAdetHesapla($altkategoridetaylarim->get_alt_kategori_detay_id());

          ?>

        )</span></a></li>

      <?php } ?>


    </ul>
  </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="sidebar-item" style="width: 115%">
  <div class="sidebar-item-inner">
    <section  class="sky-form">
      <h4>Markalar</h4>

      <br>

      <input type="text" size="25" name="marka" id="marka" placeholder="Aradığınız markayı yazın."> 
      <br>
      <br>
      <div class="marka-row">
        <div class="row1 scroll-pane">
         <?php 
         $markasor=$dbservice->sidebaraltdetaymarkalistele($uruncek);

         if ($dbservice->sidebaraltmarkadurum($uruncek['kategori_id']))
         {
           while($markaaltcek=$dbservice->vericek($markasor)) { 
            ?>

            <div class="col col-4">
              <div class="marka-gelen">
                <label class="checkbox"><input type="checkbox" id="<?php echo "m".$markaaltcek['marka_id']?>" name="<?php echo $markaaltcek['marka_id']?>" value="<?php echo $markaaltcek['marka_id']?>"><i></i><?php echo $markaaltcek['marka_adi']?></label>
              </div>                                               
            </div>
          <?php }
        }
        else
        {
          while($markacek=$dbservice->vericek($markasor)) { 
            ?>

            <div class="col col-4">
              <div class="marka-gelen">
                <label class="checkbox"><input type="checkbox" id="<?php echo $markacek['marka_id']?>" name="<?php echo $markacek['marka_id']?>" value="<?php echo $markacek['marka_id']?>"><i></i><?php echo $markacek['marka_adi']?></label>
              </div>                                               
            </div>
          <?php }  }?>
        </div>
      </div>

    </section>

  </div>


</div>

<?php 
$bedensor=$dbservice->sidebedengetir($uruncek['alt_kategori_id']);
$say=$bedensor->rowCount();
if ($say>0)
{
 ?>

 <div class="sidebar-item" style="width: 115%">
  <div class="sidebar-item-inner">

    <section  class="sky-form">

      <h4>Bedenler</h4>

      <br>

      <input type="text" size="25" name="beden" id="beden" placeholder="Aradığınız bedeni yazın."> 
      <br>
      <br>
      <div class="beden-row">
        <div class="row1 scroll-pane">
         <?php 
         $bedensor=$dbservice->sidebedengetir($uruncek['alt_kategori_id']);
         while($bedencek=$dbservice->vericek($bedensor)) { 
          ?>

          <div class="col col-4">
            <div class="beden-gelen">
              <label class="checkbox"><input type="checkbox"  id="<?php echo "b".$bedencek['beden_id'];?>" name="<?php echo $bedencek['beden_
              id']?>"value="<?php echo $bedencek['beden_id']?>"><i></i><?php echo $bedencek['beden_icerik']?></label>     
            </div>                                                                                        
          </div>
        <?php } ?>
      </div>
    </div>


  </section>


</div>


</div>

<?php } ?>

<div class="sidebar-item" style="width: 115%">
  <div class="sidebar-item-inner">
   <section class="sky-form">
    <h4>Fiyat</h4>
    <br>
    <input type="text" size="5" id="fiyat-1" name="fiyat-1" placeholder="En Az"> -
    <input type="text" size="5" id="fiyat-2" name="fiyat-2" placeholder="En Çok">
    <button style="margin-left: 1rem;" class="btn btn-success btn" name="ara" id="arama"><i class="fa fa-search" ></i></button>
    <div style="margin-top: 1rem;" class="row1 scroll-pane">
      <div class="col col-4">
        <div class="fiyat-gelen">
          <label class="radio"><input type="radio" name="radio" for="radio-0" value="0-70"><i></i>0 TL - 70 TL</label>
          <label class="radio"><input type="radio" name="radio" for="radio-1" value="70-150"> <i></i>70 TL - 150 TL</label>
          <label class="radio"><input type="radio" name="radio" for="radio-2" value="150-200"><i></i>150 TL - 200 TL</label>
          <label class="radio"><input type="radio" name="radio" for="radio-3" value="200-300"><i></i>200 TL - 300 TL</label>
          <label class="radio"><input type="radio" name="radio" for="radio-4" value="300-600"><i></i>300 TL - 600 TL</label>
          <label class="radio"><input type="radio" name="radio" for="radio-5" value="600-17500"><i></i>600 TL - 17500 TL</label>
        </div>
      </div>
    </div>                      
  </section>
</div>
</div>


<div class="sidebar-item" style="width: 115%">
 <div class="sidebar-item-inner">
  <section class="sky-form">
    <h4>Renk</h4>
    <ul class="w_nav2">
     <?php 
     $renksor=$dbservice->siderenkgetir();
     while($renkcek=$dbservice->vericek($renksor)) {
      ?>
      <div class="renk-gelen">
       <div class="<?php echo $renkcek['renk_id']; ?>" value="<?php echo $renkcek['renk_id']; ?>"id="<?php echo "r".$renkcek['renk_id']; ?>" style="background: <?php echo $renkcek['renk_kodu'] ?>; float: left; width: 2rem; border-radius: 60%;margin-left: 8px;">  <label style="visibility: hidden;">fsf</label></div>
     </div>

   <?php } ?>
 </ul>
</section>
</div>
</div>

<?php 
$ozellikarraylist=array();
$ozellikliste=new ArrayList($ozellikarraylist);
$ozellikliste=$dbservice->Urunozelliklistele();
$ozellikliste=$ozellikliste->toArray();

foreach ($ozellikliste as $urunozelliklerim) 
{
  ?>
  <?php if ($urunozelliklerim->get_ozellik_durum()=="1") {?> 
    <div class="sidebar-item" style="width: 115%;height: 80%;"> 
      <div class="sidebar-item-inner">

        <section  class="sky-form">
         <div style="min-height: 15rem">
          <h4><?php echo $urunozelliklerim->get_ozellik_adi(); ?></h4>


          <div class="row1 scroll-pane">
           <?php 
           $ozellikdetayarraylist=array();
           $ozellikdetaylist=new ArrayList($ozellikdetayarraylist);
           $ozellikdetaylist=$dbservice->Urunozellikdetaylistele($urunozelliklerim->get_urun_ozellikleri_id());
           $ozellikdetaylist=$ozellikdetaylist->toArray();

           foreach ($ozellikdetaylist as $urunozellikdetaylarim) 
           {  
            ?>

            <div class="col col-4">
              <div class="ozellikler">

                <div class="o<?php echo $urunozelliklerim->get_urun_ozellikleri_id(); ?>">


                  <label class="checkbox"><input type="checkbox" name="checkbox" value="<?php echo $urunozellikdetaylarim->get_ozellik_detay_id(); ?>"id="o<?php echo $urunozellikdetaylarim->get_ozellik_detay_id(); ?>"><i></i><?php echo $urunozellikdetaylarim->get_ozellik_detay(); ?></label>     
                </div>  

              </div>                                                                                        
            </div>


          <?php } ?>
        </div>
      </div>
    </section>



  </div>


</div>
<?php }?> 
<?php } ?>


</div>

<script src="js/jquery-side.js"></script>