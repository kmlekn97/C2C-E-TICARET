<?php
class Sık_Islemler
{

	public $cons;
	public $dbsql;
	private $sıkislemdbservice;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
		$sıkislemdbservice=new SıkIslemlerServices($dbsql,$cons);
		$this->sıkislemdbservice = $sıkislemdbservice;
	}

	public function __call($member, $arguments) 
	{
		$numberOfArguments = count($arguments);

		if (method_exists($this, $function = $member.$numberOfArguments)) {
			call_user_func_array(array($this, $function), $arguments);
		}
	}
	
	public function Kategori_listele($urun_id=null,$Content,$durum=0,$id="select1")
	{
		// code...
		?>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?><span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<select name="kategori_id" id="<?php echo $id; ?>" class='select2_multiple form-control'>
					<?php
					if ($durum==0)
						{ ?>


							<option>Bir Kategori Seçiniz...</option>

							<?php
						}

						else if($durum==3)
						{

							?>
							<option>Tüm Kategoriler</option>
							<?php

						}
						else
							{ ?>
								<option value="0">Genel</option>
							<?php }

							?>

							<?php 
							$arraylistkategori=array();
							$arraylistkategori=new ArrayList($arraylistkategori);
							$arraylistkategori=$this->sıkislemdbservice->kategorilistele();
							$arraylistkategori=$arraylistkategori->toArray();
							foreach ($arraylistkategori as $kategorim)
							{
								$kategori_id=$kategorim->get_kategori_id();  
								?>

								<option <?php if ($kategori_id==$urun_id) { echo "selected='select'"; } ?> value="<?php echo $kategorim->get_kategori_id(); ?>"><?php echo $kategorim->get_kategori_ad(); ?></option>
							<?php } ?>

						</select>
					</div>
				</div>
				<?php 
			}
/*
	public function Alt_Kategori_listele()
	{
		// code...
		?>
		<select name="alt_kategori_id" id="select2" class='select2_multiple form-control'>
			<option value="0">Bir Alt Kategori Seçiniz...</option>
			<?php 
			$kategorisor=$dbsql->wread("alt_kategori","kategori_id",4);

			while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

				$alt_kategori=$cons->Alt_kategori_ekle($kategoricek);
				?>

				<option value="<?php echo $alt_kategori->get_alt_kategori_id(); ?>"><?php echo $alt_kategori->get_alt_kategori_ad(); ?></option>
			<?php } ?>

		</select>
		<?php 
	}

	*/

	public function Alt_Kategori_listele($urun_id2=null,$beden_kategori_id,$Content)
	{
		// code...
		?>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<select name="alt_kategori_id" id="select2"  class='select2_multiple form-control' > 
				<option value="0">Bir Alt Kategori Seçiniz...</option>
				<?php
				$arraylistaltkategori=array();
				$arraylistaltkategori=new ArrayList($arraylistaltkategori);
				$arraylistaltkategori=$this->sıkislemdbservice->AltktegoriListele($beden_kategori_id);
				$arraylistaltkategori=$arraylistaltkategori->toArray();
				foreach ($arraylistaltkategori as $alt_kategori)
				{
					$kategori_id=$alt_kategori->get_alt_kategori_id();  
					?>

					<option <?php if ($kategori_id==$urun_id2) { echo "selected='select'"; } ?> value="<?php echo $alt_kategori->get_alt_kategori_id(); ?>"><?php echo $alt_kategori->get_alt_kategori_ad(); ?></option>
				<?php } ?>




			</select>

		</div>
	</div>
	<?php 
}

