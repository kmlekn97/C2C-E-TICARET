<?php require_once 'header.php'; 

$karsilastirsor=$dbservice->karsilastirmadetayListe();

?>

<link rel="stylesheet" type="text/css" href="css/karsilastir.css" />

<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">
			<ul>
				<li><a href="index.php">Ana Sayfa</a><span> -</span></li>
				<li>Karşılaştır</li>
			</ul>
		</div>
	</div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Cart Page Area Start Here -->
<div class="cart-page-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
				<div class="cart-page-top table-responsive" style=" overflow-x: scroll;overflow-y: scroll;">

					<?php 

					if($karsilastirsor->rowCount()==0)
						{?>
							<div style="font-size: 25px;"><center><b><?php echo "Karşılaştırma listenizde hiç ürün yok."; ?></b></center>
								<br>
								<hr></div>
								<div style="font-size: 12px;"><center><?php echo "İstediğiniz ürünü detay sayfasında bulunan karşılaştır butonunu kullanarak listenize ekleyebilirsiniz.
								"; ?></center>
								<br>
								<hr></div>
								<?php
							}
							?>

							<div class="container" id="anares" style=" width:120%; margin:auto;">
								<?php
								while ($karsilastircek=$dbservice->vericek($karsilastirsor)) {
									$urunlerim=$cons->Urun_ekle($karsilastircek);
									$karsilastirmalarim=$cons->Karsilastirmalar_ekle($karsilastircek);
									$uruncek=$dbservice->karsilastirurunListele($karsilastircek['urun_id']);
									$urunlerim=$cons->Urun_ekle($uruncek);
									$kullanicilarim=$cons->Kullanici_ekle($uruncek);
									?>
									<div class="row" id="delete" style="float: left;width: 280px;">
										<div class="del" onclick="sil()" id="<?php echo $karsilastirmalarim->get_karsilastir_id(); ?>">x</div>
										<div>
											<a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
												<img width="240px" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>"></a>
												<br>
												<br>
												<br>
												<hr>
												<center>
													<?php 

													$arraylistmarka=array();
													$markalist=new ArrayList($arraylistmarka);
													$markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
													$markalist=$markalist->toArray();
													foreach ($markalist as $markalarim)
													{
														$marka=$markalarim->get_marka_adi();
													}

													$arraylistrenk=array();
													$renklist=new ArrayList($arraylistrenk);
													$renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
													$renkliste=$renkliste->toArray();
													foreach ($renkliste as $renklerim) 
													{
														$renk=$renklerim->get_renk_adi();
													}

													$arraylistbeden=array();
													$bedenlist=new ArrayList($arraylistbeden);
													$bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
													$bedenlist=$bedenlist->toArray();
													foreach ($bedenlist as $bedenlerim) 
													{
														$beden=$bedenlerim->get_beden_icerik();
													}

													echo $marka." ".$renk." ".$urunlerim->get_urun_ad()." ".$beden;

													?>
												</center>
												<hr>
												<?php
												$arraylistpuan=array();
												$puanlist=new ArrayList($arraylistpuan);
												$puanlist=$dbservice->PuanHesapla($urunlerim->get_urun_id());
												$puanlist=$puanlist->toArray();
												foreach ($puanlist as $puanlarim)
												{
													$yorum_adet=$puanlarim;
													$deger=$puanlarim;
													$puan=$puanlarim;
												}
												?> 
												<center>
													<ul class="default-rating" style="float: center;">
														<?php include 'rating.php'; ?>
													</ul> 
												</center>

												<br>

												<div style="font-size: 20px;">	<center><b><?php echo $urunlerim->get_urun_fiyat()."TL" ?></b></center></div>

												<?php
												$spuan=$dbservice->SaticiPuanHesapla($urunlerim->get_kullanici_id());
												?>

												<div style="font-size: 20px;">	<center><b><?php echo $kullanicilarim->get_magaza_adi();



												if ($spuan>=4)
													{?>
														<button type="button" class="btn btn-success btn-xs"> <?php echo $spuan;?></button>
													<?php } 
													else if ($spuan>=2.5)
														{?>
															<button type="button" class="btn btn-warning btn-xs"> <?php echo $spuan;?></button>
														<?php } 
														else
															{?>
																<button type="button" class="btn btn-danger btn-xs"> <?php echo $spuan;?></button>
															<?php } ?>


														</b></center></div>
														<center>
															<a href="nedmin/netting/islem.php?urun_id=<?php echo $urunlerim->get_urun_id(); ?>&sepet_ekle=ok"><button  class="btn btn-warning btn-s" id="cart-button" style="background-color: #ff5f2e;,"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SEPETE AT</button></a>
														</center>
														<br>
													</div>
													<hr>
													<div>
														<?php
														$urunadsor=$dbservice->karslastirurunadliste($urunlerim->get_urun_id());

														while($urunadcek=$urunadsor->fetch(PDO::FETCH_ASSOC)) {

															$urunlerim=$cons->Urun_ekle($urunadcek);
															$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
															$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
															$detaylarim=$ozellik_detaylarim->get_ozellik_detay();


															$ozellikliste=new ArrayList($ozellikarraylist);
															$ozellikliste=$dbservice->Urunozelliklistele();
															$ozellikliste=$ozellikliste->toArray();

															foreach ($ozellikliste as $urunozelliklerim) 
															{
																$urun_ozelliklerim=$urunozelliklerim;
															}



															?>
															<center>
																<div id="mesaj" style="margin: 5px;
																background-color: silver;
																border-style: solid;
																border-width: 1px;
																width: 200px;">
																<a class="aciklama" data-title="<?php echo $urun_ozelliklerim->get_ozellik_adi() ?>"><?php 

																echo $detaylarim; 


															?></a>

														</div>
													</center>

												<?php } ?>

											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php require_once 'footer.php'; ?>
			<script type="text/javascript">

				function sil() {
					var id=jQuery('.del').attr("id");
					$.post("karsilastir.php",{karsilastir_id:id,durum:2},function(a){

					})

					window.location.reload();
				}
			</script>
