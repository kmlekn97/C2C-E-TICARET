<script type="text/javascript">
  var aramaurl;
  var tik=0;
  var markadeger= [];
  var renkler=[];
  var renk="";
  var link="";
  var adetrenk=0; 
  var durum=0;
  var url="";
  var path="";
  var marka="";
  var beden="";
  var urunozellik="";
  var adi="";
  var siralama="";
  var kategori_id="";
  var bedendeger=[];

  $(document).ready(function () {


   <?php 
   $searchkeyword=htmlspecialchars(trim($_POST['searchkeyword']));
   $kategorilerim=$dbservice->aramaListelemetekil($searchkeyword);

   ?>

   kategori_id="&kategori_id="+<?php echo $kategorilerim->get_kategori_id();  ?>;


   $('#sirala').on('change', function() {
    siralama="";
    if ($(this).val()=="RastgeleSırala")
    {
      siralama="";
      history.pushState("object or string", "Title",window.location.pathname+renk+path+beden+urunozellik+marka); 
              //history.pushState("object or string", "Title",link); 
              $('.product-list-view').load(link+siralama+' .product-list-view');
            }
            else if ($(this).val()=="FiyataGöreArtan")
            {
              siralama="?&siralama=ASC";
              history.pushState("object or string", "Title",link+siralama); 
              $('.product-list-view').load(link+siralama+' .product-list-view');
            }
            else if ($(this).val()=="FiyataGöreAzalan")
            {
              siralama="?&siralama=DESC";
              history.pushState("object or string", "Title",link+siralama); 
              $('.product-list-view').load(link+siralama+' .product-list-view');
            }
            else if ($(this).val()=="EnYeniler")
            {
              siralama="?&siralama=yeni";
              history.pushState("object or string", "Title",link+siralama); 
              $('.product-list-view').load(link+siralama+' .product-list-view');
            }
            else
            {
              siralama="?&siralama=coksatanlar";
              history.pushState("object or string", "Title",link+siralama); 
              $('.product-list-view').load(link+siralama+' .product-list-view');
            }
          });


   $('#sirala-arama').on('change', function() {
    siralama="";
    if ($(this).val()=="RastgeleSırala")
    {
      siralama="";
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+' .product-list-view');
    }
    else if ($(this).val()=="FiyataGöreArtan")
    {
      siralama="&siralama=ASC";
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
    }
    else if ($(this).val()=="FiyataGöreAzalan")
    {
      siralama="&siralama=DESC";
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
    }
    else if ($(this).val()=="EnYeniler")
    {
      siralama="&siralama=yeni";
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
    }
    else
    {
      siralama="&siralama=coksatanlar";
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
    }
  });






   $('#temizle').hide();
   $('#temizle-arama').hide();


   $("#temizle-arama").click(function() 
   { 
     url="";
     renk="";
     marka="";
     markadeger=[];
     beden="";
     bedendeger=[];
     $("#searcharama").prop('disabled', true);
     $("#searchfiyat-1").val('');
     $("#searchfiyat-2").val('');
     history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+marka+url+renk+beden); 
     $("input[type='radio']:checked").attr("checked", false);
     $(":checkbox").attr("checked", false);
     $("#renklerim").empty();
     $("#fiyatlarim").empty();   
     $("#markam").empty();   
     $("#bedenim").empty();   
     $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+marka+url+renk+beden+' .product-list-view');
     $('#temizle-arama').hide();
     adetrenk=0;
     tik=0;
     siralama="";






   });


   $("#temizle").click(function() 
   { 
     $("#arama").prop('disabled', true);
     $("#fiyat-1").val('');
     $("#fiyat-2").val('');
     urunozellik="";
     link=window.location.pathname;
     renk="";
     urunozellikdeger=[];
     markadeger=[];
     path="";
     marka="";
     beden="";
     siralama="";
     history.pushState("object or string", "Title",window.location.pathname); 

     $('#filtre').hide();

     $("#markam").empty();
     $("#bedenim").empty();    
     $("#renklerim").empty();
     $("#fiyatlarim").empty();   
     $("#ekran-boyutu").empty();
     $("#<?php echo seo($urun_ozellikcek['ozellik_adi']); ?>").empty();





     $(":checkbox").attr("checked", false);

     $("input[type='radio']:checked").attr("checked", false);

     $('.product-list-view').load(window.location.pathname+' .product-list-view');


     $('#temizle').hide();







   });



   
   link=window.location.pathname+marka+renk+path+beden+urunozellik;
   $('.marka-gelen').on('change', function() {

    document.getElementById("markam").innerHTML="";

    while($(".marka-gelen input:checkbox:checked").length==0)
    {
      marka="";  

      link=window.location.pathname+renk+path+beden+urunozellik+marka;
      history.pushState("object or string", "Title", link+siralama); 
      break;
    }
    var result= $('.marka-gelen input[type="checkbox"]:checked');
    markadeger=[];
    var adetim=0;
    link=window.location.pathname+renk+path+beden+urunozellik+marka;

    adetrenk=0;
    result.each(function()
    {
      adetim++;   

      $('#temizle').show();
      $('#filtre').show();

      if ($(".marka-gelen input:checkbox:checked").length > 0)
      {
        markadeger.push($(this).val()+"");
        marka="?&marka="+markadeger;
        link=window.location.pathname+marka+renk+path+beden+urunozellik; 
        history.pushState("object or string", "Title", link+siralama); 

        if (adetrenk==0 || durum==1)
        {  
          if (tik==1)
          {

            link=window.location.pathname+marka+renk+path+beden+urunozellik; 
          }

        }





        
        var btn=document.createElement("button");
        btn.setAttribute("id","m"+markadeger[markadeger.length-1]);
        btn.setAttribute("name",markadeger[markadeger.length-1]);

        btn.innerText=$(this).val(); 


        <?php 


        $arraylistmarka=array();
        $markalist=new ArrayList($arraylistmarka);
        $markalist=$dbservice->Markalari_getir();
        $markalist=$markalist->toArray();

        foreach ($markalist as $markalarim) 
        {
          ?>
          if (jQuery(this).attr("value")==<?php echo $markalarim->get_marka_id(); ?>)
          {   


            btn.innerText="<?php echo $markalarim->get_marka_adi(); ?>";

          }

        <?php } ?>


        btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

        btn.onclick=function(){

         var deger=jQuery(this).attr("id");
         deger=deger.replace("m","");
         var index = markadeger.indexOf(deger);
         markadeger.splice(index, 1);
         marka="?&marka="+markadeger;
         if (markadeger.length==0)
         {
          marka="";
        }
        $("#m"+deger).remove();
        $('#'+deger).prop('checked', false);
        link=window.location.pathname+marka+renk+path+beden+urunozellik; 
        history.pushState("object or string", "Title", link+siralama); 
        $('.product-list-view').load(link+siralama+' .product-list-view');


      }

      var panelDiv=document.getElementById("markam");
      panelDiv.appendChild(btn);

    }
    else
    {
      path="?&fiyat="+selectedVal;
      link=window.location.pathname+marka+renk+path+beden+urunozellik;
    } 
    $('.product-list-view').load(link+siralama+' .product-list-view');


  });

    $('.product-list-view').load(link+siralama+' .product-list-view');

  })



 });


