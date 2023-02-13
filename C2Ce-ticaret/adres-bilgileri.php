
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

                <?php $formpanel->Durum_cek();  ?>


                <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">


                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Şirket Bilgilerimi Düzenle</h2>
                            <div class="personal-info inner-page-padding"> 


                             <?php $formpanel->Sirkettype($kullanicilarim->get_kullanici_tip()); ?>


                             <div id="tc">
                                <?php $formpanel->TextBox("kullanici_tc",$kullanicilarim->get_kullanici_tc(),"T.C."); ?>
                            </div>


                            <div id="kurumsal">

                                <?php
                                $formpanel->TextBox("kullanici_unvan",$kullanicilarim->get_kullanici_unvan(),"Firma Ünvan");
                                $formpanel->TextBox("kullanici_vdaire",$kullanicilarim->get_kullanici_vdaire(),"Firma V.Dairesi");
                                $formpanel->TextBox("kullanici_vdaire",$kullanicilarim->get_kullanici_vno(),"Firma V.No");
                                $formpanel->TextArea("kullanici_adres",$kullanicilarim->get_kullanici_adres(),"Açık Adres",null,null,"ckeditor",true);
                                $formpanel->TextBox("kullanici_il",$kullanicilarim->get_kullanici_il(),"İl",true);
                                $formpanel->TextBox("kullanici_ilce",$kullanicilarim->get_kullanici_ilce(),"İlçe",true);
                                $formpanel->TextBox("magaza_adi",$kullanicilarim->get_magaza_adi(),"Mağaza Adı");
                                ?>

                            </div>
                            <script src="nedmin/production/js/CK.js"></script>

                            <?php 

                            $formpanel->Button("update-btn","musteriadresguncelle","login-update","Bilgileri Güncelle");

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

            else if (tip=="INCORPORATED_COMPANY") {

                $("#kurumsal").show();
                $("#tc").hide();

            }


        }).change();



    });

</script>



<script type="text/javascript">

    $(document).ready(function(){

        if (<?php echo $kullanicicek['kullanici_magaza']; ?>==2)
        {
         $("#sirket_turu").show();
         $("#magaza_adi").show();
     }
     else
     {
        $("#sirket_turu").hide();
        $("#magaza_adi").hide();
    }

});


</script>