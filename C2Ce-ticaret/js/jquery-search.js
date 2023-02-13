    $(function(){


        $("#search").keyup(function(){//inputta bir tuşa basılırsa
            var kelime=$(this).val();//değerini al

            $.post("search_post.php",{"kelime":kelime},function(al){ //ara.php ye gönder

                $(".kelimeler").html(al);//gelen verileri .kerlimeler clasına ait divin içine yaz

            });

            if (kelime=="")
            {
                $("#kelimeler").hide();
            }

        });

    });



function tamamla(al){//tamamla fonsiyonu çağırılınca gönderilen veriyi al

    $("#search").val(al);//inputa koy

    $(".kelimeler").text("");//kelimeler clasına ait divi temizle

}