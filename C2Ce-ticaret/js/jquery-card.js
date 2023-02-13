	$(document).ready(function () {
	var id=jQuery(this).attr("id");

	$('input').change(function(){

		var adet=$(this).val();
		var id=jQuery(this).attr("id");
		id=id.slice(1,id.length);
		$.post("sepeteekle.php",{sepet:adet,sepet_id:id,durum:0},function(a){
			if (a=="kalmadı")
			{
				alert("Stokta kalmadı!!!");
				$('.quantity-minus').trigger("click");
				$('.totalh').load(window.location.pathname+' .totalh');
			}

			$.post("sepeteekle.php",{sepet_id:id,durum:3},function(a){
				$('#f'+id).val(a);
				$('#silme').load(window.location.pathname+' #silme');
				$('.totalh').load(window.location.pathname+' .totalh');
			})
		})

		$('.totalh').load(window.location.pathname+' .totalh');

	});

	$('.quantity-plus').click(function(){

		var id=jQuery(this).attr("id");
		$.post("sepeteekle.php",{sepet_id:id,durum:1},function(a){
			$('#a'+id).val(a);


			if (a=="kalmadı")
			{
				alert("Stokta kalmadı!!!");
				$('.quantity-minus').trigger("click");
			}
			else
			{
				$('.totalh').load(window.location.pathname+' .totalh');
			}


			$.post("sepeteekle.php",{sepet_id:id,durum:3},function(a){
				$('#f'+id).val(a);
				$('#silme').load(window.location.pathname+' #silme');
				$('.totalh').load(window.location.pathname+' .totalh');
			})
		})




		$('.totalh').load(window.location.pathname+' .totalh');




	});

	$('.quantity-minus').click(function(){

		var id=jQuery(this).attr("id");
		$.post("sepeteekle.php",{sepet_id:id,durum:2},function(a){
			$('#a'+id).val(a);
			$.post("sepeteekle.php",{sepet_id:id,durum:3},function(a){
				$('#f'+id).val(a);
				$('#silme').load(window.location.pathname+' #silme');
			})

		})



		$('.totalh').load(window.location.pathname+' .totalh');


	});

	$('.dismiss').click(function(){

		var id=jQuery(this).attr("id");
		$.post("sepeteekle.php",{sepet_id:id,durum:-1},function(a){
			$('#gelen').load(window.location.pathname+' #gelen');
		})


		$('.totalh').load(window.location.pathname+' .totalh');


	});
	$('.totalh').load(window.location.pathname+' .totalh');

});