$('.marka-gelen-arama').on('change', function() {

  document.getElementById("markam").innerHTML="";  
  var result= $('.marka-gelen-arama input[type="checkbox"]:checked');
  markadeger=[];

  while($(".marka-gelen-arama input:checkbox:checked").length==0)
  {
    marka="";  
    history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 

    break;
  }

  result.each(function()
  {    
    if ($(".marka-gelen-arama input:checkbox:checked").length > 0)
    {
      $('#temizle-arama').show();
      markadeger.push($(this).val()+"");
      marka="&marka="+markadeger;
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 

      id=jQuery(this).attr("name");

      var btn=document.createElement("button");
      btn.setAttribute("id","m"+markadeger[markadeger.length-1]);
      btn.setAttribute("name",markadeger[markadeger.length-1]);
      btn.innerText=$(this).val();
      <?php 


      $arraylistmarka=array();
      $markalist=new ArrayList($arraylistmarka);
      $markalist=$dbservice->Markalari_getir();
      $markalist=$markalist->toArray();

      foreach ($markalist as $markalarim) 
      {
        ?>
        if (jQuery(this).attr("value")==<?php echo $markalarim->get_marka_id(); ?>)
        {   


          btn.innerText="<?php echo $markalarim->get_marka_adi(); ?>";

        }

      <?php } ?>

      btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

      btn.onclick=function(){
        var deger=jQuery(this).attr("id");
        deger=deger.replace("m","");
        var index = markadeger.indexOf(deger);
        markadeger.splice(index, 1);
        marka="&marka="+markadeger;
        if (markadeger.length==0)
        {
          marka="";
        }
        $("#m"+deger).remove();
        $('#'+deger).prop('checked', false);
        history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
        $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');

      }



    }
    var panelDiv=document.getElementById("markam");
    panelDiv.appendChild(btn);
    history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
    $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
  });








  history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
  $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');


});


