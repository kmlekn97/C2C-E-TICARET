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
            <h2 class="title-section">Tamamlanan Siparişlerim</h2>
            <div class="personal-info inner-page-padding"> 

             <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
             <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>

             <br>
             <br>

             <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sipariş Tarihi</th>
                  <th scope="col">Sipariş Numarası</th>
                  <th scope="col">Sipariş Tutar</th>
                  <th scope="col">Detay</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                <?php 
                $siparissor=$dbservice->tamamlanansiparisgetir();
                
                $say=0;

                while($sipariscek=$dbservice->vericek($siparissor)) { 
                  $siparislerim=$cons->Siparis_ekle($sipariscek);
                  $siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
                  $kullanicilarim=$cons->Kullanici_ekle($sipariscek);
                  $urunlerim=$cons->Urun_ekle($sipariscek);
                  $say++;
                  $total=$dbservice->tamamlanansiparistotalHesapla($sipariscek['k_id'],$siparislerim->get_siparis_zaman());
                  ?>


                  <tr>
                    <th scope="row"><?php echo $say ?></th>
                    <td><?php echo $siparislerim->get_siparis_zaman() ?></td>
                    <td><?php echo $siparislerim->get_siparis_id() ?></td>
                    <td><?php echo number_format($total, 2, ',', '.'); ?></td>
                    <?php

                    echo "<td>";
                    $formpanel->Button_Href("Detay","tamamlanan-siparisler-detay?kullanici_id=".$sipariscek['k_id']."&siparis_zaman=".$siparislerim->get_siparis_zaman()."&siparis_id=".$siparislerim->get_siparis_id(),"primary");
                    echo "</td>";

                    echo "<td>";
                    $formpanel->Button_Href("Fatura","fatura/satici-fatura.php?siparis_zaman=".$siparislerim->get_siparis_zaman()."&kullanici_id=".$sipariscek['k_id']."&siparis_id=".$siparislerim->get_siparis_id(),"success");
                    echo "</td>";

                    ?>

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
?>