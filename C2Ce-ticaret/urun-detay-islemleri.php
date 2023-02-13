<?php
/**
 * 
 */
require_once 'services/UrunDetayService.php';
require_once 'services/ArrayList.php';

class UrunDetayIslem
{

	private $cons;
	private $dbsql;
	private $urundbservice;
	
	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
		$urundbservice=new UrunDetayService($dbsql,$cons);
		$this->urundbservice = $urundbservice;
	}
	
	public function Favoridurumcek()
	{
		if (htmlspecialchars($_GET['durum'])=="basarili") {?>

			<script type="text/javascript">
				alert("Ürün Düştüğünde Haber Verilecektir...");
			</script>

		<?php } elseif (htmlspecialchars($_GET['durum'])=="basarisiz") {?>


			<script type="text/javascript">
				alert("Hata Oluştu...");
			</script>

		<?php }
		else if(htmlspecialchars($_GET['durum'])=="tekrar")
			{?>
				<script type="text/javascript">
					alert("Ürünü Zaten Favorilere Ekledik...");
				</script>
				<?php	
			}
		}

		public function Resimler($urunlerim,$urun_fotolarim)
		{
			
			?>
			<div class="resimler">

				<div class="single-banner" style="width: 432px; height: 576px;"> 

					<img src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>" onclick="openModal();currentSlide(1)" class="hover-shadow">

				</div>

				<div class="row"  style="height:150px; width:400px; margin-left: 1px;">

					<?php
					$say=2;
					$urun_id=$urunlerim->get_urun_id();
					$arraylisturunfoto=array();
					$urunfotolist=new ArrayList($arraylisturunfoto);
					$urunfotolist=$this->urundbservice->urunfotoListele($urun_id);
					$urunfotolist=$urunfotolist->toArray();
					foreach ($urunfotolist as $urun_fotolarim) 
					{
						?>
						<div class="column">
							<img width="200px" src="<?php echo $urun_fotolarim->get_urunfoto_resimyol() ?>" onclick="openModal();currentSlide(<?php echo $say; ?>)" class="hover-shadow">
						</div>

						<?php
						$say++;
					}
					?>  
				</div>

				<!-- The Modal/Lightbox -->

				<div id="myModal" class="modal" style="width: %100; height:%100; margin-top: 60px;">
					<span class="close cursor" onclick="closeModal()">&times;</span>
					<div class="modal-content" style="height: 90%; width: 70%">
						<div class="mySlides" style="position: fixed; top:215px; left: 75px; right: 75px; margin-top:15px ">
							<center><img  width="430px" height="400px"src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>" style="width:320px height:520px"></center>
						</div>

						<?php
						$urun_id=$urunlerim->get_urun_id();
						$arraylisturunfoto=array();
						$urunfotolist=new ArrayList($arraylisturunfoto);
						$urunfotolist=$this->urundbservice->urunfotoListele($urun_id);
						$urunfotolist=$urunfotolist->toArray();
						foreach ($urunfotolist as $urun_fotolarim) 
						{
							?>
							<div class="mySlides" style="position: fixed; top:215px; left: 100px; right: 75px; margin-top:15px ">
								<center><img src="<?php echo $urun_fotolarim->get_urunfoto_resimyol() ?>" style="width:40% height:30%"></center>

							</div>


							<?php
						}
						?>  
						<!-- Next/previous controls -->
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(2)">&#10095;</a>

						<!-- Caption text -->
					</div>



				</div>   
			</div> 
			<?php
		}

		public function BenzerUrunler($urunlerim)
		{
			$benzersor=$this->urundbservice->benzerurunListele($urunlerim->get_alt_kategori_id());?>

			<div class="container=fluid" style="width: 180% ">
				<div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">


					<?php 


					while($benzercek=$this->urundbservice->vericek($benzersor)) { 
						$urunlerim=$this->cons->Urun_ekle($benzercek);
						$altkategorilerim=$this->cons->Alt_kategori_ekle($benzercek);
						$kategorilerim=$this->cons->Kategori_ekle($benzercek);
						$kullanicilarim=$this->cons->Kullanici_ekle($benzercek); 
						?>


						<!-- Çok Satanlar Start -->
						<div class="single-item-grid">
							<div class="item-img">
								<a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><img style="width: 451px; height: 385px;" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>" alt="product" class="img-responsive"></a>
								<div class="trending-sign" data-tips="Benzer Ürün"><i class="fa fa-bolt" aria-hidden="true"></i></div>
							</div>
							<div class="item-content"  style="word-wrap:break-word;">
								<div class="item-info">
									<h3><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>""> 

										<?php
										$renklist=new ArrayList($arraylistrenk);
										$renkliste=$this->urundbservice->Renkleri_getir($urunlerim->get_renk_id());
										$renkliste=$renkliste->toArray();
										foreach ($renkliste as $renklerim) 
										{
											$renk=$renklerim->get_renk_adi();
										}
										$urunadsor=$this->urundbservice->urunozellikgetir($urunlerim->get_urun_id());

										$say=$urunadsor->rowCount();
										while($urunadcek=$this->urundbservice->vericek($urunadsor)) {

											$urunlerim=$this->cons->Urun_ekle($urunadcek);
											$ozellik_detaylarim=$this->cons->Ozellik_Detay_ekle($urunadcek);
											$ozellik_detay_iceriklerim=$this->cons->Ozellik_Detay_Icerik_ekle($urunadcek);
											$detaylarim=$ozellik_detaylarim->get_ozellik_detay();


											if (isset($detaylarim))
												$kapasite=$detaylarim." GB ";

										}
										if ($say==0)
											$kapasite="";

										$arraylistmarka=array();
										$markalist=new ArrayList($arraylistmarka);
										$markalist=$this->urundbservice->Markalari_getir($urunlerim->get_marka_id());
										$markalist=$markalist->toArray();
										foreach ($markalist as $markalarim)
										{
											$marka=$markalarim->get_marka_adi();
											?>
											<strong>
												<?php echo $marka; 

												?>
											</strong>
											<?php
											$yazi=$urunlerim->get_urun_ad();
											$detay = $yazi;
                                                    //Var olan metin içindeki karakter sayısı
											$uzunluk = strlen($detay);
                                                    //Kaç Karakter Göstermek İstiyorsunuz
											$limit = 28;
                                                    //Uzun olan yer "devamı..." ile değişecek.
											if ($uzunluk > $limit) {
												$detay = substr($detay,0,$limit);
												echo " ".$detay." ".$kapasite." ".$renk."...<br>";
											}           
											else

												echo " ".$detay." ".$kapasite." ".$renk."<br>"; ?>
										</a></h3>
									<?php } ?>

									<span><a href="kategoriler-<?=seo($kategorilerim->get_kategori_ad())."-".$urunlerim->get_kategori_id() ?>"><?php echo $kategorilerim->get_kategori_ad() ?></a></span>
									<div class="price" style="float: left;">

										<?php 

										$fiyat=$urunlerim->get_urun_fiyat(); 
										$yedek_fiyat=number_format($urunlerim->get_urun_fiyat_yedek(), 2, ',', '.');
										$tl_formati = number_format($fiyat, 2, ',', '.'); 
										if ($urunlerim->get_urun_fiyat_yedek() == NULL)
											{?>
												<div style="float: left;height: 3px;"><?php echo "<br><br>".$tl_formati; ?> TL </div>

												<?php
											}
											else
												{?>
													<div style="float: left;text-decoration: line-through; color:grey;height: 0.1px;padding-top: 35px;"><?php echo  "<br>".$yedek_fiyat; ?></div>
													<div style="padding-left: 5px;"></div>

													<div style="float: left;height: 0.1px;padding-bottom: 28px;"><?php echo "<br><br>".$tl_formati; ?> TL </div>
												<?php }
												?> 

											</div>
										</div>

										<div class="item-profile">
											<div class="profile-title">

											</div>
											<div class="profile-rating">
											</div>
										</div>
									</div>
								</div>
								<!-- Çok Satanlar Finish -->

							<?php } ?> 


						</div>
					</div>
					<br>
					<br>
					<?php
				}
				public function Aciklama($urunlerim)
				{
					?>
					<div class="aciklama">                           
						<div class="product-details-tab-area" style="width: 180%;">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<ul class="product-details-title">
										<li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Ürün Açıklaması</a></li>
										<li><a href="#review" data-toggle="tab" aria-expanded="false">Yorumlar</a></li>

									</ul>
								</div>
								<div class="col-lg-12 col-md-6 col-sm-12">
									<div class="tab-content">
										<div class="tab-pane fade active in" id="description">
											<p> <?php echo html_entity_decode($urunlerim->get_urun_detay()); ?> </p>
										</div>
										<div class="tab-pane fade" id="review">


											<div class="container">
												<div class="row">
													<div class="col-md-8">



														<div class="comments-list">

															<?php 
															$yorumsor=$this->urundbservice->yorumgetir();

															if (!$yorumsor->rowCount()) {

																echo "Bu ürün için henüz yorum girilmemiştir";
															}

															while($yorumcek=$this->urundbservice->vericek($yorumsor)) { 

																$yorumlarim=$this->cons->Yorumlar_ekle($yorumcek);
																$kullanicilarim=$this->cons->Kullanici_ekle($yorumcek)

																?>

																<div class="media">

																	<div class="media-body">

																		<h4 class="media-heading user_name"><img style="border-radius: 30px; float: left; margin-right: 10px;" width="32" height="32" class="img-responsive" src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" alt="Profil Resmi"> <?php echo $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad() ?> 

																		<ul style="float:right" class="default-rating">

																			<?php 

																			switch ($yorumlarim->get_yorum_puan()) {

																				case '5': ?>

																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>

																				<?php            
																				break;

																				case '4': ?>

																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


																				<?php                                                                           
																				break;

																				case '3': ?>

																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


																				<?php                           
																				break;

																				case '2': ?>

																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


																				<?php                                                                           
																				break;

																				case '1': ?>

																				<li><i class="fa fa-star" aria-hidden="true"></i></li>         
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
																				<li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


																				<?php                                                                           
																				break;


																			}


																			?>





																			<li>(<span> <?php echo $yorumlarim->get_yorum_puan() ?></span> )</li>
																			<li>

																				<?php
																				 echo $this->urundbservice->typeurunyorumtype($yorumlarim->get_yorum_analys())

																				?>
																			</li>
																		</ul>
																	</h4>
																	<?php echo $yorumlarim->get_yorum_detay() ?>

																</div>
															</div>

															<hr>

														<?php } ?>



													</div>



												</div>
											</div>
										</div>




									</div>

								</div>

							</div>
						</div>
					</div> 
				</div> 

				<?php
			}
			public function Sikayet($kullanicilarim,$urunlerim)
			{
				?>
				<div class="product-details-tab-area" id="ozellik">

					<div class="col-lg-12 col-md-12 col-sm-12">
						<ul>
							<li>
								<table class="table">
									<tbody>
										<tr>
											<td>
												<br>
												<center>
													<?php if (empty($_SESSION['userkullanici_mail'])==0 && $_SESSION['userkullanici_id']!=$kullanicilarim->get_kullanici_id())
													{?>
														<a href="sikayet_et.php?urun_id=<?php echo htmlspecialchars($_GET['urun_id']) ?>" style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"> Şikayet Et</i></a>
														<?php 
													}

													else if ($_SESSION['userkullanici_id']==$kullanicilarim->get_kullanici_id())
													{
														?>
														<div class="alert">
															<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
															KENDİ ÜRÜNÜNÜZÜ ŞİKAYET EDEMEZSİNİZ...
														</div>
													<?php }
													else
														{?>

															<div class="alert">
																<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
																ŞİKAYET ETMEK İÇİN LÜTFEN ÜYE OLUNUZ...
															</div>

														<?php } ?>

													</center>
												</td>
											</tr>
										</tbody>
									</table>
								</li>
							</ul>
						</div>
					</div>
					<?php
				}
				public function Ozellikler()
				{
					?>
					<div style="font-size: 2.2rem;">Ürün Özellikleri</div>
					<br>
					<div class="product-details-tab-area" id="ozellik">

						<div class="col-lg-12 col-md-12 col-sm-12">
							<ul>
								<li>
									<table class="table">
										<tbody>
											<?php
											$urunadsor=$this->urundbservice->ozellikleriListele();


											while($urunadcek=$this->urundbservice->vericek($urunadsor)) {

												$urunlerim=$this->cons->Urun_ekle($urunadcek);
												$ozellik_detaylarim=$this->cons->Ozellik_Detay_ekle($urunadcek);
												$ozellik_detay_iceriklerim=$this->cons->Ozellik_Detay_Icerik_ekle($urunadcek);

												$arraylistozellik=array();
												$ozelliklist=new ArrayList($arraylistozellik);
												$ozelliklist=$this->urundbservice->Urunozelliklistele($ozellik_detaylarim->get_urun_ozellikleri_id());
												$ozelliklist=$ozelliklist->toArray();
												foreach ($ozelliklist as $urunozelliklerim)
												{
													$ozellik=$urunozelliklerim->get_ozellik_adi();
												}

												?>

												<tr>
													<td><?php 

													echo $ozellik; 

													?>

												</td>
												<td><?php echo $ozellik_detaylarim->get_ozellik_detay() ?></td>
											</tr>

										<?php } ?>
									</tbody>
								</table>
							</li>
						</ul>
					</div>
				</div>
				<?php

			}

			public function UrunBanner($urunlerim,$kullanicilarim)
			{
				?>
				<div align="center">
					<?php 
					$fiyat=$urunlerim->get_urun_fiyat(); 
					$yedek_fiyat=number_format($urunlerim->get_urun_fiyat_yedek(), 2, ',', '.');
					$tl_formati = number_format($fiyat, 2, ',', '.'); 
					if ($urunlerim->get_urun_fiyat_yedek() == NULL)
						{?>
							<div style="font-size: 30px;"><?php echo $tl_formati; ?> <span style="font-size: 12px;">TL</span> </div>

							<?php
						}
						else
							{?>
								<div style="font-size: 30px;text-decoration: line-through; color:grey;"><?php echo $yedek_fiyat; ?> <span style="font-size: 12px;">TL</span> </div>
								<div style="padding-left: 5px;"></div>

								<div style="font-size: 30px;"><?php echo $tl_formati; ?> <span style="font-size: 12px;">TL</span> </div>
							<?php }
							?> 

							<hr>

						</div>

						<form action="odeme" method="POST">
							<ul class="sidebar-product-btn" id="urunkim">

								<input type="hidden" name="urun_id" value="<?php echo $urunlerim->get_urun_id() ?>">

								<?php
								$arraylistpuan=array();
								$puanlist=new ArrayList($arraylistpuan);
								$puanlist=$this->urundbservice->PuanHesapla($_GET['urun_id']);
								$puanlist=$puanlist->toArray();
								foreach ($puanlist as $puanlarim)
								{
									$yorum_adet=$puanlarim;
									$deger=$puanlarim;
									$puan=$puanlarim;
								}
							?> <ul class="default-rating" style="float: right;">
								<?php include 'rating.php'; ?>
							</ul> 
							<?php 

							if (empty($_SESSION['userkullanici_id'])) {?>

								<li><a href="login" class="buy-now-btn" id="buy-button"><i class="fa fa-ban" aria-hidden="true"></i> Giriş Yapın</a></li>

							<?php }

							else if ($_SESSION['userkullanici_id']==$kullanicilarim->get_kullanici_id()) {?>

								<li><a class="add-to-cart-btn" id="cart-button"><i class="fa fa-ban" aria-hidden="true"></i> Kendi Ürününüz</a></li>

							<?php  } else {?>

								<li><button type="submit" class="add-to-cart-btn" id="cart-button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Satın Al</button></li>

							<?php }
							?>

						</form>
					</ul>
					<br>
					<a href="nedmin/netting/islem.php?urun_id=<?php echo $urunlerim->get_urun_id(); ?>&sepet_ekle=ok"><button  class="add-to-cart-btn" id="cart-button" style="background-color: #ff5f2e"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SEPETE AT</button></a>
				</div>
			</div> 
			<?php
		}

		public function Karsilastir()
		{
			?>

			<style type="text/css">
				.del
				{	
					padding-left: 200px;
					margin-left: 3rem;
					color: red;
				}

				.del:hover {
					color: black;
				}
			</style>

			<!-- Button trigger modal -->
			<button type="button" id="karsilastirma" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModal">Karşılaştır <i class="fa fa-exchange" aria-hidden="true"></i>
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
				<div id="bölge"></div>
				<div class="modal-dialog modal-lg" id="ref" role="document">
					<div class="modal-content">
						<div class="modal-header" style="overflow-x: scroll; overflow-y: hidden;">
							<h5 class="modal-title" id="exampleModalLabel"><b>ÜRÜN KARŞILAŞTIRMA</b><br></h5>
							<?php 

							$karsilastirsor=$this->urundbservice->karsilatirListele();

							?>

							<div class="container" id="anares">
								<?php
								
								while ($karsilastircek=$this->urundbservice->vericek($karsilastirsor)) {
									$urunlerim=$this->cons->Urun_ekle($karsilastircek);
									$karsilastirmalarim=$this->cons->Karsilastirmalar_ekle($karsilastircek);
									?>
									<div class="row" id="delete" style="float: left;width: 280px">
										<div class="del" onclick="sil()" id="<?php echo $karsilastirmalarim->get_karsilastir_id() ?>">x</div>
										<div>
											<img width="240px" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>">

										</div>
									</div>
								<?php } ?>
							</div>

							<button type="button" class="close" onclick="kapat()" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Karşılaştırma yapabilmek için bir ürün daha ekleyin.
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="kapat()">KAPAT</button>
							<a href="karsilastir_detay.php"><button type="button" id="cmpr" class="btn btn-primary">KARŞILAŞTIR</button></a>
						</div>
					</div>
				</div>
			</div>
			<br>

			<script type="text/javascript">


				$( "#karsilastirma" ).click(function() {

					$.post("karsilastir.php",{urun_id:<?php echo $urunlerim->get_urun_id(); ?>,durum:1},function(a){

					})

					$('.modal-dialog').load(window.location.pathname+' .modal-dialog');

				});



				function sil() {
					var id=jQuery('.del').attr("id");
					$.post("karsilastir.php",{karsilastir_id:id,durum:2},function(a){

					})

					$('.modal-dialog').load(window.location.pathname+' .modal-dialog');
				}

				function kapat() {
					window.location.reload();
				}

				$(document).keypress(function(e) { 
					    if (e.which == 13)  $('#cmpr').click();    // enter (works as expected)
					    if (e.which == 27)  location.reload();// esc   (does not work)
					});

				$(document).on('.modal', function () {
					var zIndex = 1040 + (10 * $('.modal:visible').length);
					$(this).css('z-index', zIndex);
					setTimeout(function() {
						$('.modal-fade').not('.modal-fade').css('z-index', zIndex - 1).addClass('modal-fade');
					}, 0);
				});

			</script>
			<?php
		}
	}
?>