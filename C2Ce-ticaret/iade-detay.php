
<?php 

require_once 'header.php'; 

islemanakontrol();

$siparissor=$dbservice->IadeListeleme();
$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
$urunlerim=$cons->Urun_ekle($sipariscek);
$kullanicilarim=$cons->Kullanici_ekle($sipariscek);
$siparislerim=$cons->Siparis_ekle($sipariscek);
$siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
$iadelerim=$cons->Iade_ekle($sipariscek);

$arraylistmarka=array();
$markalist=new ArrayList($arraylistmarka);
$markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
$markalist=$markalist->toArray();
foreach ($markalist as $markalarim)
{
  $marka=$markalarim->get_marka_adi();
}

$arraylistrenk=array();
$renklist=new ArrayList($arraylistrenk);
$renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
$renkliste=$renkliste->toArray();
foreach ($renkliste as $renklerim) 
{
  $renk=$renklerim->get_renk_adi();
}

$arraylistbeden=array();
$bedenlist=new ArrayList($arraylistbeden);
$bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
$bedenlist=$bedenlist->toArray();
foreach ($bedenlist as $bedenlerim) 
{
  $beden=$bedenlerim->get_beden_icerik();
}

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


        <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

          <div class="settings-details tab-content">
            <div class="tab-pane fade active in" id="Personal">
              <h2 class="title-section">İADE</h2>
              <div class="personal-info inner-page-padding"> 


               <center> <b> <?php  echo " ".$urunlerim->get_urun_ad()." ".$marka." ".$renk." ".$beden." ".$urunlerim->get_barkod_no(); ?></b></center>
               <br>
               <br>


               <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                 <img width="200" src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>">
               </div>
             </div>
             <div class="form-group">
              <label class="col-sm-3 control-label">İADE TÜRÜ:</label>
              <div class="col-sm-9">
               <?php echo $iadelerim->get_iade_turu(); ?>
             </div>
           </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">İADE AÇIKLAMASI:</label>
            <div class="col-sm-9">
              <?php echo html_entity_decode($iadelerim->get_iade_aciklama()); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>


</div> 

</div>
</div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>

<script type="text/javascript">

  $(document).ready(function(){


    $("#kullanici_tip").change(function(){


      var tip=$("#kullanici_tip").val();

      if (tip=="PERSONAL") {


        $("#kurumsal").hide();
        $("#tc").show();



      } else if (tip=="PRIVATE_COMPANY") {

        $("#kurumsal").show();
        $("#tc").hide();

      }


    }).change();



  });

</script>