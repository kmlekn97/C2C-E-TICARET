								
<script type="text/javascript">

	$( document ).ready(function() {

		<?php

		$ozellik_say=0;
		$beden_say=0;

		$urunadsor=$dbservice->urundetayjsadsor($urunlerim->get_urun_ad(),$urunlerim->get_renk_id());
		$ozellik_say=$urunadsor->rowCount();
		while($urunadcek=$dbservice->vericek($urunadsor)) {

			$urunlerim=$cons->Urun_ekle($urunadcek);
			$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
			$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);

			?>

			$("#<?php echo "o".$ozellik_detaylarim->get_ozellik_detay_id(); ?>").click(function() 
			{ 

				history.pushState("object or string", "Title", "urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>");

				location.reload();

				$(".renklergel").load( window.location.href +' .renklergel');

				$(".resimler").load( window.location.href+ ' .resimler');

				$(".aciklama").load( window.location.href+ ' .aciklama');

				$("#satis").load( window.location.href+ ' #satis');

				$("#satici").load( window.location.href+ ' #satici');

				$("#urunkim").load( window.location.href+ ' #urunkim');

			});


		<?php } 
		$bedensor=$dbservice->urundetayjsrenkegorebedengetir($urunlerim->get_renk_id());
		$beden_say=$bedensor->rowCount();
		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC)) {

			$bedenlerim=$cons->Beden_ekle($bedencek);
			$urunlerim=$cons->Urun_ekle($bedencek);
			$renklerim=$cons->Renk_ekle($bedencek);

			?>

			$("#<?php echo "b".$bedenlerim->get_beden_id(); ?>").click(function() 
			{ 
				history.pushState("object or string", "Title", "urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>");

				location.reload();

				$(".renklergel").load( window.location.href +' .renklergel');

				$(".resimler").load( window.location.href+ ' .resimler');

				$(".aciklama").load( window.location.href+ ' .aciklama');

				$("#satis").load( window.location.href+ ' #satis');

				$("#satici").load( window.location.href+ ' #satici');

				$("#urunkim").load( window.location.href+ ' #urunkim');

			});


		<?php } 

		$arraylistrenk=array();
		$renklist=new ArrayList($arraylistrenk);
		$renkliste=$dbservice->Renkleri_getir();
		$renkliste=$renkliste->toArray();
		foreach ($renkliste as $renklerim) 
		{
			?>
			$("#<?php echo $renklerim->get_renk_id(); ?>").click(function() 
			{ 

				<?php

				$renklerigetirsor=$dbservice->urundetayjskategorirenkgetir($urunlerim->get_urun_ad(),$renklerim->get_renk_id());
				while($renklerigetircek=$dbservice->vericek($renklerigetirsor)) {
					$urunlerim=$cons->Urun_ekle($renklerigetircek);
					?>

					history.pushState("object or string", "Title", "urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>");

					$(".renklergel").load( window.location.href +' .renklergel');

					$(".resimler").load( window.location.href+ ' .resimler');

					$(".aciklama").load( window.location.href+ ' .aciklama');



					$("#kapasite").load( window.location.href+ ' #kapasite');
					if (<?php echo $ozellik_say?> > 0)
						location.reload();

					if (<?php echo $urunlerim->get_beden_id()?> != 0)
						location.reload();

				<?php } ?>

			});


		<?php } ?>


	});

</script>