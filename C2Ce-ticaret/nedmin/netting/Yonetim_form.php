<?php
/**
 * 
 */
require_once '../netting/Sık_Islemler.php';
class Yonetim_form
{	
	public function __call($member, $arguments) 
	{
		$numberOfArguments = count($arguments);

		if (method_exists($this, $function = $member.$numberOfArguments)) {
			call_user_func_array(array($this, $function), $arguments);
		}
	}
	public function Durum_cek1()
	{

		if (htmlspecialchars($_GET['durum'])=="ok") {?>

			<b style="color:green;">İşlem Başarılı...</b>

		<?php } elseif (htmlspecialchars($_GET['durum'])=="no") {?>

			<b style="color:red;">İşlem Başarısız...</b>

		<?php }

	}

	public function Durum_cek2($value=[],$text=[])
	{
		for ($i=0; $i <count($value) ; $i++) { 
			// code...
			if (htmlspecialchars($_GET['durum'])==$value[$i])
			{ 
				if ($i==0)
				{
					?>
					<b style="color:green;"><?php echo $text[$i]; ?></b>
					<?php
				}
				else
				{
					?>
					<b style="color:red;"><?php echo $text[$i]; ?></b>
					<?php
				}
			}
		}
	}

	public function TextBox($name,$value,$Content,$durum=null,$placeholder=null)
	{
		// code...?>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> <?php echo $Content; ?> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="first-name" name="<?php echo $name;  ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo $value;  ?>" required="required" <?php if ($durum==true) { ?> onfocus="this.setSelectionRange(0, this.value.length)" <?php } else {echo $durum;} ?> class="form-control col-md-7 col-xs-12" autofocus>
			</div>
		</div>
		<?php
	}

	public function PasswordTextBox($name,$Content,$durum=null,$placeholder=null,$value=null)
	{
		// code...?>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="password" id="<?php echo $name;  ?>" name="<?php echo $name;  ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>"  required="required"  <?php echo $durum; ?> class="form-control col-md-7 col-xs-12">
			</div>
		</div>
		<?php
	}

	public function TextArea($name,$value,$Content,$durum=null,$placeholder=null,$class="form-control col-md-7 col-xs-12")
	{?>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?><span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">

				<textarea  class="<?php echo $class; ?>"  name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>"> <?php echo $value; ?> </textarea>
			</div>
		</div>
		<?php
	}


	public function ComboBoxDurum($name,$value,$Content)
	{
		// code...?>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?><span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select id="heard" class="form-control" name="<?php echo $name; ?>" required>


					<?php
					if ($value==null)
						{?>
							<option value="1">Aktif</option>
							<option value="0">Pasif</option>
							<?php
						}
						else
						{
							?>



							<option value="1" <?php echo $value == '1' ? 'selected=""' : ''; ?>>Aktif</option>



							<option value="0" <?php if ($value==0) { echo 'selected=""'; } ?>>Pasif</option>

						<?php } ?>

					</select>
				</div>
			</div>
			<?php
		}

		public function Button($name,$Content,$type="success")
		{?>
			<div class="form-group">
				<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<button type="submit" name="<?php echo $name; ?>" class="btn btn-<?php echo $type; ?>"><?php echo $Content; ?></button>
				</div>
			</div>
			<?php
		}

		public function Buttonhref($Content,$href,$type="success")
		{?>
			<div align="right">
				<a href="<?php echo $href; ?>"><button class="btn btn-<?php echo $type; ?> btn-xs"><?php echo $Content; ?></button></a>
			</div>
			<?php
		}
		public function Buttonhref2($Content,$href,$type="success")
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
				<a href="<?php echo $href; ?>"><button class="btn btn-<?php echo $type; ?> btn-xs"><?php echo $Content; ?></button></a>
				<?php
			}
		}

		public function ComboBox($options=[],$text,$Content,$name,$id)
		{
			?>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> <?php echo $Content; ?> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class='select2_multiple form-control'>
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
			<?php
		}

		public function ComboBoxValue($options=[],$name,$value=[],$gelen,$Content)
		{
			?>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select id="heard" class="form-control" name="<?php echo $name; ?>" required>

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
			<?php
		}

		public function FileChooser($name,$value,$Content)
		{
			?>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?><span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="file" id="first-name"  name="<?php echo $name; ?>" value="<?php echo $value; ?>"  class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<?php
		}

		public function DateTime($name,$value,$Content,$placeholder=null)
		{
			?>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $Content; ?> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="datetime-local" id="first-name" name="<?php echo $name; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" required="required" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			<?php
		}

		public function Kullanicitypeselected($kullanici_tip,$kullanici_magaza,$name,$text)
		{
			?>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $text; ?> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-6">

					<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class='select2_multiple form-control'>
						<?php
						if ($kullanici_tip=="LIMITED_OR_JOINT_STOCK_COMPANY")
							{?>
								<option>Alıcı</option>
								<option>Bireysel Satıcı</option>
								<option>Satıcı(L.T.D.)</option>
								<option>Satıcı(A.Ş.)</option>
								<option selected="">Şirket Çalışanı</option>
								<option>Teknik</option>

								<?php
							}
							else if ($kullanici_tip=="TECHNİCAL_PERSON") 
							{
								?>
								<option>Alıcı</option>
								<option>Bireysel Satıcı</option>
								<option>Satıcı(L.T.D.)</option>
								<option>Satıcı(A.Ş.)</option>
								<option>Şirket Çalışanı</option>
								<option selected="">Teknik</option>

								<?php
							}
							else if ($kullanici_tip=="PERSONAL") 
							{
								if ($kullanici_magaza==0)
								{
									?>
									<option selected="">Alıcı</option>
									<option>Bireysel Satıcı</option>
									<option>Satıcı(L.T.D.)</option>
									<option>Satıcı(A.Ş.)</option>
									<option>Şirket Çalışanı</option>
									<option>Teknik</option>

									<?php
								}
								else
									{?>
										<option>Alıcı</option>
										<option  selected="">Bireysel Satıcı</option>
										<option>Satıcı(L.T.D.)</option>
										<option>Satıcı(A.Ş.)</option>
										<option>Şirket Çalışanı</option>
										<option>Teknik</option>
										<?php
									}
								}
								else if ($kullanici_tip=="PRIVATE_COMPANY") 
								{
									?>
									<option>Alıcı</option>
									<option>Bireysel Satıcı</option>
									<option selected="">Satıcı(L.T.D.)</option>
									<option>Satıcı(A.Ş.)</option>
									<option>Şirket Çalışanı</option>
									<option>Teknik</option>

									<?php
								}

								else if ($kullanici_tip=="INCORPORATED_COMPANY") 
								{
									?>
									<option>Alıcı</option>
									<option>Bireysel Satıcı</option>
									<option>Satıcı(L.T.D.)</option>
									<option selected="">Satıcı(A.Ş.)</option>
									<option>Şirket Çalışanı</option>
									<option>Teknik</option>

									<?php
								}
								else if ($kullanici_tip=="TECHNİCAL_PERSON") 
								{
									?>
									<option>Alıcı</option>
									<option>Bireysel Satıcı</option>
									<option>Satıcı(L.T.D.)</option>
									<option>Satıcı(A.Ş.)</option>
									<option>Şirket Çalışanı</option>
									<option selected="">Teknik</option>

									<?php
								}
								?>
							</select>
						</div>
					</div>
					<?php
				}

			}
			?>