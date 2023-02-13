  $(document).ready(function(){


    
   var urundeger;
   var degerrenk;
   var degerbeden;

   $('#urun-list').change(function(){

    urundeger=$(this).val();

    $.post("urun-list-post.php",{urunliste:urundeger},function(a){
      $('.x_content').empty();
      $('.x_content').append(a);


    })



  });


   $('#renk').change(function(){


    

    degerrenk=$(this).val();
    $.post("renk-post-list.php",{urunliste:urundeger,renk:degerrenk},function(a){
     $('.x_content').empty();
     $('.x_content').append(a);

   })


  });


   $('#beden').change(function(){


    

    degerbeden=$(this).val();
    $.post("beden-post-list.php",{beden:degerbeden,renk:degerrenk},function(a){
     $('.x_content').empty();
     $('.x_content').append(a);

   })




  });


   
 });
