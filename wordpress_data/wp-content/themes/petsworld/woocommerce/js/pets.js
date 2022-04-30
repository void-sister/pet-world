jQuery(document).ready(function($){

	var file_frame;
	var file_frame_with_multiple;

	$('body').delegate('span.my_delete','click', function(){
		var $parent = $(this).parent("div.thumbnail-holder");
		$($parent).prev("a#dt-set-featured-image").show();
		$($parent).remove();
	});

	$("select.pet_main_services").on('change',function( event ){
		
		var $container = $(this).parents("p#_pet_main_services_field").next("div#_pet_child_services");
		var $val =  $(this).val();

		$.ajax({
			url  : dttheme_urls.ajaxurl,
			data : {
				'action' : 'dt_sc_pet_child_services',
				'data'   : { 'id' : $val, dtThemeAjaxNonce: dttheme_urls.dtThemeAjaxNonce }
			},
			beforeSend: function() {
				$container.html('<div class="dt-sc-loading"><span></span></div>');
			},
			success: function( response ) {
				$container.html(response).fadeIn();
			}
		});
	});
	
	$('#dt-set-gallery-image').on('click', function(event){
		
		event.preventDefault();

		var $this = $(this),
			$parent = $(this).parent("div");

		// if the file_frame has already been created, just reuse it
		if ( file_frame_with_multiple ) {
			file_frame_with_multiple.open();
			return;
		}

		file_frame_with_multiple = wp.media.frames.file_frame = wp.media({
			multiple: true
		});

		file_frame_with_multiple.on( 'select', function(){
			var attachments = file_frame_with_multiple.state().get('selection').toJSON();
			var holder = "";

			$.each( attachments,function(key,value){
				var full = value.sizes.full.url,
					thumbnail =  value.sizes.thumbnail.url,
					name = value.name,
					id = value.id;
				
				holder += "<li>" +
					"<img src='"+thumbnail+"'/>" +
					"<span class='dt-image-name' >"+name+"</span>" +
					"<input type='hidden' class='dt-image-name' name='items_name[]' value='"+name+"' />" +
					"<input type='hidden' name='items[]' value='"+full+"' />" +
					"<input type='hidden' name='items_thumbnail[]' value='"+thumbnail+"' />" +
					"<span class='my_delete'> - </span>" +
					"</li>";					
			});

			if(holder.length > 0) {
				$($parent).find("ul.dt-items-holder").append( holder );
			}
		});

		file_frame_with_multiple.open();
		
	});


	$("#dt-set-featured-image").on( 'click', function( event ){

		event.preventDefault();

		var $this = $(this),
			$parent = $(this).parent("p");

		// if the file_frame has already been created, just reuse it
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		file_frame = wp.media.frames.file_frame = wp.media({
			multiple: false
		});

		file_frame.on( 'select', function(){
			var attachments = file_frame.state().get('selection').toJSON();
			var holder = "";

			$.each( attachments,function(key,value){
				var full = value.sizes.full.url,
					thumbnail =  value.sizes.thumbnail.url,
					name = value.name,
					id = value.id;

				holder += "<div class='thumbnail-holder'>" +
					"<img src='"+thumbnail+"'/>" +
					"<input type='hidden' name='_thumbnail_id' value='"+id+"' />" +
					"<span class='my_delete'> - </span>" +
					"</div>";
			});

			if(holder.length > 0) {
				$($this).hide();
				$($parent).append( holder );
			}
		});

		file_frame.open();
	});
});