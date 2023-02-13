<?php
/**
 * 
 */
class On_panel_Form
{

	private $cons;
	private $dbsql;
	private $onpaneldbservice;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
		$onpaneldbservice=new OnPanelService($dbsql,$cons);
		$this->onpaneldbservice = $onpaneldbservice;
	}

	public function __call($member, $arguments) 
	{
		$numberOfArguments = count($arguments);

		if (method_exists($this, $function = $member.$numberOfArguments)) {
			call_user_func_array(array($this, $function), $arguments);
		}
	}

	public function Durum_cek()
	{
		if (htmlspecialchars($_GET['durum'])=="hata") {?>

			<div class="alert alert-danger">
				<strong>Hata!</strong> İşlem Başarısı
			</div>                   

		<?php } else if (htmlspecialchars($_GET['durum'])=="ok")   {?>

			<div class="alert alert-success">
				<strong>Bilgi!</strong> Kayıt Başarılı
			</div>                   

		<?php }
	}

	public function Durum_cek2($value=[],$text=[],$key=[])
	{
		for ($i=0; $i <count($value) ; $i++) { 
			// code...
			if (htmlspecialchars($_GET['durum'])==$value[$i])
			{ 
				if ($i==0)
				{
					?>
					<div class="alert alert-danger">
						<strong><?php echo $key[$i]; ?></strong> <?php echo $text[$i]; ?>
					</div>    
					<?php
				}
				else
				{
					?>
					<div class="alert alert-success">
						<strong><?php echo $key[$i]; ?></strong> <?php echo $text[$i]; ?>
					</div>       
					<?php
				}
			}
		}
	}

	public function Durum_liste($value=[],$text=[],$key=[],$button_types=[])
	{
		for ($i=0; $i <count($value) ; $i++) 
		{ 
			if (htmlspecialchars($_GET['durum'])==$value[$i])
			{ 
				?>
				<div class="alert alert-<?php echo $button_types[$i] ?>">
					<strong><?php echo $key[$i]; ?></strong> <?php echo $text[$i]; ?>
				</div>       
				<?php
			}
		}
	}

	public function SirketType($kullanici_tip,$form_id="sirket_turu",$name="kullanici_tip",$id="kullanici_tip",$Content="ŞİRKET TÜRÜ")
	{
		?>
		<div class="form-group" id="<?php echo $form_id; ?>">
			<label class="col-sm-3 control-label"> <?php echo $Content; ?> </label>
			<div class="col-sm-9">
				<div class="custom-select">
					<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='select2'>

						<option value="PERSONAL">

							<?php 

							if ($kullanici_tip=="PERSONAL") {
								echo "selected";
							}
							?>

						Şahıs Şirketi</option>


						<option value="PRIVATE_COMPANY">  <?php 

						if ($kullanici_tip=="PRIVATE_COMPANY") {
							echo "selected";
						}
					?> Limited Şirket</option>


					<option value="INCORPORATED_COMPANY">  <?php 

					if ($kullanici_tip=="INCORPORATED_COMPANY") {
						echo "selected";
					}
				?> Anonim Şirket</option>

			</select>
		</div>
	</div>
</div>
<?php
}

public function TextBox($name,$value,$Content,$required=false,$durum=null,$placeholder=null)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<input class="form-control"  <?php if ($required==true) { ?> required="" <?php } ?> <?php if ($durum!=null) {  echo $durum; } ?> name="<?php echo $name; ?>" placeholder="<?php echo $placeholder; ?>"  id="first-name" value="<?php echo $value; ?>" type="text">
		</div>
	</div>
	<?php
}

public function TextArea($name,$value,$Content,$durum=null,$placeholder=null,$class="form-control",$required=false)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">

			<textarea  class="<?php echo $class; ?>" <?php if ($required==true) {?> required="required" <?php } ?> id="editor1" name="<?php echo $name; ?>" minlength="3"><?php echo $value; ?></textarea>
		</div>
	</div>
	<?php
}

public function PasswordText($name,$value,$Content,$placeholder)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<input type="password" class="form-control" id="first-name" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>">
		</div>
	</div>
	<?php
}

