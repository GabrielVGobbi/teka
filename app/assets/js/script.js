
$(function () {
	
	var temporiza;

    //Initialize Select2 Elements
    $('.select2').select2()

    $('#marcarTodos').on('click', function(event) {
		$('.check').each(function() {
			$(this).iCheck('check');
		});
		
	});

	//Desmarcar todos os checkbox 
	$('#desmarcarTodos').on('click', function(event) {
		$('.check').each(function() {
			$(this).iCheck('uncheck');
		});
	});

    $('input[type="checkbox"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
	});

	$('[data-mask]').inputmask()

	
	$("#comenty").on("input", function() {
        $("#saveding").show();
		$("#saved").hide();
		
		var id_cliente = $('#id_cliente').val()
		var id_etapa = $('#id_etapa').val()


        clearTimeout(temporiza);

        var text = $("#comenty").val();

        temporiza = setTimeout(function() {
            $.ajax({
                url: BASE_URL_PAINEL + 'ajax/saveComentyExercicioImagem',
                type: 'POST',
                data: {
                    text: text,
                    id_etapa: id_etapa,
                    id_cliente: id_cliente,
                },
                dataType: 'json',
                success: function(json) {
                    $("#saveding").hide();
                    $("#saved").show();
				},
				error: function (request, status, error) {
					toastr.error('Contate o administrador de sistema: Error CDX1203_2')
				}
            });
        }, 1500);
    });


})

function previewImagem(){
	var imagem = document.querySelector('input[name=fotos]').files[0];
	var preview = document.querySelector('img[name=preview]');
	
	var reader = new FileReader();
	
	reader.onloadend = function () {
		preview.src = reader.result;
	}
	
	if(imagem){
		reader.readAsDataURL(imagem);
	}else{
		preview.src = "";
	}
}






