        $(document).ready(function(){


                var alt_kategori_id=0;
              

                  $('#marka-list').change(function(){


                  
                  var deger=$(this).val();
                  $.post("marka-list-post.php",{markaliste:deger},function(a){
                    $('.x_content').empty();
                    $('.x_content').append(a);


                  })


                });

                $('#select1').change(function(){

                   $('#marka').empty();
                  var deger3=$(this).val();
                   kategori_id=$(this).val();
                  $.post("post-marka.php",{marka:deger3},function(a){
                      $('#marka').append(a);
                  })
                  
                  $('#select2').empty();
                  var deger=$(this).val();
                  $.post("post.php",{kategori:deger},function(a){
                    $('#select2').append(a);

                  })


                });

                  $('#select2').change(function(){

                      alt_kategori_id=$(this).val();

                        $('#beden').empty();
                  $.post("post-beden.php",{beden:alt_kategori_id},function(a){
                      $('#beden').append(a);
                  })

                   
                       $('#marka').empty();
                  $.post("post-marka.php",{marka:kategori_id},function(a){
                      $('#marka').append(a);
                  })


                  $('#select3').empty();
                  var deger2=$(this).val();
                  $.post("post2.php",{altkategori:deger2},function(a){
                      $('#select3').append(a);
                  })
                });

                     $('#select3').change(function(){


                     
                  
                });

            
              });