$('.beden-gelen-arama').on('change', function() {

  document.getElementById("bedenim").innerHTML="";  
  var result= $('.beden-gelen-arama input[type="checkbox"]:checked');
  bedendeger=[];

  while($(".beden-gelen-arama input:checkbox:checked").length==0)
  {
    beden="";  
    history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 

    break;
  }

  result.each(function()
  {    
    if ($(".beden-gelen-arama input:checkbox:checked").length > 0)
    {
      $('#temizle-arama').show();
      bedendeger.push($(this).val()+"");
      beden="&beden="+bedendeger;
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 


      var btn=document.createElement("button");
      btn.setAttribute("id","b"+bedendeger[bedendeger.length-1]);
      btn.setAttribute("name",bedendeger[bedendeger.length-1]);
      btn.innerText=$(this).val();
      <?php 



      $arraylistbeden=array();
      $bedenlist=new ArrayList($arraylistbeden);
      $bedenlist=$dbservice->bedenlisteleme();
      $bedenlist=$bedenlist->toArray();
      foreach ($bedenlist as $bedenlerim) 
      {
        ?>
        if (jQuery(this).attr("value")==<?php echo $bedenlerim->get_beden_id(); ?>)
        {   


          btn.innerText="<?php echo $bedenlerim->get_beden_icerik(); ?>";

        }

      <?php } ?>

      btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

      btn.onclick=function(){

       var deger=jQuery(this).attr("id");
       deger=deger.replace("b","");
       var index = bedendeger.indexOf(deger);
       bedendeger.splice(index,1);
       beden="&beden="+bedendeger;
       if (bedendeger.length==0)
       {
        beden="";
      }

      $("#b"+deger).remove();
      $('#b'+deger).prop('checked', false);
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');

    }



  }
  var panelDiv=document.getElementById("bedenim");
  panelDiv.appendChild(btn);
  history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
  $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
});








  history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
  $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');


});


$('.fiyat-gelen-arama').on('change', function() {

 $('#temizle-arama').show();
 document.getElementById("fiyatlarim").innerHTML="";
 var selected = $(".fiyat-gelen-arama input[type='radio']:checked");
 var selectedVal;
 if (selected.length > 0) {
  selectedVal = selected.val();
}
url="&fiyat="+selectedVal;
history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
$('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');
var btn=document.createElement("button");
btn.setAttribute("id","aralık");
btn.setAttribute("name","aralık");




btn.innerText=selectedVal;



btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

btn.onclick=function(){

  $("#"+jQuery(this).attr("id")).remove();
  $('#'+jQuery(this).attr("id")).prop('checked', false);
  url="";
  $("input[type='radio']:checked").attr("checked", false);
  history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
  $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');



}

var panelDiv=document.getElementById("fiyatlarim");
panelDiv.appendChild(btn);
$('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');


});



$('.fiyat-gelen').on('change', function() {


 $('#temizle').show();
 $('#filtre').show();


 document.getElementById("fiyatlarim").innerHTML="";

 var selected = $(".fiyat-gelen input[type='radio']:checked");
 if (selected.length > 0) {
  selectedVal = selected.val();
}
path="?&fiyat="+selectedVal+"-";
link=window.location.pathname+marka+renk+path+beden+urunozellik; 
history.pushState("object or string", "Title",link+siralama);


var btn=document.createElement("button");
btn.setAttribute("id","aralık");
btn.setAttribute("name","aralık");




btn.innerText=selectedVal;



btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

btn.onclick=function(){

  $("#"+jQuery(this).attr("id")).remove();
  $('#'+jQuery(this).attr("id")).prop('checked', false);
  path="";
  $("input[type='radio']:checked").attr("checked", false);
  link=window.location.pathname+marka+renk+path+beden+urunozellik; 
  history.pushState("object or string", "Title", link+siralama); 
  $('.product-list-view').load(link+siralama+' .product-list-view');



}

var panelDiv=document.getElementById("fiyatlarim");
panelDiv.appendChild(btn);
$('.product-list-view').load(link+siralama+' .product-list-view');
});




