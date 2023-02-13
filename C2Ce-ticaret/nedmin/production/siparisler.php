<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi

$siparissor=$admindbservices->SiparisGetir();
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Siparis Listeleme <small>

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

          <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
          <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
          </button>


          <!-- Div İçerik Başlangıç -->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">


            <?php

            $tbl=new CreateTable(10);
            $tbl->addcolumn("Sipariş Tarihi",0);
            $tbl->addcolumn("Alıcı Ad Soyad",1);
            $tbl->addcolumn("Satıcı Ad Soyad",2);
            $tbl->addcolumn("Adres",3);
            $tbl->addcolumn("Sipariş Tutar",4);
            $tbl->addcolumn("Ödeme Durumu",5);
            $tbl->addcolumn("Teslim Durumu",6);
            $tbl->addcolumn("",7);
            $tbl->addcolumn("",8);
            $tbl->addcolumn("",9);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 

              while($sipariscek=$admindbservices->vericek($siparissor)) {

               $siparisler=$cons->Siparis_Detay_ekle($sipariscek);

               $siparistotalsor=$admindbservices->SiparisTotalGetir($siparisler->get_kullanici_id(),$siparisler->get_siparis_zaman());


               while($siparistotal=$admindbservices->vericek($siparistotalsor))
               {
                $total=$siparistotal['tutar'];
                if ($total==0)
                {
                 $siparistotalsilimissor=$admindbservices->SiparisSilinmisGetir($siparisler->get_kullanici_id(),$siparisler->get_siparis_zaman());

                 while($siparistotalsilinen=$admindbservices->vericek($siparistotalsilimissor)) 
                 {
                  $total=$siparistotalsilinen['tutar'];
                }
              }
            }

            $arraylistkullanici=array();
            $kullanicilist=new ArrayList($arraylistkullanici);
            $kullanicilist=$admindbservices->kullaniciListele($siparisler->get_kullanici_id());
            $kullanicilist=$kullanicilist->toArray();
            foreach ($kullanicilist as $kullanicilarim) 
            {
              $ad=$kullanicilarim->get_kullanici_ad();
              $soyad=$kullanicilarim->get_kullanici_soyad();
              $adres=$kullanicilarim->get_kullanici_adres();
            }

            $arraylistsaticikullanici=array();
            $kullanicisaticilist=new ArrayList($arraylistsaticikullanici);
            $kullanicisaticilist=$admindbservices->kullaniciListele($siparisler->get_kullanici_idsatici());
            $kullanicisaticilist=$kullanicisaticilist->toArray();
            foreach ($kullanicisaticilist as $satici) 
            {
             $saticiad=$satici->get_kullanici_ad();
             $saticisoyad=$satici->get_kullanici_soyad();
           }

           ?>

           <tr>
            <?php

            $tbl->addRow($siparisler->get_siparis_zaman(),0);
            $tbl->addRow($ad." ".$soyad,1);
            $tbl->addRow($saticiad." ".$saticisoyad,2);
            $tbl->addRow(wordwrap(html_entity_decode($adres),35,"<br>"),3);
            $tbl->addRow(number_format($total, 2, ',', '.'),4);
            $siparis_detay_onay=$siparisler->get_siparisdetay_onay();
            if ($siparis_detay_onay==1 or $siparis_detay_onay==2 or  $siparis_detay_onay==3)
            {
              ?>
              <td><center>
                <?php
                $form->Buttonhref2("Ödeme Alındı",null);
                ?>
              </center></td>
              <?php
            }
            else
            {
             ?>
             <td><center>
              <?php
              $form->Buttonhref2("Ödenmedi",null,"danger");
              ?>
            </center></td>
            <?php
          }
          ?>
          <td>
            <center>
              <?php 
              if ($siparis_detay_onay==3) {
                $form->Buttonhref2("Teslim Edildi",null);
              } 
              else if ($siparis_detay_onay==2) {
                $form->Buttonhref2("Ürün Kargoda",null,"warning");
              }
              else if ($siparis_detay_onay==1) {
                $form->Buttonhref2("Ürün İşlemleri Yapılıyor",null,"warning");
              }
              else {
               $form->Buttonhref2("Satıcı Teslim Etmedi",null,"danger");
             }

             ?>
           </center>
         </td>

         <?php

         $tbl->AddButton("siparis-detay.php?kullanici_id=".$sipariscek['k_id']."&siparis_zaman=".$siparisler->get_siparis_zaman()."&siparis_id=".$sipariscek['siparis_id'],5,"Detay","primary");
         $tbl->AddButton("../../fatura/admin-fatura.php?siparis_zaman=".$siparisler->get_siparis_zaman()."&kullanici_id=".$sipariscek['k_id']."&skullanici_id=".$sipariscek['ks_id']."&siparis_id=".$siparisler->get_siparis_id(),6,"Fatura","success");
         $tbl->AddButton("../netting/islem.php?siparis_id=".$siparisler->get_siparis_id()."&kullanici_id=".$sipariscek['k_id']."&siparis_zaman=".$siparisler->get_siparis_zaman()."&siparissil=ok",7,"Sil","danger");

         ?>

       </tr>



     <?php  }

     ?>


   </tbody>
 </table>

 <!-- Div İçerik Bitişi -->


</div>
</div>
</div>
</div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