public function Alt_Kategori__detay_listele($urun_id2=null,$beden_kategori_id,$Content)
{
		// code...
	?>

	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<select name="alt_kategori_detay_id"  id="select3"  class='select2_multiple form-control'>
			<option value="0">Bir Alt Kategori Detay Seçiniz...</option>
			<?php
			$arraylistaltkategoridetay=array();
			$arraylistaltkategoridetay=new ArrayList($arraylistaltkategoridetay);
			$arraylistaltkategoridetay=$this->sıkislemdbservice->AltktegoriDetayListele($beden_kategori_id);
			$arraylistaltkategoridetay=$arraylistaltkategoridetay->toArray();
			foreach ($arraylistaltkategoridetay as $alt_kategori_detay)
			{
				$kategori_id=$alt_kategori_detay->get_alt_kategori_detay_id();  
				?>

				<option <?php if ($kategori_id==$urun_id2) { echo "selected='select'"; } ?> value="<?php echo $alt_kategori_detay->get_alt_kategori_detay_id(); ?>"><?php echo $alt_kategori_detay->get_alt_kategori_detay_ad(); ?></option>
			<?php } ?>

		</select>

	</div>
</div>
<?php 
}

public function Renkleri_listele($id="renk",$name="renk_id",$style=null,$renk_id=null)
{ ?>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"style="<?php echo $style; ?>">Renk Seç<span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-6">


			<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='select2_multiple form-control' style="margin-top: 6px;">
				<option>Tüm Renkler</option>
				<?php 
				$arraylistrenk=array();
				$renklist=new ArrayList($arraylistrenk);
				$renklist=$this->sıkislemdbservice->renkleriListele();
				$renklist=$renklist->toArray();
				foreach ($renklist as $renklerim)
				{
					?>

					<option <?php if ($renklerim->get_renk_id()==$renk_id) { echo "selected"; } ?> value="<?php echo $renklerim->get_renk_id(); ?>"><?php echo $renklerim->get_renk_adi(); ?></option>
				<?php } ?>


			</select>
		</div>
	</div>
	<?php
}

public function Beden_listele($name="",$id="beden",$style=null,$beden_id=null)
{ ?>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" id="icerik"  style="<?php echo $style; ?>">Beden Seç<span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-6">

			<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='select2_multiple form-control' style="margin-top: 6px;">
				<option>Tüm Bedenler</option>
				<?php 
				$arraylistbeden=array();
				$bedenlist=new ArrayList($arraylistbeden);
				$bedenlist=$this->sıkislemdbservice->bedenleriListele();
				$bedenlist=$bedenlist->toArray();
				foreach ($bedenlist as $bedenler)
				{
					?>

					<option <?php if ($bedenler->get_beden_id()==$beden_id) { echo "selected"; } ?> value="<?php echo $bedenler->get_beden_id(); ?>"><?php echo $bedenler->get_beden_icerik(); ?></option>
				<?php } ?>


			</select>
		</div>
	</div>

	<?php
}

public function Marka_listele1()
{ ?>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marka Seç<span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-6">

			<select name="marka_id" id="marka" class='select2_multiple form-control' style="margin-top: 6px;">
				<option value=""></option>

			</select>

		</div>
	</div>
	<?php
}

public function Marka_listele2($kategoriid,$marka_id)
{ ?>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marka Seç<span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<select name="marka_id" id="marka" class='select2_multiple form-control'>

				<?php
				$arraylistmarka=array();
				$markalist=new ArrayList($arraylistmarka);
				$markalist=$this->sıkislemdbservice->MarkalariListele($kategoriid);
				$markalist=$markalist->toArray();
				foreach ($markalist as $markalar)
				{
					?>

					<option <?php if ($markalar->get_marka_id()==$marka_id) { echo "selected"; } ?> value="<?php echo $markalar->get_marka_id() ?>"><?php echo $markalar->get_marka_adi() ?></option>

				<?php } ?>
			</select>

		</div>
	</div>
	<?php
}

