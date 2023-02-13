<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$arraylistaltkategori=array();
$altkategorilist=new ArrayList($arraylistaltkategori);
$altkategorilist=$admindbservices->altkategoriSiraliListele($_GET['kategori_id']);
$altkategorilist=$altkategorilist->toArray();
foreach ($altkategorilist as $altkategori) 
{
 $alt_kategori=$altkategori->get_alt_kategori_id();
}

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kategori Listeleme <small>,

             <?php $form->Durum_cek(); ?>


           </small></h2>

           <div class="clearfix"></div>

           <?php $form->Buttonhref("Yeni Ekle","kategori-ekle.php");  ?>

         </div>
         <div class="x_content">


          <!-- Div İçerik Başlangıç -->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <?php

            $tbl=new CreateTable(8);
            $tbl->addcolumn("S.No",0);
            $tbl->addcolumn("Kategori Ad",1);
            $tbl->addcolumn("Komisyon",2);
            $tbl->addcolumn("Kategori Sira",3);
            $tbl->addcolumn("Kategori Durum",4);
            $tbl->addcolumn("Alt Kategori",5);
            $tbl->addcolumn("Alt Kategori Detay",6);
            $tbl->addcolumn("",7);
            $tbl->TableBaslik();

            ?>

            <tbody id="sortable">

              <?php 

              $say=0;


              $arraylistkategori=array();
              $kategorilist=new ArrayList($arraylistkategori);
              $kategorilist=$admindbservices->kategoriListeleall();
              $kategorilist=$kategorilist->toArray();
              foreach ($kategorilist as $kategorim) 
              {

                $arraylistaltkategori=array();
                $altkategorilist=new ArrayList($arraylistaltkategori);
                $altkategorilist=$admindbservices->altkategoriSiraliListele($_GET['kategori_id']);
                $altkategorilist=$altkategorilist->toArray();
                foreach ($altkategorilist as $altkategori) 
                {
                 $alt_kategori=$altkategori->get_alt_kategori_id();
               }

               $say++;?>

               <tr id="item-<?php echo $kategorim->get_kategori_id(); ?>">

                <?php

                $tbl->addRow($say,0,20,"sortable");
                $tbl->addRow($kategorim->get_kategori_ad(),1);
                $tbl->addRow("% ".$kategorim->get_kategori_oran(),2);
                $tbl->addRow($kategorim->get_kategori_sira(),3);

                ?>


                <td><center><?php 

                if ($kategorim->get_kategori_durum()==1) {
                  $form->Buttonhref2("Aktif",null);

                } else {

                  $form->Buttonhref2("Pasif",null,"danger");

                } ?>
              </center>

            </td> 

            <?php 

            $tbl->AddButton("altkategori.php?kategori_id=".$kategorim->get_kategori_id(),4,"Alt Kategori Ekle","primary");
            $tbl->AddButton("kategori-duzenle.php?kategori_id=".$kategorim->get_kategori_id(),5,"Düzenle","primary");
            $tbl->AddButton("../netting/islem.php?kategori_id=".$kategorim->get_kategori_id()."&alt_kategori_id=".$alt_kategori."&kategorisil=ok",6,"Sil","danger");

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

<script type="text/javascript">

  $(function() {
    $("#sortable").sortable({
      revert:true,
      handle:".sortable",
      stop:function(event,ui) {
        var data=$(this).sortable('serialize');
        console.log(data);
        $.ajax({
          type:"POST",
          dataType:"json",
          data:data,
          url:"../netting/order-ajax.php?kategori_sirala=true",
          success:function(msg) {
           alert("Sıralama Başarılı...");
         }
       });
      }



    });
    $("#sortable").disableSelection();
  });

</script>
