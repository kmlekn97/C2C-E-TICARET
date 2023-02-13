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
            <h2>Slider Listeleme <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="slider-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
              <a href="../netting/islem.php?&slidereskilerisil=ok"><button class="btn btn-danger btn-xs"> Temizle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

             <?php

             $tbl=new CreateTable(11);
             $tbl->addcolumn("S.No",0);
             $tbl->addcolumn("Resim",1);
             $tbl->addcolumn("Ad",2);
             $tbl->addcolumn("Tarih",3);
             $tbl->addcolumn("Süre",4);
             $tbl->addcolumn("Fiyat",5);
             $tbl->addcolumn("Url",6);
             $tbl->addcolumn("Sıra",7);
             $tbl->addcolumn("Durum",8);
             $tbl->addcolumn("",9);
             $tbl->addcolumn("",10);
             $tbl->TableBaslik();

             ?>

             <tbody>

              <?php 

              $say=0;

              $arraylistslider=array();
              $sliderlist=new ArrayList($arraylistslider);
              $sliderlist=$admindbservices->AllSliderGetir();
              $sliderlist=$sliderlist->toArray();
              foreach ($sliderlist as $slider) 
              {

                  $say++;

                  ?>


                  <tr>

                    <?php
                    $tbl->addRow($say,0,20);
                    ?>
                    <td><img width="200" src="../../<?php echo $slider->get_slider_resimyol(); ?>"></td>

                    <?php

                    $tbl->addRow($slider->get_slider_ad(),1);  
                    $tbl->addRow($slider->get_slider_zaman(),2);
                    $tbl->addRow($slider->get_slider_sure(),3);
                    $tbl->addRow($slider->get_slider_fiyat(),4);
                    $tbl->addRow($slider->get_slider_link(),5);
                    $tbl->addRow($slider->get_slider_sira(),6);        

                    ?> 

                    <td><center><?php 

                    if ($slider->get_slider_durum()==1) {
                      $form->Buttonhref2("Aktif",null);
                    } else {

                      $form->Buttonhref2("Pasif",null,"danger");
                    } ?>
                  </center>

                </td>


                <?php

                $tbl->AddButton("slider-duzenle.php?slider_id=".$slider->get_slider_id(),7,"Düzenle","primary");
                $tbl->AddButton("../netting/islem.php?slider_id=".$slider->get_slider_id()."&slidersil=ok&slider_resimyol=".$slider->get_slider_resimyol(),8,"Sil","danger");

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
