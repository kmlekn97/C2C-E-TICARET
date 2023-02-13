<?php 

include 'header.php'; 

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Listeleme <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>

            <?php $form->Buttonhref("Yeni Ekle","kullanici-ekle.php"); ?>

          </div>
          <div class="x_content">


           <button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
           <button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
           </button>

           <!-- Div İçerik Başlangıç -->

           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(10);
            $tbl->addcolumn("#",0);
            $tbl->addcolumn("Kayıt Tarih",1);
            $tbl->addcolumn("Ad Soyad",2);
            $tbl->addcolumn("Mail Adresi",3);
            $tbl->addcolumn("Telefon",4);
            $tbl->addcolumn("Kullanıcı Tipi",5);
            $tbl->addcolumn("Kullanıcı Durum",6);
            $tbl->addcolumn("Düzenle",7);
            $tbl->addcolumn("",8);
            $tbl->addcolumn("",7);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 
              $arraylistkullanici=array();
              $kullanicilist=new ArrayList($arraylistkullanici);
              $kullanicilist=$admindbservices->allKullaniciListe();
              $kullanicilist=$kullanicilist->toArray();
              foreach ($kullanicilist as $kullanicilarim) 
              {
                 $adetcalisan=$admindbservices->calisanAdetHesapla($kullanicilarim->get_kullanici_id());
                 ?>


                 <tr>
                   <td style="width: 4rem;"> 
                    <?php
                    $foto="";
                    if ($kullanicilarim->get_kullanici_tip() =="LIMITED_OR_JOINT_STOCK_COMPANY" || $kullanicilarim->get_kullanici_tip()=="TECHNİCAL_PERSON" || $kullanicilarim->get_kullanici_tip()=="OWNER") 
                    { 
                      $foto=$kullanicilarim->get_kullanici_resim();
                      ?>
                      <img src="../../<?php echo $foto;?>" class="img-responsive"/>
                    <?php } else { 
                      $foto=$kullanicilarim->get_kullanici_magazafoto();
                      ?>
                      <img src="../../<?php echo $foto;?>" class="img-responsive"/>

                    <?php } ?>


                  </td>
                  <?php

                  $tbl->addRow($kullanicilarim->get_kullanici_zaman(),0);
                  $tbl->addRow($kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(),1);
                  $tbl->addRow($kullanicilarim->get_kullanici_mail(),2);
                  $tbl->addRow($kullanicilarim->get_kullanici_gsm(),3);
                  $tbl->Sirkettype($kullanicilarim->get_kullanici_tip(),$kullanicilarim->get_kullanici_magaza());


                  if ($adetcalisan==0)
                  {

                    $tbl->AddButton("calisan-ekle.php?kullanici_id=".$kullanicilarim->get_kullanici_id(),4,"Çalışan Ekle","primary");


                    ?>
                  <?php } else { 

                    $tbl->AddButton("calisan-ekle.php?kullanici_id=".$kullanicilarim->get_kullanici_id(),-1,"Çalışan Ekle","primary");
                    ?>
                  <?php }

                  $tbl->AddButton("kullanici-duzenle.php?kullanici_id=".$kullanicilarim->get_kullanici_id(),5,"Düzenle","primary");
                  $tbl->AddButton("../netting/islem.php?kullanici_id=".$kullanicilarim->get_kullanici_id()."&kullanicisil=ok&kullanicifoto_resimyol=".$foto,5,"Sil","danger",$kullanicilarim->get_kullanici_mail()." Kullanıcıyı silmek istiyormusunuz? İşlem geri alınamaz...");
                  $tbl->AddButton("yetkile.php?kullanici_id=".$kullanicilarim->get_kullanici_id(),6,"Yetki","primary");

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
