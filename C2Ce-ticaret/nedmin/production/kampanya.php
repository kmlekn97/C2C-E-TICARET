<?php 

include 'header.php'; 



?>
<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Kampanya Listeleme <small>

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

        <?php $form->Buttonhref("Yeni Ekle","kampanya_olustur.php"); ?>

      </div>




      <div class="x_content">




        <!-- Div İçerik Başlangıç -->

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

         <?php 

         $tbl=new CreateTable(11);
         $tbl->addcolumn("S.No",0);
         $tbl->addcolumn("Kampanya Logo",1);
         $tbl->addcolumn("Kampanya Adı",2);
         $tbl->addcolumn("İndirim Oranı",3);
         $tbl->addcolumn("Başlangıç Tarihi",4);
         $tbl->addcolumn("Bitiş Tarihi",5);
         $tbl->addcolumn("Kategori",6);
         $tbl->addcolumn("",7);
         $tbl->addcolumn("",8);
         $tbl->addcolumn("",9);
         $tbl->addcolumn("",10);
         $tbl->TableBaslik();

         ?>

         <tbody>

          <?php 

          $say=0;

          $arraylistkampanya=array();
          $kampanyalist=new ArrayList($arraylistkampanya);
          $kampanyalist=$admindbservices->Kampanyalarigetir();
          $kampanyalist=$kampanyalist->toArray();
          foreach ($kampanyalist as $kampanyalar) 
          {

            $say++;
            $arraylistkategori=array();
            $kategorilist=new ArrayList($arraylistkategori);
            $kategorilist=$admindbservices->kategoriListele($kampanyalar->get_kategori_id());
            $kategorilist=$kategorilist->toArray();
            foreach ($kategorilist as $kategoriler) 
            {
               $kategori=$kategoriler->get_kategori_ad();
            }

            if ($kampanyalar->get_kategori_id()==0)
              $kategori="Genel";

            ?>


            <tr>
              <?php

              $tbl->addRow($say,0,20);

              ?>
              <td><img width="100" src="../../<?php echo $kampanyalar->get_kampanya_logo(); ?>"></td>

              <?php

              $tbl->addRow($kampanyalar->get_kampanya_adi(),1);
              $tbl->addRow("% ".$kampanyalar->get_kampanya_oran(),2);
              $tbl->addRow($kampanyalar->get_kampanyabaslangic_tarihi(),3);
              $tbl->addRow($kampanyalar->get_kampanyabitis_tarihi(),4);
              $tbl->addRow($kategori,5);
              $tbl->AddButton("kampanya_slider_ekle.php?kampanya_id=".$kampanyalar->get_kampanya_id(),6,"Reklam Ekle","information");

              if ($kampanyalar->get_durum()==0)
              {
                $tbl->AddButton("../netting/islem.php?kampanya_id=".$kampanyalar->get_kampanya_id()."&kampanyabaslat=ok",6,"Başlat","success","Kampanya Başlatmak istediğinize emin misiniz?");
              }
              else
              {
               $tbl->AddButton("../netting/islem.php?kampanya_id=".$kampanyalar->get_kampanya_id()."&kampanyabitir=ok",6,"Bitir","warning","Kampanya Bitirmek istediğinize emin misiniz?");
             }
             $tbl->AddButton("kampanya-duzenle.php?kampanya_id=".$kampanyalar->get_kampanya_id(),7,"Düzenle","primary");
             $tbl->AddButton("../netting/islem.php?kampanya_id=".$kampanyalar->get_kampanya_id()."&kampanya_resimyol=".$kampanyalar->get_kampanya_logo()."&kampanyasil=ok",8,"Sil","danger");
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
<!-- /page content -->

<?php include 'footer.php'; ?>
