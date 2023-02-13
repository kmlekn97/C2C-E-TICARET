<?php
/**
* 
*/
class kategori_islem
{

	function __construct($sidehref,$kategoridurum)
	{

		require_once 'header.php';

		?>
		<!-- Header Area End Here -->
		<?php require_once 'search.php' ?>
		<!-- Inner Page Banner Area Start Here -->
		<div class="pagination-area bg-secondary">
			<div class="container">
				<div class="pagination-wrapper">

				</div>
			</div>  
		</div> 
		<!-- Inner Page Banner Area End Here -->          
		<!-- Product Page Grid Start Here -->
		<div class="product-page-list bg-secondary section-space-bottom">                
			<div class="container">
				<div class="row">                        
					<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
						<div class="inner-page-main-body" style="margin-left: 30px;">
							<div class="page-controls">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
										<div class="page-controls-sorting">
											<div class="dropdown">
												<!--<button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Default Sorting<i class="fa fa-sort" aria-hidden="true"></i></button>-->
												<ul class="dropdown-menu">
													<li><a href="#">Date</a></li>
													<li><a href="#">Best Sale</a></li>
													<li><a href="#">Rating</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
										<div class="layout-switcher">
											<ul>
												<!--<li><a href="#gried-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large"></i></a></li>-->    
												<li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>  

							<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal" id="personal-info-form">

								<div class="custom-select" style="float: right;background: #9ACD32;width: 14rem;">
									<select id="sirala"  class='select2'>  
										<option value="RastgeleSırala">Rastgele Sırala</option>
										<option value="FiyataGöreArtan">Fiyata Göre Artan</option>
										<option value="FiyataGöreAzalan">Fiyata Göre Azalan</option>
										<option value="EnYeniler">En Yeniler</option>
										<option value="EnÇokSatanlar">En Çok Satanlar</option>



									</select>
								</div>
							</form>  

							<br>
							<br>
							<br>

							<div class="bosluk" style="margin-top: 6rem;"></div>



							<div class="tab-content">

								<?php

								if ($kategoridurum=="altkategoriler" || $kategoridurum=="altkategoridetay")
									{?>
										<div id="filtre">
											<div id="markam"></div>
											<div id="bedenim"></div>
											<div id="renklerim"></div>



											<div id="ozelliklerim">

												<?php

												$ozellikarraylist=array();
												$ozellikliste=new ArrayList($ozellikarraylist);
												$ozellikliste=$dbservice->Urunozelliklistele();
												$ozellikliste=$ozellikliste->toArray();

												foreach ($ozellikliste as $urun_ozellikleri) 
												{
													?>
													<div id="<?php echo seo($urun_ozellikleri->get_ozellik_adi()); ?>"></div>

												<?php } ?>
											</div>

											<div id="fiyatlarim"></div>


											<div id="temizle">

												<button type="button" class="btn btn-default">Tümünü Kaldır</button>
											</div>

											<br>

										</div>

										<?php
									}

									?>

									<div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
										<div class="product-list-view">


											<?php

											if ($kategoridurum=="altkategoridetay")
											{
												require_once 'altkategoridetay_sorgu.php'; 
											}
											else if ($kategoridurum=="kategoriler")
											{
												$sayfada = 2; // sayfada gösterilecek içerik miktarını belirtiyoruz.

												$sorgu=$dbservice->PacinationKategori($where);
												$toplam_icerik=$sorgu->rowCount();
												$toplam_sayfa = ceil($toplam_icerik / $sayfada);
												// eğer sayfa girilmemişse 1 varsayalım.
												$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
												// eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
												if($sayfa < 1) $sayfa = 1; 
												// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
												if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
												$limit = ($sayfa - 1) * $sayfada;
												$toplam_urun=0;
												if (htmlspecialchars(isset($_GET['kategori_id']))) {

													$durum=0;


													if ($_GET['kategori_id']==13)
													{
														$where=$dbservice->SiralamaSorguelektronik($where);
													}
													else
													{
														
														$where=$dbservice->SiralamaSorgu($where);
													}

													if (htmlspecialchars(isset($_GET['siralama'])))
													{
														if (htmlspecialchars($_GET['siralama'])=="ASC") {
														}
														else if (htmlspecialchars($_GET['siralama'])=="DESC") {
														}
														else if (htmlspecialchars($_GET['siralama'])=="yeni") {
														}
														else 
														{


//tüm tablo sütunlarının çekilmesi
															$urunsor=$dbservice->kategoriuruncoksatanlistelesorgulu($where,$limit,$sayfada);
															//$adet=$dbservice->pagekategoriadet($where);
															$say=$urunsor->rowCount();
															$adet=$say;
															$toplam_urun=$urunsor->rowCount();

															$durum=1;

															if ($say==0) {
//echo "Bu kategoride ürün Bulunamadı";
															}
														}   
													}

													if ($durum==0)
													{

//tüm tablo sütunlarının çekilmesi
														$urunsor=$dbservice->kategoriurunlistelesorgulu($where,$limit,$sayfada);
														$adet=$dbservice->pagekategoriadet($where);
														$say=$urunsor->rowCount();
														$toplam_urun=$urunsor->rowCount();



														if ($say==0) {
//echo "Bu kategoride ürün Bulunamadı";
														}
													}




												} else {


													$urunsor=$dbservice->kategoriurunlistele($limit,$sayfada);
													$adet=$dbservice->pagekategoriadet($where);
													$say=$urunsor->rowCount();
													$toplam_urun=$urunsor->rowCount();

													if ($say==0) {
//echo "Bu kategoride ürün Bulunamadı";
													}



												}
												$sorgu=$dbservice->PacinationKategori($where);
												$toplam_icerik=$sorgu->rowCount();
												$toplam_sayfa = ceil($toplam_icerik / $sayfada);
												$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
												if($sayfa < 1) $sayfa = 1; 
												if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
												$limit = ($sayfa - 1) * $sayfada;
												echo "<b> $adet Adet Ürün Listelendi...</b> <br>";
											}
											else
											{
												require_once 'altkategoriler_sorgu.php'; 
											}

											while($uruncek=$dbservice->vericek($urunsor)) {  
												$Urunlerim=$cons->Urun_ekle($uruncek);
												$kullanicilarim=$cons->Kullanici_ekle($uruncek);

												?>

												<div class="single-item-list">
													<div class="item-img">
														<a href="urun-<?=seo($Urunlerim->get_urun_ad())."-".$Urunlerim->get_urun_id() ?>"><img style="width: 192px; height: 192px;" src="<?php echo $Urunlerim->get_urunfoto_resimyol() ?>" alt="<?php echo $Urunlerim->get_urun_ad() ?>" class="img-responsive"></a>
														<!-- <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>-->
													</div>

													<?php

													$arraylistrenk=array();
													$renklist=new ArrayList($arraylistrenk);
													$renkliste=$dbservice->Renkleri_getir($Urunlerim->get_renk_id());
													$renkliste=$renkliste->toArray();
													foreach ($renkliste as $renkler) 
													{
														$renk=$renkler->get_renk_adi();
													}
													$urunadsor=$dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
														'urun_ozellikleri_id' => 7,
														'urun.urun_id' => $Urunlerim->get_urun_id()     

													));

