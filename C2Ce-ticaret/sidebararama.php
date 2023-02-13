<?php 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

  exit("Bu sayfaya erişim yasak");

}
?>
<?php 
$urungelen=$dbservice->sidearamaurungetir($searchkeyword);
$urun=$dbservice->vericek($urungelen);

?>


<div class="fox-sidebar">
  <div class="sidebar-item" style="width: 100%">
    <div class="sidebar-item-inner">
      <h3 class="sidebar-item-title"> Kategoriler</h3>
      <ul class="sidebar-categories-list">

       <?php 

       $arraylistkategori=array();
       $kategorilist=new ArrayList($arraylistkategori);
       $kategorilist=$dbservice->kategorilisteleme();
       $kategorilist=$kategorilist->toArray();
       foreach ($kategorilist as $kategorilerim) 
       { 
        ?>


        <li><a href="kategoriler-<?=seo($kategorilerim->get_kategori_ad())."-".$kategorilerim->get_kategori_id() ?>"><?php echo $kategorilerim->get_kategori_ad() ?><span>(

          <?php 

          echo $dbservice->kategoridetayListeAdetHesapla($kategorilerim->get_kategori_id());

          ?>

        )</span></a></li>

      <?php } ?>


    </ul>
  </div>
</div>

<?php 
$searchkeyword=htmlspecialchars(trim($_POST['searchkeyword']));
$dbservice->sidearamaislem($urun,$searchkeyword);
$markaadet=$dbservice->sidemarkaadethesapla($searchkeyword);
if ($markaadet==0)
{
  $urunsor=$dbservice->sidemarkanullarama($searchkeyword);

  ?>
  <div class="sidebar-item" id="markam" style="width: 100%">
    <div class="sidebar-item-inner">
      <section  class="sky-form">
        <h4>Markalar</h4>

        <br>

        <input type="text" size="20" name="marka" id="marka" placeholder="Aradığınız markayı yazın."> 
        <br>
        <br>
        <div class="marka-row">
          <div class="row1 scroll-pane">
           <?php 
           
           $markasor=$dbservice->sidearamamarkaad($urun);

           while($markacek=$dbservice->vericek($markasor)) { 
            ?>

            <div class="col col-4">
              <div class="marka-gelen-arama">
                <label class="checkbox"><input type="checkbox" id="<?php echo $markacek['marka_id']?>" name="<?php echo $markacek['marka_id']?>" value="<?php echo $markacek['marka_id']?>"><i></i><?php echo $markacek['marka_adi']?></label>
              </div>                                               
            </div>
          <?php } ?>
        </div>
      </div>

    </section>

  </div>


</div>


<?php   
$urunsor="";  
}
else
{



 ?>



 <script>



  $(document).ready(function () {
   $('#marka').hide();
   $('.marka-gelen-arama :checkbox').prop('checked', true);

 });
</script>
<div class="sidebar-item" style="width: 100%; height:10rem;">
  <div class="sidebar-item-inner">
    <section  class="sky-form">
      <h4>Markalar</h4>

      <div class="marka-row">
        <div class="row1 scroll-pane">
         <?php 
         $markasor=$dbservice->sidebararamamarkalistesi($urun);
         while($markacek=$markasor->fetch(PDO::FETCH_ASSOC)) { 
          ?>

          <div class="col col-4">
            <div class="marka-gelen-arama">
              <label class="checkbox"><input type="checkbox" id="<?php echo "m".$markacek['marka_id']?>" name="<?php echo $markacek['marka_id']?>" value="<?php echo $markacek['marka_id']?>"><i></i><?php echo $markacek['marka_adi']?></label>
            </div>                                               
          </div>
        <?php } ?>
      </div>
    </div>

  </section>

</div>


</div>
<?php    
$urunsor="";
}
$kategoricek=$dbservice->vericek($urungelen);

$urungelen=$dbservice->sidearamaurungetir($searchkeyword);
$urun=$dbservice->vericek($urungelen);


