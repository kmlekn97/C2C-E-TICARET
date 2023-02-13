<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi

$siparissor=$admindbservices->iadeSiparisGetir($_GET['siparis_id']);
$kdvtoplam=0;
$aratoplam=0;
$toplam=0;
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Siparis Detay Listeleme <small>,

              <?php $form->Durum_cek(); ?>


            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php
              $tbl=new CreateTable(10);
              $tbl->addcolumn("Sipariş Tarihi",0);
              $tbl->addcolumn("Siparis No",1);
              $tbl->addcolumn("Barkod No",2);
              $tbl->addcolumn("Ürün Ad",3);
              $tbl->addcolumn("Marka",4);
              $tbl->addcolumn("Renk",5);
              $tbl->addcolumn("Beden",6);
              $tbl->addcolumn("Ürün Adet",7);
              $tbl->addcolumn("Birim Fiyat",8);
              $tbl->addcolumn("Toplam Tutar",9);
              $tbl->TableBaslik();
              ?>

              <tbody>

                <?php 

                while($sipariscek=$admindbservices->vericek($siparissor)) {
                  $siparis=$cons->Siparis_Detay_ekle($sipariscek);
                  $Urunlerim=$cons->Urun_ekle($sipariscek);
                  $toplam+=$sipariscek['satis_fiyat']*$siparis->get_urun_adet();
                  $kdvtoplam+=($sipariscek['satis_fiyat']*$Urunlerim->get_urun_kdv())/100;
                  ?>


                  <tr>

                    <?php 
                    $tbl->addRow($siparis->get_siparis_zaman(),0);
                    $tbl->addRow($siparis->get_siparis_id(),1);
                    $tbl->addRow($Urunlerim->get_barkod_no(),2);
                    $tbl->addRow($Urunlerim->get_urun_ad(),3);
                    $arraylistmarka=array();
                    $markalist=new ArrayList($arraylistmarka);
                    $markalist=$admindbservices->markaArrayListele($Urunlerim->get_marka_id());
                    $markalist=$markalist->toArray();
                    foreach ($markalist as $Markalar) 
                    {
                     $tbl->addRow($Markalar->get_marka_adi(),4);
                   }
                   $arraylistrenk=array();
                   $renklist=new ArrayList($arraylistrenk);
                   $renklist=$admindbservices->renkleriListele($Urunlerim->get_renk_id());
                   $renklist=$renklist->toArray();
                   foreach ($renklist as $renklerim) 
                   {
                     $tbl->addRow($renklerim->get_renk_adi(),5);
                   }
                   $arraylistbeden=array();
                   $bedenlist=new ArrayList($arraylistbeden);
                   $bedenlist=$admindbservices->bedenArrayListele($Urunlerim->get_beden_id());
                   $bedenlist=$bedenlist->toArray();
                   foreach ($bedenlist as $bedenlerim) 
                   {
                     $tbl->addRow($bedenlerim->get_beden_icerik(),6);
                   }
                   $bedensor=$dbsql->wread("beden","beden_id",htmlspecialchars());
                   $bedencek=$bedensor->fetch(PDO::FETCH_ASSOC);
                   $bedenlerim=$cons->Beden_ekle($bedencek);
                   
                   $tbl->addRow($siparis->get_urun_adet(),7);
                   $tbl->addRow(number_format($sipariscek['satis_fiyat'], 2, ',', '.'),8);
                   $tbl->addRow(number_format($sipariscek['satis_fiyat']*$siparis->get_urun_adet(), 2, ',', '.'),9);

                   ?>

                 </tr>



               <?php  }

               ?>


             </tbody>
           </table>

           <!-- Div İçerik Bitişi -->


         </div>


         <div style="float: right;">
          <?php echo "KDV:   ".number_format($kdvtoplam, 2, ',', '.')." T.L."?> 
          <br>
          <?php echo "Ara Toplam:   ".number_format($toplam-$kdvtoplam, 2, ',', '.')." T.L."?>    
          <br>
          <?php echo "Genel Toplam:   ".number_format($toplam, 2, ',', '.')." T.L."?>       
        </div>
      </div>
    </div>
  </div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