													$say=$urunadsor->rowCount();
													while($urunadcek=$dbservice->vericek($urunadsor)) {

														$Urunlerim=$cons->Urun_ekle($urunadcek);
														$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
														$detay=$ozellik_detaylarim->get_ozellik_detay();
														if (isset($detay))
															$kapasite=$ozellik_detaylarim->get_ozellik_detay()." GB ";

													}
													if ($say==0)
														$kapasite="";


													?>
													<?php 
													$markasor=$dbsql->wread("marka","marka_id",$Urunlerim->get_marka_id());
													$markacek=$markasor->fetch(PDO::FETCH_ASSOC);
													$markalarim=$cons->Marka_ekle($markacek);
													?>
													<div class="item-content">
														<div class="item-info">
															<div class="item-title">
																<h3><a href="urun-<?=seo($Urunlerim->get_urun_ad())."-".$Urunlerim->get_urun_id() ?>">

																	<?php 
																	$arraylistmarka=array();
																	$markalist=new ArrayList($arraylistmarka);
																	$markalist=$dbservice->Markalari_getir($Urunlerim->get_marka_id());
																	$markalist=$markalist->toArray();
																	foreach ($markalist as $markalarim)
																	{
																		$marka=$markalarim->get_marka_adi();
																	} 
																	?>
																	<strong>
																		<?php echo $marka; 

																		?>
																	</strong>
																	<?php   echo " ".$Urunlerim->get_urun_ad()." ".$kapasite." ".$renk; ?>
																</a></h3>
																<span>
																	<?php
																	$kategorilerim=$cons->Kategori_ekle($uruncek);
																	$altkategorilerim=$cons->Alt_kategori_ekle($uruncek);
																	$altkategoridetaylarim=$cons->Alt_kategori_detay_ekle($uruncek,$uruncek);
																	if ($kategoridurum=="altkategoridetay")
																	{
																		echo $altkategoridetaylarim->get_alt_kategori_detay_ad();
																	} 
																	else if($kategoridurum=="altkategoriler")
																	{
																		echo $altkategorilerim->get_alt_kategori_ad();
																	}
																	else
																	{
																		echo $kategorilerim->get_kategori_ad();
																	} 
																	?>
																</span>
															</div>
															<div class="item-sale-info">
																<div class="price">
																	<?php 
																	$fiyat=$Urunlerim->get_urun_fiyat(); 
																	$yedek_fiyat=number_format($Urunlerim->get_urun_fiyat_yedek(), 2, ',', '.');
																	$tl_formati = number_format($fiyat, 2, ',', '.'); 
																	if ($Urunlerim->get_urun_fiyat_yedek() == NULL)
																		{?>
																			<div><?php echo $tl_formati; ?> </div>

																			<?php
																		}
																		else
																			{?>
																				<div style="text-decoration: line-through; color:grey;font-size: 12px;"><?php echo  "<br>".$yedek_fiyat; ?></div>
																				<div style="padding-left: 5px;"></div>
																				<span style="font-size:12px;">TL</span>

																				<div><?php echo "".$tl_formati; ?> </div>
																			<?php }
																			?> 

