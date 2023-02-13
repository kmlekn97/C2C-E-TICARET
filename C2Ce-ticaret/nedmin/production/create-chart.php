<script>
  $(document).ready(function(){

    <?php 
    require_once '../netting/class.crud-guncel.php';
    require_once '../netting/Istatistik.php';
    require_once 'CLASS/Sınıf_Islem.php';
    require_once '../../services/chartDBServices.php';


    $istatistik=new hesap();

    function kategori($sira)
    {
      $dbsql=new crud();
      $cons=new Sınıf_Islem();
      $chartdbservices=new chartDBServices($dbsql,$cons);
      $kategorim=$chartdbservices->kategoriListele($sira);
      return htmlspecialchars_decode($kategorim->get_kategori_ad());
    }

    function kategoricount()
    {
      $dbsql=new crud();
      $cons=new Sınıf_Islem();
      $chartdbservices=new chartDBServices($dbsql,$cons);
      $katagorisor=$chartdbservices->kategoriOku();
      $count=$katagorisor->rowCount();
      return $count;
    }

    function yuzde($sira,$sorgu=null)
    {
      $yüzde=0;
      $dbsql=new crud();
      $istatistik=new hesap();
      $cons=new Sınıf_Islem();
      $chartdbservices=new chartDBServices($dbsql,$cons);
      $kategorim=$chartdbservices->kategoriListele($sira);
      $yuzde=number_format(($istatistik->kategorihesapla("toplam",$kategorim->get_kategori_id(),$sorgu)*100)/$istatistik->kategorihesapla("genel_toplam",$kategorim->get_kategori_id(),$sorgu), 2, '.', '');
      if ($istatistik->kategorihesapla("genel_toplam",$kategorim->get_kategori_id(),$sorgu)==0)
        $yuzde=0;
      return $yuzde;
    }

    ?>
    var options = {
      legend: false,
      responsive: false
    };

    new Chart(document.getElementById("canvas1"), {
      <?php 
      $dbsql=new crud();
      $cons=new Sınıf_Islem();
      $chartdbservices=new chartDBServices($dbsql,$cons);
      ?>
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: {
        labels: [
        <?php
        for ($i=0;$i<=kategoricount();$i++)
          {?>
            "<?php echo kategori($i) ?>",
          <?php }
          ?>
          "<?php 
          if ($i==kategoricount())
            echo kategori(kategoricount()) 
          ?>"
          ],
          datasets: [{
            data: [<?php 
              for ($i=0;$i<=kategoricount();$i++)
              {
               echo yuzde($i,null) ?>,

               <?php 
               if ($i==kategoricount())
                echo yuzde(kategoricount(),null);

            }

            ?>],
            backgroundColor: [
            "#3498DB",
            "#26B99A",
            "#9B59B6",
            "#CFD4D8",
            "#E74C3C",
            "gold",
            "olive",
            "maroon"
            ],
            hoverBackgroundColor: [
            "#3498DB",
            "#26B99A",
            "#9B59B6",
            "#CFD4D8",
            "#E74C3C",
            "gold",
            "olive",
            "maroon"
            ]
          }]
        },
        options: options
      });

    <?php $sorgu_yil=$chartdbservices->findSorguType("yıl");  ?>

    new Chart(document.getElementById("canvas2"), {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: {
        labels: [
        <?php
        for ($i=0;$i<=kategoricount();$i++)
          {?>
            "<?php echo kategori($i) ?>",
          <?php }
          ?>
          "<?php 
          if ($i==kategoricount())
            echo kategori(kategoricount()) 
          ?>"
          ],
          datasets: [{
            data: [
            <?php 
            for ($i=0;$i<=kategoricount();$i++)
            {
             echo yuzde($i,$sorgu_yil) ?>,

             <?php 
             if ($i==kategoricount())
              echo yuzde(kategoricount(),$sorgu_yil);

          }

          ?>],
          backgroundColor: [
          "#3498DB",
          "#26B99A",
          "#9B59B6",
          "#CFD4D8",
          "#E74C3C",
          "gold",
          "olive",
          "maroon"
          ],
          hoverBackgroundColor: [
          "#3498DB",
          "#26B99A",
          "#9B59B6",
          "#CFD4D8",
          "#E74C3C",
          "gold",
          "olive",
          "maroon"
          ]
        }]
      },
      options: options
    });

    <?php $sorgu_ay=$chartdbservices->findSorguType("ay"); ?>

    new Chart(document.getElementById("canvas3"), {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: {
        labels: [
        <?php
        for ($i=0;$i<=kategoricount();$i++)
          {?>
            "<?php echo kategori($i) ?>",
          <?php }
          ?>
          "<?php 
          if ($i==kategoricount())
            echo kategori(kategoricount()) 
          ?>"
          ],
          datasets: [{
            data: [
            <?php 
            for ($i=0;$i<=kategoricount();$i++)
            {
             echo yuzde($i,$sorgu_ay) ?>,

             <?php 
             if ($i==kategoricount())
              echo yuzde(kategoricount(),$sorgu_ay);
            
          }

          ?>],
          backgroundColor: [
          "#3498DB",
          "#26B99A",
          "#9B59B6",
          "#CFD4D8",
          "#E74C3C",
          "gold",
          "olive",
          "maroon"
          ],
          hoverBackgroundColor: [
          "#3498DB",
          "#26B99A",
          "#9B59B6",
          "#CFD4D8",
          "#E74C3C",
          "gold",
          "olive",
          "maroon"
          ]
        }]
      },
      options: options
    });

    <?php $sorgu_gun=$chartdbservices->findSorguType("gün");  ?>

    new Chart(document.getElementById("canvas4"), {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: {
        labels: [
        <?php
        for ($i=0;$i<=kategoricount();$i++)
          {?>
            "<?php echo kategori($i) ?>",
          <?php }
          ?>
          "<?php 
          if ($i==kategoricount())
            echo kategori(kategoricount()) 
          ?>"
          ],
          datasets: [{
            data: [
            <?php 
            for ($i=0;$i<=kategoricount();$i++)
            {
             echo yuzde($i,$sorgu_gun) ?>,

             <?php 
             if ($i==kategoricount())
              echo yuzde(kategoricount(),$sorgu_gun);
            
          }

          ?>],
          backgroundColor: [
          "#3498DB",
          "#26B99A",
          "#9B59B6",
          "#CFD4D8",
          "#E74C3C",
          "gold",
          "olive",
          "maroon"
          ],
          hoverBackgroundColor: [
          "#3498DB",
          "#26B99A",
          "#9B59B6",
          "#CFD4D8",
          "#E74C3C",
          "gold",
          "olive",
          "maroon"
          ]
        }]
      },
      options: options
    });

  });
</script>