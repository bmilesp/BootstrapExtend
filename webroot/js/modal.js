function loading($action){
	$('#modal-loading').modal($action);
}
function modalBlank($html){
	$('#modal-blank-template .modal-content').html($html);
	$('#modal-blank-template').modal('show');
}
//Modal Edit
	$('body').on('click', '.modal-edit',function(e){

		modalBlank('');
		loading('show');

		//Vars
		var $url = $(this).attr('href');
		$.ajax({
  			type: 'GET',
  			url: $url
		}).done(function( $html ) {
			loading('hide');
  			modalBlank($html);
		});

		e.preventDefault;
		return false;
	});

	if(window.location.hash){
		var hash = window.location.hash;
		var index = hash.search('modal');
		if(index > 0){
			var modal_id = hash.replace('#modal-', '');
			$('.panel#' + modal_id + ' a.modal-edit')[0].click();
		}
	}
	$('body').on('submit', '.modal-submit',function(e){
		

        //Vars 
        var $url = $(this).attr('action');
        var $method = $(this).attr('method');

        //var $data = $(this).serialize();
        var $data = new FormData($(this)[0]);

        modalBlank('');
        loading('show');
        $.ajax({
            type: $method.toUpperCase(),
            url: $url,
            data: $data,
            enctype: 'multipart/form-data',
          	processData: false,
          	contentType: false
        }).done(function($html) {
            
            loading('hide');
            modalBlank($html);
           
        });

        e.preventDefault();
        return false;
    });