<?php 
$arraylistrenk=array();
$renkliste=new ArrayList($arraylistrenk);
$renkliste=$dbservice->Renkleri_getir();
$renkliste=$renkliste->toArray();
foreach ($renkliste as $renklerim) 
  {?>

    $('.renk-gelen .<?php echo $renklerim->get_renk_id(); ?>').click(function() {


        //document.getElementById("renklerim").innerHTML="";

        $('#temizle').show();
        $('#filtre').show();
        

        var renk_id = jQuery(this).attr("value");
        renkler.push(renk_id);
        if (adetrenk==0)
        {
          renk+="?&renk=";
          adetrenk++;
          durum=1;
        }
        if (tik==1)
          renk+=",";
        renk+=renkler[renkler.length-1];
        link=window.location.pathname+marka+renk+path+beden+urunozellik; 
        history.pushState("object or string", "Title", link+siralama);
        tik=1;


        var btn=document.createElement("button");
        btn.setAttribute("id","r"+renkler[renkler.length-1]);
        btn.setAttribute("name",renkler[renkler.length-1]);


        if (jQuery(this).attr("value")==<?php echo $renklerim->get_renk_id(); ?>)
        {   


          btn.innerText="<?php echo $renklerim->get_renk_adi(); ?>";

        }





        btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

        btn.onclick=function(){
          var deger=jQuery(this).attr("id");
          deger=deger.replace("r","");
          var index = renkler.indexOf(deger);
          renkler.splice(index, 1);
          renk="?&renk="+renkler;
          if (renkler.length==0)
          {
            renk="";
            adetrenk=0;
            durum=0;
            tik=0;
          }

          $("#r"+deger).remove();
            //$('#r'+deger).prop('checked', false);
            link=window.location.pathname+marka+renk+path+beden+urunozellik; 
            history.pushState("object or string", "Title", link+siralama);
            $('.product-list-view').load(link+siralama+' .product-list-view');



          }

          var panelDiv=document.getElementById("renklerim");
          panelDiv.appendChild(btn);
          $('.product-list-view').load(link+siralama+' .product-list-view');



        });

    <?php
  }
  ?>

  <?php 
  $arraylistrenk=array();
  $renkliste=new ArrayList($arraylistrenk);
  $renkliste=$dbservice->Renkleri_getir();
  $renkliste=$renkliste->toArray();
  foreach ($renkliste as $renklerim) 
  {
    ?>

    $('.renk .<?php echo $renklerim->get_renk_id(); ?>').click(function() {

     $('#temizle-arama').show();
        //document.getElementById("renklerim").innerHTML="";
        var renk_id = jQuery(this).attr("value");
        renkler.push(renk_id);
        if (adetrenk==0)
        {
          renk+="&renk=";
          adetrenk++;
          durum=1;
        }
        if (tik==1)
          renk+=",";
        renk+=renkler[renkler.length-1];
        tik=1;

        history.pushState("object or string", "Title", "?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama);
        $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');




        var btn=document.createElement("button");
        btn.setAttribute("id","r"+renkler[renkler.length-1]);
        btn.setAttribute("name",renkler[renkler.length-1]);


        if (jQuery(this).attr("value")==<?php echo $renklerim->get_renk_id(); ?>)
        {   


          btn.innerText="<?php echo $renklerim->get_renk_adi(); ?>";

        }





        btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

        btn.onclick=function(){

         var deger=jQuery(this).attr("id");
         deger=deger.replace("r","");

         var index = renkler.indexOf(deger);
         renkler.splice(index, 1);
         renk="&renk="+renkler;
         if (renkler.length==0)
         {
          renk="";
          adetrenk=0;
          durum=0;
          tik=0;
          renkler=[];
        }

        $("#r"+deger).remove();
            //$('#'+deger).prop('checked', false);
            history.pushState("object or string", "Title", "?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama);
            $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');




          }

          var panelDiv=document.getElementById("renklerim");
          panelDiv.appendChild(btn);
          $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');







        });

    <?php
  }
  ?>


  $("#searchfiyat-1").keyup(function (){
   if (this.value.match(/[^0-9]/g)){
    this.value = this.value.replace(/[^0-9]/g,'');
    alert("Lütfen Rakam Giriniz...");
  }
  $("#searcharama").prop('disabled', false);
});
  $("#searchfiyat-2").keyup(function (){
    if (this.value.match(/[^0-9]/g)){
      this.value = this.value.replace(/[^0-9]/g,'');
      alert("Lütfen Rakam Giriniz...");
    }
    $("#searcharama").prop('disabled', false);
  });
  $("#searcharama").prop('disabled', true);
  $('#searcharama').click(function() {          
    var aramamin=$("#searchfiyat-1").val();
    var aramamax=$("#searchfiyat-2").val();
    var btn=document.createElement("button");
    btn.setAttribute("id","aralık");
    btn.setAttribute("name","aralık");
    $('#temizle-arama').show();

    if (Number(aramamin) > Number(aramamax))
    {
     url="&fiyat="+aramamax+"-"+aramamin;
     btn.innerText=aramamax+"-"+aramamin;
   }
   else 
   {
    url="&fiyat="+aramamin+"-"+aramamax;
    btn.innerText=aramamin+"-"+aramamax;
  }
  if (aramamin=="")
  {
   url="&fiyat="+"0"+"-"+aramamax;
   btn.innerText="0"+"-"+aramamax;
 }
 if (aramamax=="")
 {
   url="&fiyat="+aramamin+"-"+"1000000000000000000";
   btn.innerText=aramamin+"-"+"büyük";
 }
    //url=url+renk;
    history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
    $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');

    document.getElementById("fiyatlarim").innerHTML="";
    btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

    btn.onclick=function(){

      $("#"+jQuery(this).attr("id")).remove();
      $('#'+jQuery(this).attr("id")).prop('checked', false);
      url="";
      $("#searcharama").prop('disabled', true);
      $("#searchfiyat-1").val('');
      $("#searchfiyat-2").val('');
      history.pushState("object or string", "Title","?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama); 
      $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');



    }

    var panelDiv=document.getElementById("fiyatlarim");
    panelDiv.appendChild(btn);
    $('.product-list-view').load("?&arama=<?php echo htmlspecialchars(trim($_POST['searchkeyword']));  ?>"+kategori_id+marka+url+renk+beden+siralama+' .product-list-view');

  });

  $("#fiyat-1").keyup(function (){
   if (this.value.match(/[^0-9]/g)){
    this.value = this.value.replace(/[^0-9]/g,'');
    alert("Lütfen Rakam Giriniz...");
  }
  $("#arama").prop('disabled', false);
});
  $("#fiyat-2").keyup(function (){
    if (this.value.match(/[^0-9]/g)){
      this.value = this.value.replace(/[^0-9]/g,'');
      alert("Lütfen Rakam Giriniz...");
    }
    $("#arama").prop('disabled', false);
  });
  $("#arama").prop('disabled', true);
  $('#arama').click(function() {

    var btn=document.createElement("button");
    btn.setAttribute("id","aralık");
    btn.setAttribute("name","aralık");
    $('#temizle').show();
    $('#filtre').show();
    var min=$("#fiyat-1").val();
    var max=$("#fiyat-2").val();
    if (Number(min) > Number(max))
    {
     path="?&fiyat="+max+"-"+min;
     btn.innerText=max+"-"+min;
   }
   else
   {
    path="?&fiyat="+min+"-"+max;
    btn.innerText=min+"-"+max;
  }
  if (min=="")
  {
   path="?&fiyat="+"0"+"-"+max;
   btn.innerText="0"+"-"+max;
 }
 if (max=="")
 {
   path="?&fiyat="+min+"-"+"1000000000000000000";
   btn.innerText=min+"-"+"büyük";
 }
 path+="-";
 link=window.location.pathname+marka+renk+path+beden+urunozellik; 
 history.pushState("object or string", "Title",link+siralama);

 document.getElementById("fiyatlarim").innerHTML="";
 btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

 btn.onclick=function(){

  $("#"+jQuery(this).attr("id")).remove();
  $('#'+jQuery(this).attr("id")).prop('checked', false);
  path="";
  $("#arama").prop('disabled', true);
  $("#fiyat-1").val('');
  $("#fiyat-2").val('');
  link=window.location.pathname+marka+renk+path+beden+urunozellik; 
  history.pushState("object or string", "Title", link+siralama); 
  $('.product-list-view').load(link+siralama+' .product-list-view');



}

var panelDiv=document.getElementById("fiyatlarim");
panelDiv.appendChild(btn);
$('.product-list-view').load(link+siralama+' .product-list-view');




});
  $('.beden-gelen').on('change', function() {

    $('#temizle').show();
    $('#filtre').show();


    var bedendeger=[];
    var result2= $('.beden-gelen input[type="checkbox"]:checked');



    link=window.location.pathname+marka+renk+path+beden+urunozellik;
    document.getElementById("bedenim").innerHTML="";


    while($(".beden-gelen input:checkbox:checked").length==0)
    {
      beden="";  
      link=window.location.pathname+renk+path+beden+urunozellik+marka;
      history.pushState("object or string", "Title", link+siralama);
      break;
    }


    result2.each(function()
    {
      if ($(".beden-gelen input:checkbox:checked").length > 0)
      {
        bedendeger.push($(this).val()+"");
        beden="?&beden="+bedendeger;
        link=window.location.pathname+marka+renk+path+beden+urunozellik;
        history.pushState("object or string", "Title",link+siralama); 



        var btn=document.createElement("button");
        btn.setAttribute("id","b"+bedendeger[bedendeger.length-1]);
        btn.setAttribute("name",bedendeger[bedendeger.length-1]);

        btn.innerText=$(this).val(); 

        <?php 



        $arraylistbeden=array();
        $bedenlist=new ArrayList($arraylistbeden);
        $bedenlist=$dbservice->bedenlisteleme();
        $bedenlist=$bedenlist->toArray();
        foreach ($bedenlist as $bedenlerim) 
        {
          ?>
          if (jQuery(this).attr("value")==<?php echo $bedenlerim->get_beden_id(); ?>)
          {   


            btn.innerText="<?php echo $bedenlerim->get_beden_icerik(); ?>";

          }

        <?php } ?>



        btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

        btn.onclick=function(){
          var deger=jQuery(this).attr("id");
          deger=deger.replace("b","");

          var index = bedendeger.indexOf(deger);
          bedendeger.splice(index, 1);
          beden="?&beden="+bedendeger;
          if (bedendeger.length==0)
          {
            beden="";
          }


          $('#b'+deger).remove();
          $('#b'+deger).prop('checked', false);

          link=window.location.pathname+marka+renk+path+beden+urunozellik; 
          history.pushState("object or string", "Title", link+siralama); 
          $('.product-list-view').load(link+siralama+' .product-list-view');



        }

        var panelDiv=document.getElementById("bedenim");
        panelDiv.appendChild(btn);
        $('.product-list-view').load(link+siralama+' .product-list-view');

      }
      else
      {
        link=window.location.pathname+marka+renk+path+beden+urunozellik;
      } 




    });
    $('.product-list-view').load(link+siralama+' .product-list-view');  


  });


  <?php 
  $ozellikarraylist=array();
  $ozellikliste=new ArrayList($ozellikarraylist);
  $ozellikliste=$dbservice->Urunozelliklistele();
  $ozellikliste=$ozellikliste->toArray();

  foreach ($ozellikliste as $urunozelliklerim) 
    {?> 

     var urunozellikdeger= [];
     var adarray=[];
     var btnadet=0;
     var gelenadet;
     $(".o<?php echo $urunozelliklerim->get_urun_ozellikleri_id(); ?>").on('change', function() {


      $('#temizle').show();
      $('#filtre').show();


      document.getElementById("<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>").innerHTML="";
      if (urunozellik.indexOf("?&<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>=")==-1)
      urunozellik+="?&<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>=";
      adi="?&<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>=";


      while($(".o<?php echo $urunozelliklerim->get_urun_ozellikleri_id(); ?> input:checkbox:checked").length==0)
      {
        urunozellik="";
        link=window.location.pathname+marka+renk+path+beden;
        link=window.location.pathname+marka+renk+path+beden+urunozellik;  
        break;
      }
      var result3= $('.o<?php echo $urunozelliklerim->get_urun_ozellikleri_id(); ?> input[type="checkbox"]:checked');

    //link=window.location.pathname+marka+renk+path+beden+urunozellik;
    btnadet++;
    if (adarray.indexOf(adi)==-1)
     adarray.push(adi);
   var ozellik=[];
   result3.each(function()
   { 

    ozellik=[];   



    ozellik.push($(this).val());

    if ($(".o<?php echo $urunozelliklerim->get_urun_ozellikleri_id(); ?> input:checkbox:checked").length==1)
    {
      urunozellik+=ozellik+",";
    }
    else
    { 
      if (urunozellik.indexOf(ozellik) == -1)
        urunozellik+=ozellik+",";

    }
    link=window.location.pathname+marka+renk+path+beden+urunozellik;
    history.pushState("object or string", "Title",link+siralama); 

    gelenadet=$(".ozellikler input:checkbox:checked").length;
    if (gelenadet<btnadet)
    {       
     var Secilenler;

     $('.ozellikler input:checkbox:checked').each(function () {
                        //Secilenler.push($(this).val());
                        Secilenler +=$(this).val();
                      });

     for (var i=1;i<=100000;i++)
     {

       if (Secilenler.indexOf(i)==-1)
       {

        urunozellik=urunozellik.replace(i+",","");
        durum=1;


      }

    }



    link=window.location.pathname+marka+renk+path+beden+urunozellik;
    history.pushState("object or string", "Title",link+siralama);
  }


  var btn=document.createElement("button");
  btn.setAttribute("id","o"+ozellik[ozellik.length-1]);
  btn.setAttribute("name","o"+ozellik[ozellik.length-1]);
  btn.innerText=$(this).val(); 

  <?php 
  $ozellikdetayarraylist=array();
  $ozellikdetaylist=new ArrayList($ozellikdetayarraylist);
  $ozellikdetaylist=$dbservice->Urunozellikdetaylistele($urunozelliklerim->get_urun_ozellikleri_id());
  $ozellikdetaylist=$ozellikdetaylist->toArray();

  foreach ($ozellikdetaylist as $urunozellikdetaylarim) 
  {  
    ?>

    if (jQuery(this).attr("value")==<?php echo $urunozellikdetaylarim->get_ozellik_detay_id(); ?>)
    {   

      btn.innerText="<?php echo $urunozellikdetaylarim->get_ozellik_detay(); ?>";

    }
  <?php } ?>

  var adeto=0;    
  var dizi=[];    
  btn.style.cssText="background:#007bff; font-size:16px; padding:8px; margin:8px; border-radius: 30%;"; 

  btn.onclick=function(){

    dizi=[];
    btnadet--;
    var deger=jQuery(this).attr("id");
    deger=deger.replace("o","");
    var index=deger.indexOf("=");
    var id=deger.slice(index+1,deger.length);
    $('#o'+id).remove();
    $('#o'+id).removeAttr('checked');
    var virgülindex=urunozellik.indexOf("=");
    var virgül=urunozellik.slice(virgülindex+1);
    dizi=virgül.split(",");
    if (dizi.indexOf(id)!=-1)
    {
      dizi.splice(dizi.indexOf(id),1);
    }  
    urunozellik=adarray[0]+dizi;
    if (urunozellik.indexOf(id)!=-1)
    {
      urunozellik=urunozellik.replace(id+",","");
      urunozellik = urunozellik.replace("?&<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>=","");
    }


    if (urunozellik.charAt(urunozellik.indexOf("=")+1)=="?")
    {
      urunozellik = urunozellik.replace("?&<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>=","");
    }





    link=window.location.pathname+marka+renk+path+beden+urunozellik;

    history.pushState("object or string", "Title", link+siralama); 


    if (btnadet==0)
    {

      urunozellik="";
      link=window.location.pathname+marka+renk+path+beden+urunozellik;
      history.pushState("object or string", "Title", link+siralama); 
      $('#temizle').hide();
    }


    $('.product-list-view').load(link+siralama+' .product-list-view');


  }

  var panelDiv=document.getElementById("<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>");
  panelDiv.appendChild(btn);
  $('.product-list-view').load(link+siralama+' .product-list-view');




});


   $("#temizle").click(function() 
   { 
     $("#arama").prop('disabled', true);
     $("#fiyat-1").val('');
     $("#fiyat-2").val('');
     urunozellik="";
     link=window.location.pathname;
     renk="";
     urunozellikdeger=[];
     markadeger=[];
     path="";
     marka="";
     beden="";
     siralama="";
     history.pushState("object or string", "Title",window.location.pathname); 

     $('#filtre').hide();

     $("#markam").empty();
     $("#bedenim").empty();    
     $("#renklerim").empty();
     $("#fiyatlarim").empty();   
     $("#ekran-boyutu").empty();
     $("#<?php echo seo($urunozelliklerim->get_ozellik_adi()); ?>").empty();





     $(":checkbox").attr("checked", false);

     $('.product-list-view').load(window.location.pathname+' .product-list-view');

     $('#temizle').hide();







   });


 });

<?php
}
?>


</script>