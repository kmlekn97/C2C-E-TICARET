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
            <h2>Yorum Listeleme <small>

              <?php $form->Durum_cek(); ?>


            </small></h2>

            <div class="clearfix"></div>

          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

              <?php

              $tbl=new CreateTable(6);
              $tbl->addcolumn("S.No",0);
              $tbl->addcolumn("Yorum",1);
              $tbl->addcolumn("Duygu",2);
              $tbl->addcolumn("Kullanıcı",3);
              $tbl->addcolumn("Ürün",4);
              $tbl->addcolumn("Durum",5);
              $tbl->addcolumn("",6);
              $tbl->TableBaslik();

              ?> 

              <tbody>

                <?php 

                $say=0;
                $ad="";


                $arraylistyorum=array();
                $yorumlist=new ArrayList($arraylistyorum);
                $yorumlist=$admindbservices->yorumListele();
                $yorumlist=$yorumlist->toArray();
                foreach ($yorumlist as $yorumlarim) 
                {

                  $say++;

                  ?>


                  <tr>

                    <?php

                    $tbl->addRow($say,0,20);
                    $tbl->addRow(wordwrap($yorumlarim->get_yorum_detay(),35,"<br>"),1);
                    $tbl->addRow($yorumlarim->get_yorum_analys(),2);
                    $kullanicisor=$dbsql->wread("kullanici","kullanici_id",$yorumlarim->get_kullanici_id());
                    while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {
                      $kullanicilarim=$cons->Kullanici_ekle($kullanicicek);
                      $ad=$kullanicilarim->get_kullanici_ad();
                      $soyad=$kullanicilarim->get_kullanici_soyad();
                    }
                    $tbl->addRow($ad." ".$soyad,3);
                    $urun_id=$yorumlarim->get_urun_id();
                    $urunsor=$dbsql->wread("urun","urun_id",$urun_id);
                    while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {
                      $Urunlerim=$cons->Urun_ekle($uruncek);
                      $urunadi=$Urunlerim->get_urun_ad();
                    }
                    $tbl->addRow($urunadi,4);
                    if ($yorumlarim->get_yorum_onay()==0)
                    {
                      $tbl->AddButton("../netting/islem.php?yorum_id=".$yorumlarim->get_yorum_id()."&yorum_one=1&yorum_onay=ok",5,"Onayla","success");
                    }
                    else
                    {
                      $tbl->AddButton("../netting/islem.php?yorum_id=".$yorumlarim->get_yorum_id()."&yorum_one=0&yorum_onay=ok",5,"Kaldır","warning");
                    }
                    $tbl->AddButton("../netting/islem.php?yorum_id=".$yorumlarim->get_yorum_id()."&yorumsil=ok",6,"Sil","danger");
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
