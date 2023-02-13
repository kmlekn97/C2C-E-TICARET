<?php 

include 'header.php';
$foto=new Foto_Yükle("kampanya_slider_ekle.php?kampanya_id=".htmlspecialchars($_GET['kampanya_id']),"../netting/kampanyagaleri.php","kampanya_id",htmlspecialchars($_GET['kampanya_id']));
 include 'footer.php'; ?>
