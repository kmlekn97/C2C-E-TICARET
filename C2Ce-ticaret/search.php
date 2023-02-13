<?php 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");

}
?>


<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <p>Aradığınız ürün yada hizmetin adını giriniz...</p>

            <form action="arama-detay" method="POST">
                <div class="banner-search-area input-group">
                    <input class="form-control" required="" minlength="3" name="searchkeyword" id="search" placeholder="Ne aramıştınız . . ." type="text">
                     <div style="margin-top: 5rem;">

                       <div class="kelimeler">

                       </div>
                   </div>
                    <span class="input-group-addon">
                       <button type="submit" name="searchsayfa">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Banner 1 Area End Here --> 

<script src="js\jquery-search.js" type="text/javascript"></script>