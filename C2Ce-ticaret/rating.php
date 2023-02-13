
<?php

switch ($puan) {

  case '5': ?>

  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li>(<span> <?php echo $deger ?></span> )</li>

  <?php                                                                           
  break;

  case '4': ?>

  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <?php 

  if ($deger>4)
    {?>
     <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
   <?php }
   else{
    ?> 
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


  <?php }?>
  <li>(<span> <?php echo $deger ?></span> )</li>
  <?php                                                                           
  break;

  case '3': ?>

  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <?php 

  if ($deger>3)
    {?>
     <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
     <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
   <?php }
   else{
    ?> 
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
  <?php }?>
  <li>(<span> <?php echo $deger ?></span> )</li>


  <?php                                                                           
  break;

  case '2': ?>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <?php 

  if ($deger>2)
  {   
    ?>
    <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
  <?php }
  else{
    ?> 
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
  <?php }?>
  <li>(<span> <?php echo $deger ?></span> )</li>


  <?php                                                                           
  break;

  case '1': ?>

  <li><i class="fa fa-star" aria-hidden="true"></i></li>
  <?php
  if ($deger>1)
  {   
    ?>
    <li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>  
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
  <?php } 
  else{
    ?>    
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
  <?php }?>
  <li>(<span> <?php echo $deger ?></span> )</li>


  <?php                                                                           
  break;


}

?>     