public function MultiText($type,$name,$Content,$value,$placeholder=null)
{
	?>
	<div class="form-group">
		<label class="control-label" for="first-name"><?php echo $Content; ?> </label>
		<input type="<?php echo $type; ?>" id="first-name" required="" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" class="form-control">
	</div>
	<?php
}

public function FileChooser($name,$Content,$required=true)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<input type="file" class="form-control" <?php if ($required==true) { echo "required"; } ?> id="first-name" name="<?php echo $name; ?>"  >
		</div>
	</div>
	<?php
}


public function Button($class,$name,$id,$Content,$confirm=null)
{
	?>
	<div class="form-group">

		<div align="right" class="col-sm-12">
			<button <?php if ($confirm!=null){ ?> onclick="return confirm('<?php echo $confirm; ?>')" <?php } ?> class="<?php echo $class; ?>" name="<?php echo $name; ?>" id="<?php echo $id; ?>"><?php echo $Content; ?></button>

		</div>
	</div>  
	<?php
}

public function JustButton($class,$id,$Content)
{
	?>
	<button class="<?php echo $class; ?>" id="<?php echo $id; ?>" type="button"><?php echo html_entity_decode($Content); ?></button>
	<?php
}

public function Kategori_listele($kategoriid=null)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Kategori</label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="kategori_id" id="select1" class='select2'>
					<option>Bir Kategori Seçiniz...</option>
					<?php 
					$arraylistkategori=array();
					$arraylistkategori=new ArrayList($arraylistkategori);
					$arraylistkategori=$this->onpaneldbservice->kategorilistele();
					$arraylistkategori=$arraylistkategori->toArray();
					foreach ($arraylistkategori as $kategorilerim)
					{
						?>
						<option <?php if ($kategorilerim->get_kategori_id()==$kategoriid) { echo "selected"; } ?> value="<?php echo $kategorilerim->get_kategori_id() ?>"><?php echo $kategorilerim->get_kategori_ad() ?></option>

					<?php } ?>

				</select>
			</div>
		</div>
	</div>
	<?php
}

public function Alt_Kategori_Listele($name,$Content,$alt_kategori_id=null,$kategori_id=null)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="select2"  class='select2' >  
					<?php
					$arraylistaltkategori=array();
					$arraylistaltkategori=new ArrayList($arraylistaltkategori);
					$arraylistaltkategori=$this->onpaneldbservice->AltktegoriListele($alt_kategori_id);
					$arraylistaltkategori=$arraylistaltkategori->toArray();
					foreach ($arraylistaltkategori as $altkategorilerim)
					{
						?>

						<option <?php if ($altkategorilerim->get_alt_kategori_id()==$alt_kategori_id) { echo "selected"; } ?> value="<?php echo $altkategorilerim->get_alt_kategori_id(); ?>"><?php echo $altkategorilerim->get_alt_kategori_ad(); ?></option>

					<?php } ?>

				</select>
			</div>
		</div>
	</div>
	<?php
}

public function Alt_Kategori_Detay_Listele($name,$Content,$alt_kategori_detay_id=null,$alt_kategori_id=null)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="select3"  class='select2' >  
					<?php
					$arraylistaltkategoridetay=array();
					$arraylistaltkategoridetay=new ArrayList($arraylistaltkategoridetay);
					$arraylistaltkategoridetay=$this->onpaneldbservice->AltktegoriDetayListele($beden_kategori_id);
					$arraylistaltkategoridetay=$arraylistaltkategoridetay->toArray();
					foreach ($arraylistaltkategoridetay as $alt_kategori_detay)
					{
						?>

						<option <?php if ($altkategoridetaylarim->get_alt_kategori_detay_id()==$alt_kategori_detay_id) { echo "selected"; } ?> value="<?php echo $altkategoridetaylarim->get_alt_kategori_detay_id() ?>"><?php echo $altkategoridetaylarim->get_alt_kategori_detay_ad(); ?></option>

					<?php } ?>

				</select>
			</div>
		</div>
	</div>
	<?php
}

