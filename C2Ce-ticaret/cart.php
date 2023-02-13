
<?php 

require_once 'header.php'; 
?>
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">
			<ul>
				<li><a href="index.php">Ana Sayfa</a><span> -</span></li>
				<li>Sepet</li>
			</ul>
		</div>
	</div>  
</div> 
<?php
if (htmlspecialchars($_GET['durum'])=="kalmadı") {?>            
	<script type="text/javascript">
		alert("Yetersiz Stok...<?php echo htmlspecialchars($_GET['urun_adi']) ?>");  
	</script>
<?php }?>
<!-- Inner Page Banner Area End Here -->          
<!-- Cart Page Area Start Here -->
<div class="cart-page-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
				<div class="cart-page-top table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<td class="cart-form-heading"></td>
								<td class="cart-form-heading">ÜRÜN</td>
								<td class="cart-form-heading">FİYAT</td>
								<td class="cart-form-heading">ADET</td>
								<td class="cart-form-heading">TOPLAM</td>
								<td class="cart-form-heading"></td>
							</tr>
						</thead>
						<tbody id="quantity-holder">
							<?php
							$toplam=0;
							if (isset($_SESSION['userkullanici_id']))
							{
								$kullanici_id=$_SESSION['userkullanici_id'];
							}
							else
							{
								$kullanici_id=$_COOKIE['userid'];
							}
							$urunsor=$dbservice->carturunlistele($kullanici_id);
							while ($uruncek=$dbservice->uruncek($urunsor)) {
								$urunlerim=$cons->Urun_ekle($uruncek);
								$sepet_islem=$cons->Sepet_ekle($uruncek);
								$beden="";
								$arraylistrenk=array();
								$renklist=new ArrayList($arraylistrenk);
								$renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
								$renkliste=$renkliste->toArray();
								foreach ($renkliste as $renklerim) 
								{
									$renk=$renklerim->get_renk_adi();
								}

								$urunadsor=$dbservice->urunadsorliste($urunlerim->get_urun_id());
								$say=$urunadsor->rowCount();
								while($urunadcek=$dbservice->urunadcek($urunadsor)) {
									$urunlerim=$cons->Urun_ekle($urunadcek);
									$ozellik_detaylarim=$cons->Ozellik_Detay_ekle($urunadcek);
									$ozellik_detay_iceriklerim=$cons->Ozellik_Detay_Icerik_ekle($urunadcek);
									$detay=$ozellik_detaylarim->get_ozellik_detay();
									if (isset($detay))
										$kapasite=$detay." GB ";

								}
								if ($say==0)
									$kapasite="";

								$arraylistbeden=array();
								$bedenlist=new ArrayList($arraylistbeden);
								$bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
								$bedenlist=$bedenlist->toArray();
								foreach ($bedenlist as $bedenlerim) 
								{
									$beden=$bedenlerim->get_beden_icerik();
								}

								$arraylistmarka=array();
								$markalist=new ArrayList($arraylistmarka);
								$markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
								$markalist=$markalist->toArray();
								foreach ($markalist as $markalarim)
								{
									$marka=$markalarim->get_marka_adi();
								}

								?>
								<tr>
									<td class="cart-img-holder">
										<a href="#"><img src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>" alt="cart" class="img-responsive"></a>
									</td>
									<td>
										<h3><a href="#"><?php echo " ".$marka." ".$urunlerim->get_urun_ad()." ".$kapasite." ".$renk." ".$beden."".$urunlerim->get_barkod_no(); ?></a></h3>
									</td>
									<td class="amount"><?php echo number_format($urunlerim->get_urun_fiyat(), 2, ',', '.'); ?></td>
									<td class="quantity">
										<div class="input-group quantity-holder">
											<input type="text" name='quantity' class="form-control quantity-input" value="<?php echo $sepet_islem->get_urun_adet(); ?>" id="a<?php echo $sepet_islem->get_sepet_id(); ?>" placeholder="1">
											<div class="input-group-btn-vertical">

												<?php 


												$formpanel->JustButton("btn btn-default quantity-plus",$sepet_islem->get_sepet_id(),"<i class=\"fa fa-plus\" aria-hidden=\"true\"></i>"); 

												$formpanel->JustButton("btn btn-default quantity-minus",$sepet_islem->get_sepet_id(),"<i class=\"fa fa-minus\" aria-hidden=\"true\"></i>");

												?>

											</div>
										</div>
									</td>
									<td>	
										<?php
										$toplam+=$sepet_islem->get_urun_adet() * $urunlerim->get_urun_fiyat();
										?> 
										<input type="text"  name='total' size="2" class="form-control quantity-input" value="<?php echo number_format($sepet_islem->get_urun_adet() * $urunlerim->get_urun_fiyat(), 2, ',', '.') ?>" id="f<?php echo $sepet_islem->get_sepet_id(); ?>" placeholder="1" disabled>
									</td>
									<td class="dismiss" id="<?php echo $sepet_islem->get_sepet_id(); ?>"><a href="cart.php"><i class="fa fa-times" aria-hidden="true"></i></a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="width: 100%">
			<div class="cart-page-bottom-right">
				<h2>TOPLAM</h2>
				<h3>TOPLAM<span>
					<div class="total" style="float: right;">
						<?php echo "<b>".number_format($toplam, 2, ',', '.')." T.L."."</b>"; ?>
					</div>
				</span></h3>
				<div class="proceed-button">
					<form method="post" action="nedmin/netting/kullanici.php">
						<button class="btn-apply-coupon disabled"  name="sepetsiparis"type="submit" value="Login">ÖDEME YAP</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<?php 

require_once 'footer.php'; 


?>

<script type="text/javascript">
	$(document).ready(function () {
		var id=jQuery(this).attr("id");

		$('input').change(function(){

			var adet=$(this).val();
			var id=jQuery(this).attr("id");
			id=id.slice(1,id.length);
			$.post("sepeteekle.php",{sepet:adet,sepet_id:id,durum:0},function(a){
				if (a=="kalmadı")
				{
					alert("Stokta kalmadı!!!");
					$('.quantity-minus').trigger("click");
				}

				$.post("sepeteekle.php",{sepet_id:id,durum:3},function(a){
					$('#f'+id).val(a);
					$('#gelensepet').load(window.location.pathname+' #gelensepet');
				})
			})

			$('.total').load(window.location.pathname+' .total');

		});

		$('.quantity-plus').click(function(){

			var id=jQuery(this).attr("id");
			$.post("sepeteekle.php",{sepet_id:id,durum:1},function(a){
				$('#a'+id).val(a);


				if (a=="kalmadı")
				{
					alert("Stokta kalmadı!!!");
					$('.quantity-minus').trigger("click");
				}
				else
				{
					$('.total').load(window.location.pathname+' .total');
				}


				$.post("sepeteekle.php",{sepet_id:id,durum:3},function(a){
					$('#f'+id).val(a);
					$('#gelensepet').load(window.location.pathname+' #gelensepet');
					$('.total').load(window.location.pathname+' .total');
				})
			})




			$('.total').load(window.location.pathname+' .total');




		});

		$('.quantity-minus').click(function(){

			var id=jQuery(this).attr("id");
			$.post("sepeteekle.php",{sepet_id:id,durum:2},function(a){
				$('#a'+id).val(a);
				$.post("sepeteekle.php",{sepet_id:id,durum:3},function(a){
					$('#f'+id).val(a);
					$('#gelensepet').load(window.location.pathname+' #gelensepet');
				})

			})



			$('.total').load(window.location.pathname+' .total');


		});

		$('.dismiss').click(function(){

			var id=jQuery(this).attr("id");
			$.post("sepeteekle.php",{sepet_id:id,durum:-1},function(a){
				$('#gelen').load(window.location.pathname+' #gelen');
			})


			$('.total').load(window.location.pathname+' .total');


		});

	});
</script>


