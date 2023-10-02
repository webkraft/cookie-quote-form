var files_arr=[];
jQuery( function( $ ) {
	
	$image_count = 0;
	$( '#media_file' ).change( function() {
		
		$( '#getquote' ).css('display','none');
		
		if ( ! this.files.length ) {
			$( '#media_filelist' ).empty();
		} else {
			
			var file_size = $('#media_file')[0].files[0].size;
			console.log('file_size: ' + file_size);
			if(file_size > 10485760) {
				alert("File size is greater than 10MB");
				return false;
			}
			
			var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
			if ($.inArray($('#media_file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
				return false;
			}
			
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
			files_arr.push(uploadfile);
			
			var fileslist = '';			
			for (var ne=0; ne<=(files_arr.length)-1; ne++){
				fileslist += '<li>'+files_arr[ne]+'</li>';
			}
			$('#media_file_names').html(fileslist);			

			$.ajax({
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = (evt.loaded / evt.total) * 100;
							//console.log(percentComplete.toFixed(1));
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
