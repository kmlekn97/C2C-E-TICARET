<?php
require_once '../netting/baglan.php';
require_once '../netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islem.php';
require_once '../netting/CreateTable.php';
$cons=new Sınıf_Islem();
$dbsql=new crud();
require_once '../../services/AdminDBServices.php';
$admindbservices=new AdminDBServices($dbsql,$cons);
$kategori=htmlspecialchars($_POST["markaliste"]);
$markasor=$admindbservices->markalistpostIslem($kategori);

$say=0;
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#icdata').DataTable( {
      "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "Hepsi"]],
      "iDisplayLength": 10

    } );
  } );
</script>


<button id="btnExport" onclick="exportReportToExcel(this)">EXCELL <i class="fa fa-table" aria-hidden="true"></i></button>
<button id="btnExport" onclick="PDFCreate()">PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</button>

<table id="icdata" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

  <?php

  $tbl=new CreateTable(5);
  $tbl->addcolumn("S.No",0);
  $tbl->addcolumn("Marka Ad",1);
  $tbl->addcolumn("Marka Kategori",2);
  $tbl->addcolumn("",3);
  $tbl->addcolumn("",4);
  $tbl->TableBaslik();

  ?>

  <tbody>

    <?php
    while($markacek=$markasor->fetch(PDO::FETCH_ASSOC))
    {
     $say++;
     $markalarim=$cons->Marka_ekle($markacek);
     $kategorim=$cons->Kategori_ekle($markacek); 

     ?>
     <tr>
      <?php

      $tbl->addRow($say,0,20);
      $tbl->addRow($markalarim->get_marka_adi(),1);
      $tbl->addRow($kategorim->get_kategori_ad(),2);
      $tbl->AddButton("marka-duzenle.php?marka_id=".$markalarim->get_marka_id(),3,"Düzenle","primary");
      $tbl->AddButton("../netting/islem.php?marka_id=".$markalarim->get_marka_id()."&markasil=ok",4,"Sil","danger");

      ?>
    </tr>
    <?php

  }
  ?>

</tbody>

</table>
