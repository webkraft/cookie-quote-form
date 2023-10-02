var file_names=[];
jQuery( function( $ ) {
	
	$image_count = 0;
	$( '#media_file' ).change( function() {
		
		//hide submit button
		$( '#getquote' ).css('display','none');
		
		if ( ! this.files.length ) {
			$( '#media_filelist' ).empty();
		} else {
			
			$image_count ++;
			if ($image_count == 2){
				$('#media_file_button').css('display','none');
			}
				
			$('#media_response').html('');
			$("#progress-bar").css('display','block');
			$("#progress-bar").width(0);
			
			const file = this.files[0];
			$('#media_filelist').html( '<img src="' + URL.createObjectURL( file ) + '">' );
			//<span>' + file.name + '</span>

			const formData = new FormData();
			formData.append( 'media_file', file );
			formData.append( 'cutomer_name', $("#ajaxcontactname").val() );
			
			var uploadfile = file.name;
			file_names.push(uploadfile);
			
			var fileslist = '';			
			for (var ne=0; ne<=(file_names.length)-1; ne++){
				fileslist += file_names[ne]+'<br>';
			}
			files_string = JSON.stringify(file_names);
			
			$('#media_file_names').val(files_string);

			$.ajax({
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = (evt.loaded / evt.total) * 100;
							//console.log(percentComplete + '%');
							console.log(percentComplete.toFixed(1));
							$('#media_response').html('Please wait, uploading...');
							$("#progress-bar").width(percentComplete.toFixed(1) + '%');
							//round(0.5, 0)
							//$("#progress-bar").html('<div id="progress-status" class="text-center">' + percentComplete.toFixed(1) +' %</div>')
						}
						if(percentComplete == 100){
							$("#progress-bar").css('display','none');
							$('#media_response').html('Please wait, saving file...');
						}
					}, false);
					return xhr;
				},
				
				url: ajaxuploadajax.ajaxurl + '?action=mediaupload',
				type: 'POST',				
				data: formData,
				contentType: false,
				enctype: 'multipart/form-data',
				processData: false,
				success: function ( response ) {
					//$( 'input[name="media_file_field"]' ).val( response );
					$('#media_response').html("<ion-icon name='checkmark-circle-outline' style='color:green'></ion-icon> Uploaded");
					$('#media_filelist').html('');
					$( '#getquote' ).css('display','inline');
				}
				
			});
		}
	});
});
