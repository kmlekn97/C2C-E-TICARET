<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/rg-1.0.0/datatables.min.js"></script>


<script>
  $('.table-striped').DataTable({
    language: {
      info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
      infoEmpty:      "Gösterilecek hiç kayıt yok.",
      loadingRecords: "Kayıtlar yükleniyor.",
      zeroRecords: "Tablo boş",
      search: "Arama:",
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

  var table = $('.table-striped').DataTable();
  
  new $.fn.dataTable.Buttons( table, {
    buttons: [
    'copy', 'excel', 'print'
    ]
  } );
  
  table.buttons().container()
  .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
</script>


<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>



<script type="text/javascript">


  function exportReportToExcel() {
  let table = document.getElementsByClassName("table-striped"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `export.xlsx`, // fileName you could use any name
    sheet: {
      name: 'Sheet 2' // sheetName
    }
  });
}

function PDFCreate() {  



  html2canvas($('.table-striped')[0], {
    onrendered: function (canvas) {
      var data = canvas.toDataURL();
      var docDefinition = {
        content: [{
          image: data,
          width: 500
        }]
      };
      pdfMake.createPdf(docDefinition).download("documenters.pdf");
    }
  });
}

function RAPOR() {  



  html2canvas($('#rapor'), {
    onrendered: function (canvas) {
      var data = canvas.toDataURL();
      var docDefinition = {
        content: [{
          image: data,
          width: 540

        }]
      };
      pdfMake.createPdf(docDefinition).download("RAPOR.pdf");
    }
  });
}  

</script>