public function Hesap_Listele($hesapsor)
{
	// code...
	?>
	<div class="form-group">
		<div class="col-md-10 col-sm-6 col-xs-12">
			<select name="hesap_id" id="select1" class='select2_multiple form-control'>
				<option>Hesap Seçiniz...</option>
				<?php
				$arraylisthesap=array();
				$hesaplist=new ArrayList($arraylisthesap);
				$hesaplist=$this->sıkislemdbservice->HesaplariListele($hesapsor);
				$hesaplist=$hesaplist->toArray();
				foreach ($hesaplist as $hesaplarim)
				{
					if ($hesaplarim->get_durum()==1)
					{
						?>
						<option value="<?php echo $hesaplarim->get_hesap_id() ?>"><?php echo $hesaplarim->get_hesap_adi()." (".$hesaplarim->get_hesap_iban().")"; ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>
	<?php
}

public function cart()
{	

	$sepetsor=$this->sıkislemdbservice->sepeturungetir();

	$sepetsay=$sepetsor->rowCount();

	?>
	<div class="cart-area">
		<a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span><?php echo $sepetsay; ?></span></a>
		<ul>
			<?php 
			$toplam=0;
			while ($sepetcek=$this->sıkislemdbservice->vericek($sepetsor)) {
				$sepetlerim=$this->cons->Sepet_ekle($sepetcek);
				$urunlerim=$this->cons->Urun_ekle($sepetcek);
				$beden="";
				$arraylistrenk=array();
				$renklist=new ArrayList($arraylistrenk);
				$renkliste=$this->sıkislemdbservice->Renkleri_getir($urunlerim->get_renk_id());
				$renkliste=$renkliste->toArray();
				foreach ($renkliste as $renklerim) 
				{
					$renk=$renklerim->get_renk_adi();
				}

				$urunadsor=$this->sıkislemdbservice->urunozellikgetir($sepetlerim->get_urun_id());

				$say=$urunadsor->rowCount();
				while($urunadcek=$this->sıkislemdbservice->vericek($urunadsor)) {

					$urunlerim=$this->cons->Urun_ekle($urunadcek);
					$ozellik_detaylarim=$this->cons->Ozellik_Detay_ekle($urunadcek);
					$ozellik_detay_iceriklerim=$this->cons->Ozellik_Detay_Icerik_ekle($urunadcek);
					$detaylarim=$ozellik_detaylarim->get_ozellik_detay();


					if (isset($detaylarim))
						$kapasite=$detaylarim." GB ";

				}
				if ($say==0)
					$kapasite="";
				$arraylistbeden=array();
				$bedenlist=new ArrayList($arraylistbeden);
				$bedenlist=$this->sıkislemdbservice->Bedenleri_getir($urunlerim->get_beden_id());
				$bedenlist=$bedenlist->toArray();
				foreach ($bedenlist as $bedenlerim) 
				{
					$beden=$bedenlerim->get_beden_icerik();


				}

				if ($urunlerim->get_beden_id() != 0) { ?>
					<p><b>Beden:</b><?php echo $beden; ?></p>
				<?php }

				$arraylistmarka=array();
				$markalist=new ArrayList($arraylistmarka);
				$markalist=$this->sıkislemdbservice->Markalari_getir($urunlerim->get_marka_id());
				$markalist=$markalist->toArray();
				foreach ($markalist as $markalarim)
				{
					$marka=$markalarim->get_marka_adi(); 

				}

				?>
				<li>
					<div class="cart-single-product">
						<div class="media">
							<div class="pull-left cart-product-img">
								<a href="">
									<img class="img-responsive" alt="product" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>">
								</a>
							</div>
							<div class="media-body cart-content">
								<ul>
									<li>
										<h1><a href="#"><?php echo " ".$marka." ".$urunlerim->get_urun_ad()." ".$kapasite." ".$renk." ".$beden." ".$urunlerim->get_barkod_no(); ?></a></h1>
									</li>
									<li>
										<?php echo $sepetlerim->get_urun_adet() ?> X 
										<?php echo number_format($urunlerim->get_urun_fiyat(), 2, ',', '.')." T.L."; ?>=
										<?php echo number_format($sepetlerim->get_urun_adet() * $urunlerim->get_urun_fiyat(), 2, ',', '.')." T.L."; ?>
									</li>
									<li style="float: right;">
										<a class="trash" href="" id="<?php echo $sepetlerim->get_sepet_id() ?>"><i class="fa fa-trash-o"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</li>
				<?php  $toplam+=$sepetlerim->get_urun_adet() * $urunlerim->get_urun_fiyat();  ?>
			<?php } ?>                                            
			<li>
				<table class="table table-bordered sub-total-area" id="total">
					<tbody>
						<tr>
							<td>Genel Toplam</td>
							<td><?php echo "<b>".number_format($toplam, 2, ',', '.')." T.L."."</b>"; ?></td>
						</tr>                                     
					</tbody>
				</table>
			</li>
			<li>
				<form method="post" action="nedmin/netting/kullanici.php">
					<ul class="cart-checkout-btn">
						<li><a href="cart.php" class="btn-find"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Sepete Git</a></li>
						<li><button class="btn-find"  name="sepetsiparis"type="submit" value="Login"><i class="fa fa-share" aria-hidden="true"></i>ALIŞVERİŞİ TAMAMLA</button></li>
					</ul>
				</form>
			</li>
		</ul>
	</div>
	<?php
}

public function kategori_listesi($islem=null)
{
	?>
	<ul>
		<?php 
		if ($islem != null)
		{
			$this->cart();
			if (isset($_SESSION['userkullanici_mail'])) {?>
				<li class="active"><a href="hesabim">Hesap Bilgilerim</a></li>

			<?php }
			else { ?>

				<li ><a href="login">Üye Giriş</a></li>
				<li ><a href="register">Üye Kayıt</a></li>


			<?php } 
		}


		
		$arraylistkategori=array();
		$kategorilist=new ArrayList($arraylistkategori);
		$kategorilist=$this->sıkislemdbservice->kategori_listesi();
		$kategorilist=$kategorilist->toArray();
		foreach ($kategorilist as $kategorilerim)
		{


			?>
			<li>
				<?php if ($kategorilerim->get_kategori_durum()=="1") {?>
					<a href="kategoriler-<?=seo($kategorilerim->get_kategori_ad())."-".$kategorilerim->get_kategori_id() ?>"><?php echo $kategorilerim->get_kategori_ad() ?></a>
				<?php }?>
				<ul class="mega-menu-area" style="width: 100rem; height: 640px;">

					<?php

					$arraylistaltkategori=array();
					$kategorialtlist=new ArrayList($arraylistaltkategori);
					$kategorialtlist=$this->sıkislemdbservice->alt_kategori_listesi($kategorilerim->get_kategori_id());
					$kategorialtlist=$kategorialtlist->toArray();
					foreach ($kategorialtlist as $altkategorilerim)
					{
						?>


						<li style="float: left;">


							<?php if ($altkategorilerim->get_alt_kategori_durum()=="1") {

								?>  
								<a href="altkategoriler-<?=seo($altkategorilerim->get_alt_kategori_ad())."-".$altkategorilerim->get_alt_kategori_id() ?>"><strong><?php echo $altkategorilerim->get_alt_kategori_ad() ?></strong>
								</a>



								<?php
								$arraylistaltkategoridetay=array();
								$kategorialtdetaylist=new ArrayList($arraylistaltkategoridetay);
								$kategorialtdetaylist=$this->sıkislemdbservice->alt_kategori_detay_listesi($altkategorilerim->get_alt_kategori_id());
								$kategorialtdetaylist=$kategorialtdetaylist->toArray();
								foreach ($kategorialtdetaylist as $altkategoridetaylarim)
								{
									?>


									<?php if ($altkategoridetaylarim->get_alt_kategori_detay_durum()=="1") {?>  
										<a href="altkategoridetay-<?=seo($altkategoridetaylarim->get_alt_kategori_detay_ad())."-".$altkategoridetaylarim->get_alt_kategori_detay_id() ?>"><?php echo $altkategoridetaylarim->get_alt_kategori_detay_ad() ?>
									</a>

								<?php }?>    

							<?php }?>

						<?php } ?>

					</li>

				<?php } ?>

			</ul>

		</li>

	<?php } ?>
</ul>
<?php
}

public function kategori_onecikanlar($uruncek)
{

	$urunlerim=$this->cons->Urun_ekle($uruncek);
	$kategorilerim=$this->cons->Kategori_ekle($uruncek);
	$kullanicilarim=$this->cons->Kullanici_ekle($uruncek);
	?>


	<!-- Çok Satanlar Start -->
	<div class="single-item-grid">
		<div class="item-img">
			<a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>"><img style="width: 451px; height: 385px;" src="<?php echo $urunlerim->get_urunfoto_resimyol() ?>" alt="product" class="img-responsive"></a>
			<div class="trending-sign" data-tips="Vitrin Ürün"><i class="fa fa-bolt" aria-hidden="true"></i></div>
		</div>
		<div class="item-content" style="word-wrap:break-word;">
			<div class="item-info">
				<h3><a href="urun-<?=seo($urunlerim->get_urun_ad())."-".$urunlerim->get_urun_id() ?>""> 


					<?php
					$arraylistrenk=array();
					$renklist=new ArrayList($arraylistrenk);
					$renkliste=$this->sıkislemdbservice->Renkleri_getir($urunlerim->get_renk_id());
					$renkliste=$renkliste->toArray();
					foreach ($renkliste as $renklerim) 
					{
						$renk=$renklerim->get_renk_adi();

					}?>


					<?php
					$urunadsor=$this->sıkislemdbservice->urunozellikgetir($urunlerim->get_urun_id());

					$say=$urunadsor->rowCount();
					while($urunadcek=$urunadsor->fetch(PDO::FETCH_ASSOC)) {
						$urunlerim=$this->cons->Urun_ekle($urunadcek);
						$ozellik_detaylarim=$this->cons->Ozellik_Detay_ekle($urunadcek);
						$ozellik_detay_iceriklerim=$this->cons->Ozellik_Detay_Icerik_ekle($urunadcek);
						$detaylarim=$ozellik_detaylarim->get_ozellik_detay();

						if (isset($detaylarim))
							$kapasite=$detaylarim." GB ";

					}
					if ($say==0)
						$kapasite="";


					?>


					<?php 
					$markasor=$this->dbsql->wread("marka","marka_id",$urunlerim->get_marka_id());
					while($markacek=$markasor->fetch(PDO::FETCH_ASSOC)) { 
						$markalarim=$this->cons->Marka_ekle($markacek);
						?>
						<strong>
							<?php echo $markalarim->get_marka_adi(); 

							?>
						</strong>
						<?php
						$yazi=$urunlerim->get_urun_ad();
						$detay = $yazi;
                                                    //Var olan metin içindeki karakter sayısı
						$uzunluk = strlen($detay);
                                                    //Kaç Karakter Göstermek İstiyorsunuz
						$limit = 48;
                                                    //Uzun olan yer "devamı..." ile değişecek.
						if ($uzunluk > $limit) {
							$detay = substr($detay,0,$limit);
							echo " ".$detay." ".$kapasite." ".$renk."...<br>";
						}           
						else

							echo " ".$detay." ".$kapasite." ".$renk."<br>"; ?>
					</a></h3>
				<?php } ?>
				<span><a href="kategoriler-<?=seo($kategorilerim->get_kategori_ad())."-".$kategorilerim->get_kategori_id() ?>"><?php echo $kategorilerim->get_kategori_ad() ?></a></span>
				<div class="price" style="float: left;">
					<br>
					<br>
					<br>
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

								<div style="float: left;height: 0.1px;padding-bottom: 25px;"><?php echo "<br><br>   ".$tl_formati; ?> TL </div>
							<?php }
							?> 



						</div>
					</div>
					<div class="item-profile">
						<div class="profile-title">

							<div class="img-wrapper"><img style="width: 38px; height: 38px;" src="<?php echo $kullanicilarim->get_kullanici_magazafoto() ?>" alt="profile" class="img-responsive img-circle"></div>
							<span><a href="satici-<?=seo($kullanicilarim->get_kullanici_ad()."-".$kullanicilarim->get_kullanici_soyad())."-".$kullanicilarim->get_kullanici_id() ?>"><b><?php echo $kullanicilarim->get_magaza_adi(); ?></b></a></span>

						</div>
						<div class="profile-rating">

                           <!-- <ul>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> 05</span> )</li>
                            </ul>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Çok Satanlar Finish -->
            <?php
        }
    }

?>