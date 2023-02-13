<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi

$sikayetsor=$admindbservices->SikayetGetir();

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Şikayet Listeleme <small>

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

            $tbl=new CreateTable(8);
            $tbl->addcolumn("Şikayet Tarihi",0);
            $tbl->addcolumn("Şikayetçi Ad Soyad",1);
            $tbl->addcolumn("Satıcı Ad Soyad",2);
            $tbl->addcolumn("Adres",3);
            $tbl->addcolumn("Nedeni",4);
            $tbl->addcolumn("",5);
            $tbl->addcolumn("",6);
            $tbl->addcolumn("",7);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 

              while($sikayetcek=$admindbservices->vericek($sikayetsor)) {

                $sikayetler=$cons->Sikayet_ekle($sikayetcek);

                $kullanicilarim_sikayet=$cons->Kullanici_ekle($sikayetcek);

                $arraylistkullanici=array();
                $kullanicilist=new ArrayList($arraylistkullanici);
                $kullanicilist=$admindbservices->kullaniciListele($sikayetler->get_kullanici_idsatici());
                $kullanicilist=$kullanicilist->toArray();
                foreach ($kullanicilist as $kullanicilarim) 
                {
                  $durum=$kullanicilarim->get_kullanici_magaza();
                  $satici_id=$kullanicilarim->get_kullanici_id();
                  $saticiad=$kullanicilarim->get_kullanici_ad();
                  $saticisoyad=$kullanicilarim->get_kullanici_soyad();
                  $adres=$kullanicilarim->get_kullanici_adres();
                }
                  ?>

                  <tr>

                    <?php

                    $tbl->addRow($sikayetler->get_sikayet_zaman(),0);
                    $tbl->addRow(" ".$kullanicilarim_sikayet->get_kullanici_ad(),1);
                    $tbl->addRow($saticiad." ".$saticisoyad,2);
                    $tbl->addRow($adres,3);
                    $tbl->addRow($sikayetler->get_sikayet_zaman(),4);
                    $tbl->AddButton("sikayet_detay?sikayet_id=".$sikayetler->get_sikayet_id(),5,"Detay","primary");
                    if ($durum==1)
                    {
                      $tbl->AddButton("../netting/islem.php?kullanici_id=".$satici_id."&engel_kaldir=ok",6,"ENGEL KALDIR","success");
                    }
                    else
                    {
                      $tbl->AddButton("../netting/islem.php?kullanici_id=".$satici_id."&engelle=ok",6,"ENGELLE","danger");
                    }
                    $tbl->AddButton("mesaj-gonder.php?kullanici_id=".$satici_id,7,"Mesaj","information");
                    $tbl->AddButton("../netting/islem.php?sikayet_id=".$sikayetler->get_sikayet_id()."&sikayetsil=ok",8,"Sil","danger");

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