$bedensor=$dbservice->sidebedengetir($urun['alt_kategori_id']);
$say=$bedensor->rowCount();
if ($kategoricek['kategori_id']==4 || $kategoricek['kategori_id']==15)
{


 ?>

 <div class="sidebar-item" style="width: 100%">
  <div class="sidebar-item-inner">

    <section  class="sky-form">

      <h4>Bedenler</h4>

      <br>

      <input type="text" size="18" name="beden" id="beden" placeholder="Aradığınız bedeni yazın."> 
      <br>
      <br>
      <div class="beden-row">
        <div class="row1 scroll-pane">
         <?php 
         $bedensor=$dbservice->sidebedengetir($urun['alt_kategori_id']);
         while($bedencek=$dbservice->vericek($bedensor)) { 
          ?>

          <div class="col col-4">
            <div class="beden-gelen-arama">
              <label class="checkbox"><input type="checkbox"  id="<?php echo "b".$bedencek['beden_id'];?>" name="<?php echo $bedencek['beden_id']?>"value="<?php echo $bedencek['beden_id']?>"><i></i><?php echo $bedencek['beden_icerik']?></label>     
            </div>                                                                                        
          </div>
        <?php } ?>
      </div>
    </div>


  </section>


</div>


</div>

<?php } ?>




<div class="sidebar-item" style="width: 100%">
  <div class="sidebar-item-inner">
   <section class="sky-form">
    <h4>Fiyat</h4>
    <br>
    <input type="text" size="3" id="searchfiyat-1" name="searchfiyat-1" required="required" placeholder="En Az"> -
    <input type="text" size="3" id="searchfiyat-2" name="searchfiyat-2" required="required" placeholder="En Çok">
    <button style="margin-left: 1rem;" class="btn btn-success btn" name="ara" id="searcharama"><i class="fa fa-search" ></i></button>
    <div style="margin-top: 1rem;" class="row1 scroll-pane">
      <div class="col col-4">
        <div class="fiyat-gelen-arama">
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

<div class="sidebar-item" style="width: 100%">
 <div class="sidebar-item-inner">
  <section class="sky-form">
    <h4>Renk</h4>
    <ul class="w_nav2">
     <?php 
     $renksor=$dbservice->siderenkgetir();
     while($renkcek=$dbservice->vericek($renksor)) {
      ?>
      <div class="renk">
       <div class="<?php echo $renkcek['renk_id']; ?>" value="<?php echo $renkcek['renk_id']; ?>"id="<?php echo "r".$renkcek['renk_id']; ?>" style="background: <?php echo $renkcek['renk_kodu'] ?>; float: left; width: 2rem; border-radius: 60%;margin-left: 8px;">  <label style="visibility: hidden;">fsf</label></div>
     </div>

   <?php } ?>
 </ul>
</section>
</div>
</div>


</div>
<script>



  $(document).ready(function () {
   $('#marka').keyup(function () {
    if ($('#marka').val().length < 0) {
      var tg = $('.marka-gelen-arama');
      tg.show();

      return;
    }

    $('.marka-gelen-arama').hide();


    var adet=0;  

    var txt = $('#marka').val();
    txt=txt.trim();
    $('.marka-gelen-arama').each(function () {
      if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
        $(this).show();
        adet++;
      }

    });
    var uzunluk = txt.length;
    if (adet<=0 && uzunluk > 0)
    {
     $('.marka-row').hide();
     adet=0;
   }
   else
   {
     $('.marka-row').show();
   }
   var t = $('.checkbox:visible');

 });
 });



</script>


<script type="text/javascript">
  $(document).ready(function () {
   $('#beden').keyup(function () {
    if ($('#beden').val().length < 0) {
      var tg = $('.beden-gelen');
      tg.show();

      return;
    }

    $('.beden-gelen').hide();


    var adet=0;  

    var txt = $('#beden').val();
    txt=txt.trim();
    $('.beden-gelen').each(function () {
      if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
        $(this).show();
        adet++;
      }
    });
    var uzunluk = txt.length;
    if (adet<=0 && uzunluk > 0)
    {
     $('.beden-row').hide();
     adet=0;
   }
   else
   {
     $('.beden-row').show();
   }
   var t = $('.checkbox:visible');

 });
 });



</script>