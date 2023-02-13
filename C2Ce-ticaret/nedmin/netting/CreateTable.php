<?php
/**
  * 
  */
class CreateTable
{

	private $data=array();
	private $rdata=array();
	private $width;
	private $class;

	public function addcolumn($title,$index)
	{
		$this->data[$index]=$title;
	}

	public function TableBaslik()
	{
		?>
		<thead>
			<tr>
				<?php 

				for ($i=0; $i < count($this->data); $i++) { 
						// code...
					?>
					<th><?php echo $this->data[$i]; ?></th>

					<?php
				}

				?>
			</tr>
		</thead>

		<?php
	}

	public function addRow($icerik,$index,$width=null,$class=null)
	{
		$this->width=$width; 
		$this->class=$class; 
		?>
		<td width="<?php echo $this->width; ?>" class="<?php echo $this->class; ?>"><?php echo $icerik; ?></td>
		<?php
	}

	public function AddDurum($icerik,$index)
	{
		// code...
		?>
		<td>
			<center><?php 

			if ($icerik==1) {?>

				<button class="btn btn-success btn-xs">Aktif</button>

			<?php } else {?>

				<button class="btn btn-danger btn-xs">Pasif</button>


			<?php } ?>
		</center>
	</td>
	<?php
}

public function AddButton($href,$index,$icerik,$type,$confirm=null)
{?>
	<td>
		<center><a href="<?php echo $href; ?>" ><button  <?php if ($index==-1) { ?> disabled <?php } if ($confirm != null) {?> onclick="return confirm('<?php echo $confirm; ?>')" <?php } ?> class="btn btn-<?php echo $type; ?> btn-xs"><?php echo $icerik; ?></button></a></center>
	</td>
	<?php 
}


public function AddSirkettur($yetki,$tip,$kullanici_ad,$kullanici_soyad)
{?>
	<td><?php 
	if ($yetki==5)
	{
		echo "(Admin) "; 
		echo  $kullanici_ad; 
		echo " ";
		echo $kullanici_soyad;
	}  else if($tip=="LIMITED_OR_JOINT_STOCK_COMPANY") 
	{ echo "(Site) "; 
	echo  $kullanici_ad; 
	echo " "; 
	echo $kullanici_soyad;
} else
{ 
	echo $kullanici_ad; 
	echo " "; 
	echo $kullanici_soyad;
}  ?>
</td>
<?php
}

public function Sirkettype($kullanici_tip,$kullanici_magaza)
{?>
	<td><center><?php 

	if ($kullanici_tip=="PERSONAL") {

		if ($kullanici_magaza==0) {?>

			<button class="btn btn-success btn-xs">Alıcı</button>

		<?php }  else { ?>

			<button class="btn btn-success btn-xs">Bireysel Satıcı</button>

		<?php }?>

	<?php }
	else  if ($kullanici_tip=="LIMITED_OR_JOINT_STOCK_COMPANY") {?>


		<button class="btn btn-success btn-xs">Şirket Çalışanı</button>


	<?php }

	else  if ($kullanici_tip=="PRIVATE_COMPANY") {?>


		<button class="btn btn-success btn-xs">Satıcı(L.T.D.)</button>


	<?php }

	else  if ($kullanici_tip=="INCORPORATED_COMPANY") {?>


		<button class="btn btn-success btn-xs">Satıcı(A.Ş.)</button>

	<?php }


	else  if ($kullanici_tip=="OWNER") {?>


		<button class="btn btn-success btn-xs">Sahibi</button>

	<?php }

	else{ ?>


		<button class="btn btn-success btn-xs">Teknik Site Çalışanı</button>

	<?php }?>

</center>


</td>
<?php
}
} 
?>