<?php 
require_once 'services/UrunDetayService.php';
require_once 'services/ArrayList.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
$dbsql=new crud();
$cons=new Sınıf_Islemleri();
$urundbservice=new UrunDetayService($dbsql,$cons);
?>
<script type="text/javascript">
	$( document ).ready(function() {
		<?php
		$renklerigetirsor=$urundbservice->urunadagoreListele($urunlerim->get_urun_ad());
		$say=$renklerigetirsor->rowCount();
		if ($say>1) 
			{?>
				$('#side').show();
			<?php }
			else
				{?>
					$('#side').hide();
				<?php } ?>
			});
		</script>

		<div class="sidebar-item" id="side">
			<div class="sidebar-item-inner">
				<ul class="sidebar-sale-info">
					<?php

					$renklerigetirsor=$urundbservice->renkpanelgetirme($kategorigetircek,$urunlerim->get_barkod_no(),$urunlerim->get_urun_ad());
					
					while($renklerigetircek=$urundbservice->vericek($renklerigetirsor)) {
						$urunlerim=$cons->Urun_ekle($renklerigetircek);
						$arraylistrenk=array();
						$renklist=new ArrayList($arraylistrenk);
						$renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
						$renkliste=$renkliste->toArray();
						foreach ($renkliste as $renklerim) 
						{

							if ($urunlerim->get_urun_stok()==0) 
								{?>
									<script type="text/javascript">
										$( document ).ready(function() {
											$('#<?php echo $urunlerim->get_renk_id(); ?>').hide();

										});


									</script>


								<?php }?> 

								<div class="renkler" value="<?php echo $renklerim->get_renk_id(); ?>" id="<?php echo $renklerim->get_renk_id(); ?>" style="background: <?php echo $renklerim->get_renk_kodu() ?>; float: left; width: 2rem; border-radius: 40%;margin-left: 8px;">  <label style="visibility: hidden;">fsf</label></div>
							<?php } ?>

						<?php } ?>

					</ul>
				</div>
			</div>
			<script type="text/javascript">
				$( document ).ready(function() {
					<?php
					$bedensor=$urundbservice->renkegorebedengetir($urunlerim->get_renk_id());
					$say=$bedensor->rowCount();
					$kategorigetirsor=$urundbservice->urunadagoreListele($urunlerim->get_urun_ad());

					while($kategorigetircek=$urundbservice->vericek($kategorigetirsor)) {

						$urunlerim=$cons->Urun_ekle($kategorigetircek);

						if (($urunlerim->get_kategori_id()==4 || $urunlerim->get_kategori_id()==15) and $urunlerim->get_beden_id()!=0) 
							{?>

								$('#beden').show();

							<?php }
							else
								{?>

									$('#beden').hide();

								<?php } ?>


								<?php
								if ($urunlerim->get_urun_stok()==0) 
									{?>

										$('#<?php echo "b".$urunlerim->get_beden_id(); ?>').attr("disabled","disabled");

									<?php }?>



								<?php } ?>

							});
						</script>

						<div class="sidebar-item" id="beden">
							<div class="sidebar-item-inner">
								<ul class="sidebar-sale-info">
									<?php
									$bedensor=$urundbservice->altkategoriyegorebedengetir($urunlerim->get_renk_id(),$urunlerim->get_alt_kategori_id());

									while($bedencek=$urundbservice->vericek($bedensor)) {
										$urunlerim=$cons->Urun_ekle($bedencek);
										$bedenlerim=$cons->Beden_ekle($bedencek);
										$renklerim=$cons->Renk_ekle($bedencek);
										?>

										<button type="button" class="btn btn-default" id="<?php echo "b".$bedenlerim->get_beden_id(); ?>"><?php echo $bedenlerim->get_beden_icerik(); ?></button>

									<?php } ?>


								</ul>
							</div>
						</div>

						<div class="sidebar-item" id="satis">
							<div class="sidebar-item-inner">
								<ul class="sidebar-sale-info">
									<li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
									<li>

										<?php 

										echo $urundbservice->SatisAdetHesapla($_GET['urun_id']);

										?>

									</li>
									<li>Satış</li>                     
									<a href="nedmin/netting/islem.php?favorilere_ekle=ok&urun_id=<?php echo $urunlerim->get_urun_id() ?>"><i style="float: right;" class="fa fa-heart fa-3x" aria-hidden="true"></i>  </a>               
								</ul>
							</div>
						</div>

						<?php 

						$deger=$urundbservice->SaticiPuanHesapla($kullanicilarim->get_kullanici_id());
						$puan=floor($deger);

						?>

						<div class="sidebar-item" id="satici">
							<div class="sidebar-item-inner">
								<h3 class="sidebar-item-title">Satıcı</h3>
								<div class="sidebar-author-info">
									<img style="width: 72px; height: 72px;" src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" alt="product" class="img-responsive">
									<div class="sidebar-author-content">
										<h3><?php echo $kullanicilarim->get_magaza_adi() ?></h3>
										<a href="satici-<?=seo($kullanicilarim->get_kullanici_ad()."-".$kullanicilarim->get_kullanici_soyad())."-".$kullanicilarim->get_kullanici_id() ?>" class="view-profile">Profil Sayfası</a>
										<div style="float: right;">
											<b>Satıcı Puan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
											<?php if ($deger>=4)
											{?>
												<button type="button" class="btn btn-success btn-xs"> <?php echo $deger;?></button></div>
											<?php } 
											else if ($deger>=2.5)
												{?>
													<button type="button" class="btn btn-warning btn-xs"> <?php echo $deger;?></button></div>
												<?php } 
												else
													{?>
														<button type="button" class="btn btn-danger btn-xs"> <?php echo $deger;?></button></div>
													<?php } ?>

												</div>
											</div>

											<ul class="sidebar-badges-item">
												<?php 

												$saycek=$urundbservice->SaticitotalsatisHesapla($kullanicilarim->get_kullanici_id());



												if ($saycek['say']>1 and $saycek['say']<=9) {?>

													<li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>

												<?php }  else if ($saycek['say']>9 and $saycek['say']<=99) {?>

													<li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>

												<?php }  else if ($saycek['say']>99 and $saycek['say']<=999) {?>

													<li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>

												<?php }  else if ($saycek['say']>999 and $saycek['say']<=9999) {?>

													<li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>

												<?php }  else if ($saycek['say']>9999) {?>

													<li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
													<li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>

												<?php }?>
											</ul>
										</div>
									</div>    
									<h3>DİĞER SATICILAR</h3>
									<?php
									$urundigersaticisor=$urundbservice->digersaticilarigetir($urunlerim->get_urun_ad(),$urunlerim->get_kategori_id(),$urunlerim->get_renk_id(),$urunlerim->get_beden_id(),$urunlerim->get_marka_id());

									while ($urundigersaticicek=$urundbservice->vericek($urundigersaticisor)) {
										$urunlerim=$cons->Urun_ekle($urundigersaticicek);
										$kullanicilarim=$cons->Kullanici_ekle($urundigersaticicek);	
										if ($urunlerim->get_urun_id()!= htmlspecialchars($_GET['urun_id']))
										{
											$fiyat=$urunlerim->get_urun_fiyat(); 
											$tl_formati = number_format($fiyat, 2, ',', '.'); 
											?>
											<div class="sidebar-item" id="satici">
												<div class="sidebar-item-inner">
													<ul>
														<li style="float: left;"><a href="satici-<?=seo($kullanicilarim->get_kullanici_ad()."-".$kullanicilarim->get_kullanici_soyad())."-".$kullanicilarim->get_kullanici_id() ?>" class="view-profile"><?php echo $kullanicilarim->get_magaza_adi() ?></a>

															<?php

															$deger=$urundbservice->SaticiPuanHesapla($kullanicilarim->get_kullanici_id());
															?>

															<?php if ($deger>=4)
															{?>
																<button type="button" class="btn btn-success btn-xs"> <?php echo $deger;?></button><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
																	<?php echo $tl_formati." TL"; ?></a>
																</div>
															<?php } 
															else if ($deger>=2.5)
																{?>
																	<button type="button" class="btn btn-warning btn-xs"> <?php echo $deger;?></button><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
																		<?php echo $tl_formati." TL"; ?></a>
																	</div>
																<?php } 
																else
																	{?>
																		<button type="button" class="btn btn-danger btn-xs"> <?php echo $deger;?></button>
																		<a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>">
																			<?php echo $tl_formati." TL"; ?></a>
																		</div>
																	<?php } ?>


																</li>


															</ul>
														</div>
													</div>
												<?php }  }?>

											</div>                    
										</div>
									</div>

								</div>
							</div>

							<?php 
							require_once 'footer.php'; 
							require_once 'urun_detay-js.php'; 
							?>

							<script type="text/javascript">
								if (<?php echo htmlspecialchars($_GET['durum'])=="stoktakalmadi"; ?>) {
									alert("Stokta Kalmadı...");
								}
							</script>
