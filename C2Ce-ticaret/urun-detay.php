<?php 
require_once 'header.php';
require_once 'urun-detay-islemleri.php';
require_once 'services/UrunDetayService.php';
$urundbservice=new UrunDetayService($dbsql,$cons);

$uruncek=$urundbservice->urundetayurunListele();
$urunlerim=$cons->Urun_ekle($uruncek);
$kullanicilarim=$cons->Kullanici_ekle($uruncek);

$urun_id=$urunlerim->get_urun_id();
$urunfotocek=$urundbservice->urunfotogetir($urun_id);
$urun_fotolarim=$cons->Urunfoto_ekle($urunfotocek);
$urun_detay_islem=new UrunDetayIslem($dbsql,$cons);
$urun_detay_islem->Favoridurumcek();

?>



<link rel="stylesheet" type="text/css" href="css/urundetayduzeltme.css" />
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<script src="js/urun_galeri.js"></script>
<div class="inner-banner-area">
	<div class="container">
		<div class="inner-banner-wrapper">
			<h2 style="color:white;"><?php echo $urunlerim->get_urun_ad() ?></h2>

		</div>
	</div>
</div>
<!-- Main Banner 1 Area End Here --> 
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">

		</div>
	</div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary" id="düzenlemem">                
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-4 col-sm-8 col-xs-12">
				<div class="inner-page-main-body">

					<?php 

					$urun_detay_islem->Resimler($urunlerim,$urun_fotolarim); 
					for ($i=1;$i<=34;$i++)
						echo "<br>";
					$urun_detay_islem->BenzerUrunler($urunlerim);
					$urun_detay_islem->Aciklama($urunlerim);
					$urun_detay_islem->Sikayet($kullanicilarim,$urunlerim);
					$urun_detay_islem->Ozellikler();

					?>
				</div>
			</div>

			<div class="col-lg-5 col-md-6 col-sm-4 col-xs-12">
				<div class="fox-sidebar">
					<div class="sidebar-item">
						<div class="sidebar-item-inner">
							<h2>    <?php 
							$arraylistmarka=array();
							$markalist=new ArrayList($arraylistmarka);
							$markalist=$urundbservice->Markalari_getir($urunlerim->get_marka_id());
							$markalist=$markalist->toArray();
							foreach ($markalist as $markalarim)
							{
								$marka=$markalarim->get_marka_adi();
							}?>
							<strong>
								<?php echo $marka; ?>
							</strong>
						</h2>
						<div class="renklergel">
							<?php
							$arraylistrenk=array();
							$renklist=new ArrayList($arraylistrenk);
							$renkliste=$urundbservice->Renkleri_getir($urunlerim->get_renk_id());
							$renkliste=$renkliste->toArray();
							foreach ($renkliste as $renklerim) 
							{
								$renk=$renklerim->get_renk_adi();
							}

							$arraylistbeden=array();
							$bedenlist=new ArrayList($arraylistbeden);
							$bedenlist=$urundbservice->bedenlisteleme($urunlerim->get_beden_id());
							$bedenlist=$bedenlist->toArray();
							foreach ($bedenlist as $bedenlerim) 
							{
								$beden=$bedenlerim->get_beden_icerik();
							}
							$urunadsor=$urundbservice->urundetayadlistele($urunlerim->get_urun_ad());
							while($urunadcek=$urundbservice->vericek($urunadsor)) {

								$urunlerim=$cons->Urun_ekle($urunadcek);
								$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
								$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
								$detaylarim=$ozellik_detaylarim->get_ozellik_detay();

								if (isset($detaylarim))
									$kapasite=$detaylarim." GB ";

							}?>

							<h3> 
								<?php   echo " ".$urunlerim->get_urun_ad()." ".$kapasite." ".$renk." ".$beden." ".$urunlerim->get_barkod_no(); ?>
							</a></h3>
						</div>
					</h3>
					<h3 class="sidebar-item-title"></h3>

					<?php 

					$urun_detay_islem->UrunBanner($urunlerim,$kullanicilarim);
					$urun_detay_islem->Karsilastir($urunlerim);

					?>


					<br>

					<div class="kapasiteler">
						<script type="text/javascript">
							$( document ).ready(function() {

								<?php
								$ozelliksor=$urundbservice->kapasiteozellikgetir($urunlerim->get_urun_ad(),$urunlerim->get_renk_id());

								$say=$ozelliksor->rowCount();
								$kategorigetirsor=$urundbservice->ozelligegoreurunListele($urunlerim->get_urun_ad(),$urunlerim->get_renk_id());

								while($kategorigetircek=$urundbservice->vericek($kategorigetirsor)) {

									$urunlerim=$cons->Urun_ekle($kategorigetircek);
									$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($kategorigetircek);
									$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($kategorigetircek);

									if ($urunlerim->get_kategori_id()==13 && $say>0) 
										{?>

											$('#kapasite').show();

										<?php }
										else
											{?>

												$('#kapasite').hide();

											<?php } 

											$urunadsor=$urundbservice->urundetayadlistele($urunlerim->get_urun_ad());

											while($urunadcek=$urundbservice->vericek($urunadsor)) {

												$urunlerim=$cons->Urun_ekle($urunadcek);
												$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
												$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);

												if ($urunlerim->get_urun_stok()==0) 
													{?>

														$('#<?php echo "o".$urunadcek['ozellik_detay_id']; ?>').attr("disabled","disabled");

													<?php }?>

												<?php }?>

											<?php } ?>

										});
									</script>
								</div>
								<div class="sidebar-item" id="kapasite">
									<div class="sidebar-item-inner">
										<ul class="sidebar-sale-info">
											<?php
											$urunadsor=$urundbservice->urundetayozellikgroupListele($urunlerim->get_urun_ad(),$urunlerim->get_renk_id());

											while($urunadcek=$urundbservice->vericek($urunadsor)) {
												$urunlerim=$cons->Urun_ekle($urunadcek);
												$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
												$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);

												?>


												<button type="button" class="btn btn-default" id="<?php echo "o".$ozellik_detaylarim->get_ozellik_detay_id(); ?>"><?php echo $ozellik_detaylarim->get_ozellik_detay(); ?></button>

											<?php } ?>


										</ul>
									</div>
								</div>
								<?php require_once 'urun-detay-sorgulari.php'; ?>