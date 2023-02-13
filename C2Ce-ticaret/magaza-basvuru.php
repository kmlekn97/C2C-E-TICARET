
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

             $value=array("hata","ok","eskisifrehata","sifreleruyusmuyor","eksiksifre");
             $key=array("Hata!","Bilgi!","Hata!","Hata!","Hata!");
             $text=array("İşlem Başarısız","İşlem Başarılı","Eski Şifreniz Hatalı","Şifreler Uyuşmuyor","Şifreniz En Az 6 Karakter Olmalı!");
             $button_types=array("danger","success","danger","danger","danger");
             $formpanel->Durum_liste($value,$text,$key,$button_types);

             ?>

             <div class="settings-details tab-content">
              <div class="tab-pane fade active in" id="Personal">
                  <h2 class="title-section">Mağaza Başvurusu</h2>
                  <div class="personal-info inner-page-padding">

                     <?php 

                     if ($kullanicilarim->get_kullanici_magaza()==0) {?>

                         <p>Başvuru işleminizi tamamlamak için tüm bilgilerinizin eksiksiz ve doğru olarak girilmesine özen gösteriniz. Eksik yada hatalı bilgi olduğunda başvurunuz iptal edilecektir.<br><strong>Her satışınızdan %15 komisyon almaktayız.</strong></p>

                         <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">

                            <?php

                            $formpanel->TextBox("mail",$kullanicilarim->get_kullanici_mail(),"Kayıtlı Mail (Değiştiremezsiniz)",null,"disabled");
                            $formpanel->TextBox("kullanici_banka",$kullanicilarim->get_kullanici_banka(),"Banka Adı");
                            $formpanel->TextBox("kullanici_banka",$kullanicilarim->get_kullanici_iban(),"IBAN Numaranız");
                            $formpanel->TextBox("kullanici_ad",$kullanicilarim->get_kullanici_ad(),"Ad");
                            $formpanel->TextBox("kullanici_soyad",$kullanicilarim->get_kullanici_soyad(),"Soyad");
                            $formpanel->TextBox("kullanici_gsm",$kullanicilarim->get_kullanici_gsm(),"Telefon GSM");
                            $formpanel->Sirkettype($kullanicilarim->get_kullanici_tip(),null,"kullanici_tip","kullanici_tip","Bireysel/Kurumsal");
                            $formpanel->TextBox("kullanici_tc",$kullanicilarim->get_kullanici_tc(),"T.C.");

                            ?>

                            <div id="kurumsal">

                             <?php 

                             $formpanel->TextBox("kullanici_unvan",$kullanicilarim->get_kullanici_unvan(),"Firma Ünvan");
                             $formpanel->TextBox("kullanici_vdaire",$kullanicilarim->get_kullanici_vdaire(),"Firma V.Dairesi");
                             $formpanel->TextBox("kullanici_vno",$kullanicilarim->get_kullanici_vno(),"Firma V.No");

                             ?>

                         </div>

                         <?php

                          $formpanel->TextArea("kullanici_adres",$kullanicilarim->get_kullanici_adres(),"Açık Adres",null,null,"ckeditor");
                          $formpanel->TextBox("kullanici_il",$kullanicilarim->get_kullanici_il(),"İl");
                          $formpanel->TextBox("kullanici_ilce",$kullanicilarim->get_kullanici_ilce(),"İlçe");

                         ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Onay</label>
                            <div class="checkbox">
                                <div class="col-sm-9">
                                    <label><input type="checkbox" required="" value="">Kullanım şartlarını kabul ediyorum</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">

                            <div align="right" class="col-sm-12">
                               <button class="update-btn" name="musterimagazabasvuru" id="login-update">Başvuruyu Tamamla</button>

                           </div>
                       </form>
                   <?php } else if ($kullanicilarim->get_kullanici_magaza()==1) {?> 

                       <div class="alert alert-success">
                        <strong>Bilgi!</strong> Başvurunuz Onay Aşamasında...

                        <p>Başvurular genellikle 24 saat içerisinde incelenir ve sonuçlandırılır.</p>
                    </div> 


                <?php } else if ($kullanicilarim->get_kullanici_magaza()==2) {?> 

                   <div class="alert alert-success">
                    <strong>Bilgi!</strong> Mağazanız Onaylandı.

                    <p>Mağaza yönetim menüsünden mağazanızı yönetebilirsiniz.</p>
                </div> 


            <?php }?>

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