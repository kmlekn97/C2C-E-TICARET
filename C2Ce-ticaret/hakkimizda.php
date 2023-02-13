
<?php 

require_once 'header.php'; 

islemanakontrol();
$hakkimizda_data=$dbservice->hakkimizdaListele();

?>



<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">

		</div>
	</div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
	<div class="container">


		<div class="row settings-wrapper">

			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

				<center><i><h2>Hakkımızda Sayfası</h2></i></center>

				<div class="title-bg">
					<div class="title"><b>Tanıtım Videosu</b></div>
				</div>
				<p>
					<iframe width="750" height="400" src="https://www.youtube.com/embed/<?php echo $hakkimizda_data->get_hakkimizda_video(); ?>" frameborder="0" allowfullscreen></iframe></p>
					<br>
					<br>

					<div class="title-bg">
						<div class="title"><b>Misyon</b></div>
					</div>
					<br>

					<blockquote><p><i><h5><?php echo $hakkimizda_data->get_hakkimizda_misyon(); ?></h5></i></p></blockquote>
					<br>
					<br>


					<div class="title-bg">
						<div class="title"><b>Vizyon</b></div>
					</div>
					<br>
					<blockquote><p><i><h5><?php echo $hakkimizda_data->get_hakkimizda_vizyon(); ?></h5></i></p></blockquote>
					<br>
					<div class="title-bg">
						<div class="title"><p><i><h5><?php echo $hakkimizda_data->get_hakkimizda_baslik(); ?></h5></i></p></div>
					</div>
					<br>
					<br>
					<div class="page-content">
						<p>
							<i><h5><?php echo html_entity_decode($hakkimizda_data->get_hakkimizda_icerik()); ?></h5></i>
						</p>

					</div>

				</div>  
			</div>  
		</div>  
	</div> 
	<!-- Settings Page End Here -->
	<?php require_once 'footer.php'; ?>