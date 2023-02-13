 <?php 
 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");

}

  ?>

 <ul class="profile-title">

            <li><a href="#Products" data-toggle="tab" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i> Ürünleri ( 

                <?php 

                echo $dbservice->sidebarurunsayisiHesapla($kullanicicek['kullanici_id']);

                ?>

            )</a></li>
           <!-- <li><a href="#Message" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Menü Adı</a></li>-->


        </ul>