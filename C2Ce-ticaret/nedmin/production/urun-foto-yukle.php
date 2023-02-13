<?php 

include 'header.php';
$foto=new Foto_Yükle("urun-galeri.php?urun_id=".htmlspecialchars($_GET['urun_id']),"../netting/urungaleri.php","urun_id",htmlspecialchars($_GET['urun_id']));
 include 'footer.php'; ?>