																			<span style="font-size:12px;">TL</span>
																		</div>
																		<div class="sale-qty"> <?php 

																		echo "Satış ( ".$dbservice->SatisAdetHesapla($Urunlerim->get_urun_id())." )";

																	?></div>
																</div>
															</div>
															<div class="item-profile">
																<div class="profile-title">
																	<div class="img-wrapper"><img src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" height="50rem;" width="50rem;" alt="profile" class="img-responsive img-circle"></div>

																</div>
																<a href="satici-<?=seo($kullanicilarim->get_kullanici_ad()."-".$kullanicilarim->get_kullanici_soyad())."-".$kullanicilarim->get_kullanici_id() ?>">
																	<br>
																	<?php echo $kullanicilarim->get_magaza_adi(); ?></a>
																	<?php
																	$arraylistpuan=array();
																	$puanlist=new ArrayList($arraylistpuan);
																	$puanlist=$dbservice->PuanHesapla($Urunlerim->get_urun_id());
																	$puanlist=$puanlist->toArray();
																	foreach ($puanlist as $puanlarim)
																	{
																		$yorum_adet=$puanlarim;
																		$deger=$puanlarim;
																		$puan=$puanlarim;
																	}
																	?>
																	<div class="profile-rating-info">
																		<ul>
																			<li>
																				<ul class="profile-rating">
																					<?php include 'rating.php'; ?>
																				</ul>
																			</li>
																			<li><i class="fa fa-comment-o" aria-hidden="true"></i>( <?php echo $yorum_adet; ?> )</li>

																		</ul>
																	</div>
																</div>
															</div>
														</div>



													<?php } ?>

<!--


<li><a href="#">2</a></li>
<li><a href="#">3</a></li>

-->


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<ul class="pagination-align-left">

			<?php

			$s=0;
			$sorgular="";

			while ($s < $toplam_sayfa) {

				$s++; 


				if ($kategoridurum=="altkategoridetay")
				{
					$id=$_GET['alt_kategori_detay_id'];
				}
				else if ($kategoridurum=="altkategoriler")
				{
					$id=$_GET['alt_kategori_id'];
				}
				else
				{
					$id=$_GET['kategori_id'];
				}

				$urlgelen=$_SERVER['REQUEST_URI'];
				$metinbol=explode("$id",$urlgelen);
				if (isset($metinbol))
				{
					$url=$metinbol[1];
				}
				if ($kategoridurum!="kategoriler")
				{
					$url=str_replace("?sayfa=".$_GET['sayfa'],"?",$url);
				}
				else
				{
					$url=str_replace("?sayfa=".$_GET['sayfa'],"",$url);
				}

				if (!empty($id)) { 	

					if ($s==$sayfa) {

						?>

						<li class="active"><a href="<?php echo $kategoridurum; ?>-<?php echo htmlspecialchars($_GET['sef']); ?>-<?php echo htmlspecialchars($id) ?>?sayfa=<?php echo $s.$url; ?>"><?php echo $s; ?></a></li>



					<?php } else {?>



						<li><a href="<?php echo $kategoridurum; ?>-<?php echo htmlspecialchars($_GET['sef']); ?>-<?php echo htmlspecialchars($id) ?>?sayfa=<?php echo $s.$url; ?>"><?php echo $s; ?></a></li>


					<?php   }


				} else {


					if ($s==$sayfa) {?>



						<li><a style="background-color: #C84C3C; color:white;" href="<?php echo $kategoridurum; ?>?sayfa=<?php echo $s.$url; ?>"><?php echo $s; ?></a></li>


					<?php } else {?>

						<li><a href="<?php echo $kategoridurum; ?>?sayfa=<?php echo $s.$url; ?>"><?php echo $s; ?></a></li>




					<?php   }


				}

			}


			?>

		</ul>
	</div>  
</div>
</div>
</div>                               
</div>                                
</div>
</div>


<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">

	<?php require_once $sidehref; ?>
</div>
</div>
</div>
</div>
<!-- Product Page Grid End Here -->
<?php 
require_once 'footer_sorgulu.php'; 


}
}
?> 