public function Marka_Listele($name,$id,$class,$Content,$kategoriid=null,$marka_id=null)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='<?php echo $class; ?>'>
					<?php
					$arraylistmarka=array();
					$markalist=new ArrayList($arraylistmarka);
					$markalist=$this->onpaneldbservice->MarkalariListele($kategoriid);
					$markalist=$markalist->toArray();
					foreach ($markalist as $markalar)
					{
						?>

						<option <?php if ($markalar->get_marka_id()==$marka_id) { echo "selected"; } ?> value="<?php echo $markalar->get_marka_id() ?>"><?php echo $markalar->get_marka_adi() ?></option>

					<?php } ?>

				</select>
			</div>
		</div>
	</div>
	<?php
}

public function Renkleri_listele($renk_id=null,$name='renk_id',$id="renk",$class="select2",$Content="Renk")
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='<?php echo $class; ?>'>
					<option>Bir Renk Seçiniz...</option>
					<?php 
					$arraylistrenk=array();
					$renklist=new ArrayList($arraylistrenk);
					$renklist=$this->onpaneldbservice->renkleriListele();
					$renklist=$renklist->toArray();
					foreach ($renklist as $renklerim)
					{

						?>

						<option <?php if ($renklerim->get_renk_id()==$renk_id) { echo "selected"; } ?> value="<?php echo $renklerim->get_renk_id(); ?>"><?php echo $renklerim->get_renk_adi(); ?></option>
					<?php } ?>

				</select>
			</div>
		</div>
	</div>
	<?php
}

public function Beden_listele($beden_id=null,$fid="icerik",$name="beden_id",$id="beden",$class="select2",$Content="Beden Seç")
{
	?>
	<div class="form-group" id="<?php echo $fid; ?>">
		<label class="col-sm-3 control-label" ><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='<?php echo $class; ?>'>
					<option>Bir Beden Seçiniz...</option>
					<?php 
					$arraylistbeden=array();
					$bedenlist=new ArrayList($arraylistbeden);
					$bedenlist=$this->onpaneldbservice->bedenleriListele();
					$bedenlist=$bedenlist->toArray();
					foreach ($bedenlist as $bedenler)
					{

						?>

						<option <?php if ($bedenler->get_beden_id()==$beden_id) { echo "selected"; } ?> value="<?php echo $bedenler->get_beden_id(); ?>"><?php echo $bedenler->get_beden_icerik(); ?></option>
					<?php } ?>


				</select>
			</div>
		</div>
	</div>

	<?php
}

public function Button_Href($Content,$href,$type,$confirm=null)
{
	if ($href==null)
	{
		?>
		<button class="btn btn-<?php echo $type; ?> btn-xs"><?php echo $Content; ?></button>
		<?php
	}
	else
	{
		?>
		<a <?php if ($confirm !=null) { ?> onclick="return confirm('<?php echo $confirm; ?>')" <?php } ?> href="<?php echo $href; ?>"><button class="btn btn-<?php echo $type; ?> btn-xs"><?php echo $Content; ?></button></a>
		<?php
	}
}

public function ComboBox($options=[],$text,$Content,$name,$id)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"> <?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='select2'>
					<option> <?php echo $text; ?></option>
					<?php 
					for ($i=0; $i < count($options); $i++) { 
							// code...
						?>
						<option value="<?php echo $options[$i]; ?>"><?php echo $options[$i]; ?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<?php
}

public function ComboBoxValue($options=[],$name,$value=[],$gelen,$Content)
{
	?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $Content; ?></label>
		<div class="col-sm-9">
			<div class="custom-select">
				<select name="<?php echo $name; ?>" id="select1" class='select2'>
					<?php

					for ($i=0; $i < count($options); $i++) { 
							// code...
						?>
						<option value="<?php echo $value[$i]; ?>"<?php echo  $gelen== $value[$i] ? 'selected=""' : ''; ?>><?php echo $options[$i]; ?></option>
						<?php
					}

					?>

				</select>
			</div>
		</div>
	</div>
	<?php
}
}
?>