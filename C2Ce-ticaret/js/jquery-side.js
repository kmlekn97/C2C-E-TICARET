$(document).ready(function () {
 $('#marka').keyup(function () {
  if ($('#marka').val().length < 0) {
    var tg = $('.marka-gelen');
    tg.show();

    return;
  }

  $('.marka-gelen').hide();

  
  var adet=0;  
  
  var txt = $('#marka').val();
  txt=txt.trim();
  $('.marka-gelen').each(function () {
    if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
      $(this).show();
      adet++;
    }
    
  });
  var uzunluk = txt.length;
  if (adet<=0 && uzunluk > 0)
  {
   $('.marka-row').hide();
   adet=0;
 }
 else
 {
   $('.marka-row').show();
 }
 var t = $('.checkbox:visible');

});
 $('#beden').keyup(function () {
  if ($('#beden').val().length < 0) {
    var tg = $('.beden-gelen');
    tg.show();

    return;
  }

  $('.beden-gelen').hide();

  
  var adet=0;  
  
  var txt = $('#beden').val();
  txt=txt.trim();
  $('.beden-gelen').each(function () {
    if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
      $(this).show();
      adet++;
    }
  });
  var uzunluk = txt.length;
  if (adet<=0 && uzunluk > 0)
  {
   $('.beden-row').hide();
   adet=0;
 }
 else
 {
   $('.beden-row').show();
 }
 var t = $('.checkbox:visible');

});
});

