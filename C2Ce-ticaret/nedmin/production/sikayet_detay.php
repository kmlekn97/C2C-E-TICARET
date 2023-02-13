<?php 

include 'header.php'; 

$sikayetsor=$dbsql->qwSql("SELECT sikayet.*,kullanici.* FROM sikayet INNER JOIN kullanici ON sikayet.kullanici_id=kullanici.kullanici_id",array(
  'sikayet_id' => htmlspecialchars($_GET['sikayet_id'])
));
$sikayetcek=$sikayetsor->fetch(PDO::FETCH_ASSOC);

$sikayetler=$admindbservices->SikayetDetay();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Şikayet Detay <small>

             <?php $form->Durum_cek(); ?>

            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->



            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şikayet Nedeni: <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo htmlspecialchars_decode($sikayetler->get_sikayet_nedeni());?>
              </div>
            </div>




          </div>
        </div>
      </div>
    </div>



    <hr>
    <hr>
    <hr>



  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
