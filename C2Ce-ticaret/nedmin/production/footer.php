<style type="text/css">
  footer {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 40px;
    padding-right:15%;
    margin-top:60%;
  }
</style>
<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="js/jquery-footer.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<script src="../vendors/Chart.js/dist/Chart.min.js"></script>




<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>


<!-- Datatables -->
<script>
  $('#datatable-responsive').DataTable({
    language: {
      info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
      infoEmpty:      "Gösterilecek hiç kayıt yok.",
      loadingRecords: "Kayıtlar yükleniyor.",
      zeroRecords: "Tablo boş",
      search: "Arama:    ",
      infoFiltered:   "(toplam _MAX_ kayıttan filtrelenenler)",
      buttons: {
        copyTitle: "Panoya kopyalandı.",
        copySuccess:"Panoya %d satır kopyalandı",
        copy: "Kopyala",
        print: "Yazdır",
      },

      paginate: {
        first: "İlk",
        previous: "Önceki",
        next: "Sonraki",
        last: "Son"
      },
    },  "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "Hepsi"]],
    "iDisplayLength": 10,
    responsive: true
  });



</script>
<!-- /Datatables -->


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<!-- jQuery 3 --> 
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript">


  function exportReportToExcel() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `export.xlsx`, // fileName you could use any name
    sheet: {
      name: 'Sheet 1' // sheetName
    }
  });
}

function PDFCreate() {  
  window.print();
} 

function RAPOR() {  



  html2canvas($('.raporum'), {
    onrendered: function (canvas) {
      var data = canvas.toDataURL();
      var docDefinition = {
        content: [{
          image: data,
          width: 590

        }]
      };
      pdfMake.createPdf(docDefinition).download("RAPOR.pdf");
    }
  });
} 

</script>

<?php 
require_once 'create-chart.php'; 

?>
<br>
<br>
<br>
<!-- footer content -->
<footer>
  <div class="pull-right">
    Kemal EKIN SHOPPING CENTER <a href=""> &nbsp; Kemal EKIN</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
</body>
</html>