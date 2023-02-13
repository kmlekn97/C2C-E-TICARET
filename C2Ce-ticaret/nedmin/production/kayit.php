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
            <h2>Kayıt Listeleme <small>

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


          <div align="right">


          </div>
        </div>
        <div class="x_content">


          <!-- Div İçerik Başlangıç -->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(6);
            $tbl->addcolumn("Kayıt Tarih",0);
            $tbl->addcolumn("Ad Soyad",1);
            $tbl->addcolumn("Mail Adresi",2);
            $tbl->addcolumn("Kullanıcı Tipi",3);
            $tbl->addcolumn("İşlem",4);
            $tbl->addcolumn("Kullanıcı IP",5);
            $tbl->TableBaslik();

            ?>

            <tbody>

              <?php 

              $arraylistkayit=array();
              $kayitlist=new ArrayList($arraylistkayit);
              $kayitlist=$admindbservices->KayitListele();
              $kayitlist=$kayitlist->toArray();
              foreach ($kayitlist as $kayitlar) 
              {
                ?>
                <tr>
                  <?php

                  $tbl->addRow($kayitlar->get_kullanici_zaman(),0);
                  $tbl->addRow($kayitlar->get_kullanici_ad()." ".$kayitlar->get_kullanici_soyad(),1);
                  $tbl->addRow($kayitlar->get_kullanici_mail(),2);
                  $tbl->Sirkettype($kayitlar->get_kullanici_tip(),$kayitlar->get_kullanici_magaza());
                  $tbl->addRow($kayitlar->get_Kayit_detay(),3);
                  $tbl->addRow($kayitlar->get_Kayit_ip(),4);
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
