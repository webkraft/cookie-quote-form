function ajaxformsendmail(
	name,
	email,
	phone,
	subject,
	pickupdate,
	contents,
	photos_string,
	cookies_string){

jQuery.ajax({
	type: 'POST',
	url: ajaxcontactajax.ajaxurl,
	data: {
	action: 'ajaxcontact_send_mail',
	acfname: name,
	acfphone: phone,
	acfemail: email,
	acfsubject:subject,
	acfpickupdate:pickupdate,
	acfcontents:contents,
	acffilenames:photos_string,
	acfcookies: cookies_string
	},
	success:function(data, textStatus, XMLHttpRequest){
	var id = '#ajaxcontact-response';
	jQuery(id).html('');
	jQuery(id).append(data);
	},
	error: function(MLHttpRequest, textStatus, errorThrown){
	alert(errorThrown);
	}

	});
}
