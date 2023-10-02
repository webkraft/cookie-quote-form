<?php

/*
Plugin Name: Ajax Contact Form
Plugin URI:
Description: Cookie quote form
Author: PhiN
Version:
Author URI:
*/

ini_set('display_errors','off');
define('ACFSURL', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );
define('ACFPATH', WP_PLUGIN_DIR."/".dirname( plugin_basename( __FILE__ ) ) );
 
require( dirname(__FILE__) . '/../../../wp-load.php' );
// Use wp_handle_upload() function
require_once( ABSPATH . 'wp-admin/includes/file.php' );

function ajaxcontact_enqueuescripts(){
wp_enqueue_script('ajaxcontact', ACFSURL.'/js/ajaxcontact.js', array('jquery'));
wp_enqueue_script('ajaxupload', ACFSURL.'/js/ajaxupload.js', array('jquery'));
wp_localize_script( 'ajaxcontact', 'ajaxcontactajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
wp_localize_script( 'ajaxupload', 'ajaxuploadajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', ajaxcontact_enqueuescripts);

/*
Warning: Use of undefined constant ajaxcontact_enqueuescripts - assumed 'ajaxcontact_enqueuescripts' (this will throw an Error in a future version of PHP) in /home/customer/www/bakedthingz.scruffydogstudio.com.au/public_html/wp-content/plugins/ajaxcontactform/ajaxcontactform.php on line 25

Warning: Cannot modify header information - headers already sent by (output started at /home/customer/www/bakedthingz.scruffydogstudio.com.au/public_html/wp-content/plugins/ajaxcontactform/ajaxcontactform.php:25) in /home/customer/www/bakedthingz.scruffydogstudio.com.au/public_html/wp-admin/includes/misc.php on line 1431
*/

function ajaxcontact_show_contact(){
?>
<style>
#ajaxcontactform h4{
	font-weight: 200;
	font-size: 32px;
}
#ajaxcontact-text span{
	display:block;
	margin-left:20px;
}
.embellishments{
	margin-left:40px;
	display:none;
}
.quantity{
	margin-top:10px;
}
#ajaxcontact-text p{
	margin-top: 20px;
	margin-bottom: 10px;
}
#ajaxcontact-text input{
	margin-bottom:20px !important;
}
#pb-wrapper{
width: 300px;		
}
#progress-bar {
    background-color: #42c148;
    width: 0%;
	height:5px;
	margin:10px 0;
    -webkit-transition: width .3s;
    -moz-transition: width .3s;
    transition: width .3s;
    border-radius: 5px;
}
</style>

<form id="ajaxcontactform" action="" method="post" enctype="multipart/form-data" autocomplete="on">
	
<div id="ajaxcontact-text">
<h4>Contact details</h4>
<label for="ajaxcontactname">Name</label><br>
<input type="text" id="ajaxcontactname" name="ajaxcontactname" maxlength="30" required/>

<label for="ajaxcontactemail">Email</label><br>
<input type="text" id="ajaxcontactemail" name="ajaxcontactemail" maxlength="50" required/>

<label for="ajaxcontactemail">Phone number</label><br>
<input type="text" id="ajaxcontactphone" name="ajaxcontactphone" maxlength="20" required/>

<label for="ajaxcontactsubject">Subject</label><br>
<input type="text" id="ajaxcontactsubject" name="ajaxcontactsubject" maxlength="40"/>

<label for="ajaxcontactpickupdate">Pickup date</label><br>
<input type="date" id="ajaxcontactpickupdate" name="ajaxcontactpickupdate">
<hr>

<h4>Custom cookies</h4>
<input type="checkbox" id="royal_icing" class="custom_cookies" name="royal_icing" value="royal_icing">
<label for="royal_icing"> <strong>Royal icing cookies</strong><br>
<span>Customised vanilla or gingerbread cookie shapes.</span>
<span>Hand decorated with royal icing.</span>
</label>
<div class="embellishments" id="royal_icing_embellishments">
	<p>Embellishments may be used:</p>
	<input type="checkbox" class="custom_cookies" id="royal_icing_embellishment_edible_sprinkles" name="royal_icing_embellishment_edible_sprinkles" value="royal_icing_embellishment_edible_sprinkles">
	<label for="royal_icing_embellishment_edible_sprinkles">Edible sugar sprinkles</label><br>
	
	<input type="checkbox" class="custom_cookies" id="royal_icing_embellishment_metallic_paint" name="royal_icing_embellishment_metallic_paint" value="royal_icing_embellishment_metallic_paint">
	<label for="royal_icing_embellishment_metallic_paint">Metallic paint and leaf</label><br>
	
	<input type="checkbox" class="custom_cookies" id="royal_icing_embellishment_fondant_shape" name="royal_icing_embellishment_fondant_shape" value="royal_icing_embellishment_fondant_shape">
	<label for="royal_icing_embellishment_fondant_shape">Fondant shapes</label><br>
	
	<input type="checkbox" class="custom_cookies" id="royal_icing_embellishment_wafer_paper" name="royal_icing_embellishment_wafer_paper" value="royal_icing_embellishment_wafer_paper">
	<label for="royal_icing_embellishment_wafer_paper">Wafer paper</label><br>
	
	<input type="checkbox" class="custom_cookies" id="royal_icing_embellishment_icing_sheet" name="royal_icing_embellishment_icing_sheet" value="royal_icing_embellishment_icing_sheet">
	<label for="royal_icing_embellishment_icing_sheet">Icing sheets</label><br>
	
	<input type="checkbox" class="custom_cookies" id="royal_icing_embellishment_eddie_print" name="royal_icing_embellishment_eddie_print" value="royal_icing_embellishment_eddie_print">
	<label for="royal_icing_embellishment_eddie_print">Eddie prints</label>
	<br><br>
</div>
<div class="quantity">
	<label for="royal_icing_quantity">Quantity (min 12)</label>
	<input type="number" id="royal_icing_quantity" name="royal_icing_quantity" min="12" step="6">
</div>
<hr>

<input type="checkbox" class="custom_cookies" id="fondant" name="fondant" value="fondant">
<label for="fondant"> <strong>Fondant cookies</strong><br>
<span>Customised vanilla or gingerbread cookie shapes.</span>
<span>Covered in embossed fondant.</span>
</label>
<div class="embellishments" id="fondant_embellishments">
	<p>Embellishments may be used:</p>
	<input type="checkbox" class="custom_cookies" id="fondant_embellishment_edible_sprinkles" name="fondant_embellishment_edible_sprinkles" value="fondant_embellishment_edible_sprinkles">
	<label for="fondant_embellishment_edible_sprinkles">Edible sugar sprinkles</label><br>
	
	<input type="checkbox" class="custom_cookies" id="fondant_embellishment_metallic_paint" name="fondant_embellishment_metallic_paint" value="fondant_embellishment_metallic_paint">
	<label for="fondant_embellishment_metallic_paint">Metallic paint and leaf</label><br>
	
	<input type="checkbox" class="custom_cookies" id="fondant_embellishment_fondant_shape" name="fondant_embellishment_fondant_shape" value="fondant_embellishment_fondant_shape">
	<label for="fondant_embellishment_fondant_shape">Fondant shapes</label><br>
	
	<input type="checkbox" class="custom_cookies" id="fondant_embellishment_wafer_paper" name="fondant_embellishment_wafer_paper" value="fondant_embellishment_wafer_paper">
	<label for="fondant_embellishment_wafer_paper">Wafer paper</label><br>
	
	<input type="checkbox" class="custom_cookies" id="fondant_embellishment_icing_sheet" name="fondant_embellishment_icing_sheet" value="fondant_embellishment_icing_sheet">
	<label for="fondant_embellishment_icing_sheet">Icing sheets</label><br>
	
	<input type="checkbox" class="custom_cookies" id="fondant_embellishment_eddie_print" name="fondant_embellishment_eddie_print" value="fondant_embellishment_eddie_print">
	<label for="fondant_embellishment_eddie_print">Eddie prints</label>
	<br><br>
</div>
<div class="quantity">
<label for="fondant_icing_quantity">Quantity (min 12)</label>
	<input type="number" id="fondant_icing_quantity" name="fondant_icing_quantity" min="12" step="6">
</div>
<hr>

<input type="checkbox" class="custom_cookies" id="edible_image" name="edible_image" value="edible_image">
<label for="edible_image"><strong>Edible image cookies</strong><br>
<span>Customised vanilla or gingerbread cookie shapes.</span>
<span>Covered in royal icing or fondant.</span>
<span>Topped with a printed edible icing sheet.</span>
</label>
<div class="quantity">
	<label for="edible_image_quantity">Quantity (min 12)</label>
	<input type="number" id="edible_image_quantity" name="edible_image_quantity" min="12" step="6">
</div>
<hr>

<input type="checkbox" class="custom_cookies" id="printed" name="printed" value="printed">
<label for="printed"><strong>Printed cookies</strong><br>
<span>Customised vanilla or gingerbread cookie shapes.</span>
<span>Covered in royal icing or fondant.</span>
<span>Printed with edible ink*</span>
<span>*I have an <a href="https://store.primera.com.au/primera-eddie-edible-ink-printer" target="blank">Eddie Edible Ink Printer</a> which prints full-colour photographs and text directly onto the surface of cookies.</span>
</label>
<div class="quantity">
	<label for="printed_quantity">Quantity (min 12)</label>
	<input type="number" id="printed_quantity" name="printed_quantity" min="12" step="6">
</div>
<hr>

<h4>Other baked goods</h4>
<p><strong>Vanilla Cookies</strong></p>
<input type="checkbox" class="custom_cookies" id="vanilla_minis" name="vanilla_minis" value="vanilla_minis">
<label for="vanilla_minis">Minis</label><br>
<input type="checkbox" class="custom_cookies" id="vanilla_butter_man" name="vanilla_butter_man" value="vanilla_butter_man">
<label for="vanilla_butter_man">Butter man</label><br>
<input type="checkbox" class="custom_cookies" id="vanilla_lil_pigs" name="vanilla_lil_pigs" value="vanilla_lil_pigs">
<label for="vanilla_lil_pigs">Lil Pigs</label><br>
<input type="checkbox" class="custom_cookies" id="vanilla_sprinkle_rings" name="vanilla_sprinkle_rings" value="vanilla_sprinkle_rings">
<label for="vanilla_sprinkle_rings">Sprinkle rings</label><br>
<input type="checkbox" class="custom_cookies" id="vanilla_character_cookies" name="vanilla_character_cookies" value="vanilla_character_cookies">
<label for="vanilla_character_cookies">Character cookies</label>
<div class="quantity">
	<label for="other_quantity">Quantity (min 12)</label>
	<input type="number" id="other_quantity" name="other_quantity" min="12" step="6">
</div>
<hr>

<p><strong>Gingerbread Cookies</strong></p>
<input type="checkbox" class="custom_cookies" id="gingerbread_minis" name="gingerbread_minis" value="gingerbread_minis">
<label for="gingerbread_minis">Minis</label><br>
<input type="checkbox" class="custom_cookies" id="gingerbread_man" name="gingerbread_man" value="gingerbread_man">
<label for="gingerbread_man">Gingerbread man</label>
<div class="quantity">
	<label for="gingerbread_quantity">Quantity (min 12)</label>
	<input type="number" id="gingerbread_quantity" name="gingerbread_quantity" min="12" step="6">
</div>
<hr>
<h4>Vegan/eggless/gluten free** cookies</h4>
<p><strong>Vanilla Cookies</strong></p>
<input type="checkbox" class="custom_cookies" id="Vegan_choc_chip" name="Vegan_choc_chip" value="Vegan_choc_chip">
<label for="Vegan_choc_chip">Vegan choc chip</label><br>
<input type="checkbox" class="custom_cookies" id="ginger_bites" name="ginger_bites" value="ginger_bites">
<label for="ginger_bites">Ginger bites</label><br>
<input type="checkbox" class="custom_cookies" id="lightly_spiced_cookies" name="lightly_spiced_cookies" value="lightly_spiced_cookies">
<label for="lightly_spiced_cookies">Lightly spiced cookies**<br>
<span>A decorated cookie that has no gluten containing ingredients. As per the australian food regs, since I have gluten in the kitchen I can't claim 'gluten free' unless I have each batch tested - which is cost prohibitive for my small business.</span>
</label>
<div class="quantity">
	<label for="vegan_quantity">Quantity (min 12)</label>
	<input type="number" id="vegan_quantity" name="vegan_quantity" min="12" step="6">
</div>
<br>

<hr>
<h4>Monster cookies/slices</h4>
<input type="checkbox" class="custom_cookies" id="brownie" name="brownie" value="brownie">
<label for="brownie">Brownie</label><br>
<input type="checkbox" class="custom_cookies" id="gingerbread_hedgehog" name="gingerbread_hedgehog" value="gingerbread_hedgehog">
<label for="gingerbread_hedgehog">Gingerbread hedgehog</label><br>
<input type="checkbox" class="custom_cookies" id="monster_choc_chip" name="monster_choc_chip" value="monster_choc_chip">
<label for="monster_choc_chip">Monster choc chip cookie</label><br>
<input type="checkbox" class="custom_cookies" id="rocky_road" name="rocky_road" value="rocky_road">
<label for="rocky_road">Rocky road cookie</label><br>
<input type="checkbox" class="custom_cookies" id="loaded_cookie" name="loaded_cookie" value="loaded_cookie">
<label for="loaded_cookie">Loaded cookie</label>
<div class="quantity">
	<label for="monster_cookies_quantity">Quantity (min 12)</label>
	<input type="number" id="monster_cookies_quantity" name="monster_cookies_quantity" min="12" step="6">
</div>
<hr>

<h4>Inspirational images</h4>
<p>Attach photos of designs that you would like me to use.</p>
<p style="font-size:11px;margin-top:0;">Max 2 images, only PDF, JPG, GIF and PNG files allowed, max size 10mb.</p>
<input type="file" id="media_file" name="media_file" style="display:none"/>
<input type="text" name="media_file_field" style="display:none"/>
<p id="media_file_names" style="display:none"></p>
<label for="media_file">
<a class="button" id="media_file_button">Select image</a>
</label>
<div id="pb-wrapper"><div id="progress-bar"></div></div>
<div id="media_filelist" style="max-width:300px; margin-top:10px;"></div>
<div id="media_response"></div>
<hr>
	
<h4>Additional details</h4>
<!-- <label for="ajaxcontactcontents">Additional details</label><br> -->
<textarea id="ajaxcontactcontents" name="ajaxcontactcontents" rows="6" cols="20"></textarea>
<br><br>
<hr>
<a id="getquote" class="button">Request quote</a>
</div>
</form>
<br>
<div id="ajaxcontact-response"></div>

<script>
//Form controls
jQuery("#royal_icing").on("click", function(){
    if(royal_icing.checked) {
		jQuery('#royal_icing_embellishments').css('display','block');
		jQuery('#royal_icing_quantity').val(12);
    }else{
		jQuery('#royal_icing_embellishments').css('display','none');
		jQuery("#royal_icing_embellishments").parent().parent().find('input[type="checkbox"]').prop('checked', false);
    }
});
jQuery("#fondant").on("click", function(){
    if(fondant.checked) {
		jQuery('#fondant_embellishments').css('display','block');
		jQuery('#fondant_icing_quantity').val(12);
    }else{
		jQuery('#fondant_embellishments').css('display','none');
		jQuery("#fondant_embellishments").parent().parent().find('input[type="checkbox"]').prop('checked', false);
    }
});
	
jQuery('#getquote').click(function(){
	
	var cookies=[];
	jQuery('input:checkbox[class="custom_cookies"]:checked').each(function(){
		cookies.push(jQuery(this).prop('id'));
	});
	var cookie_string = JSON.stringify(cookies);
	var cookielist='';			
	for (var ne=0; ne<=(cookies.length)-1; ne++){
		cookielist+='<li>'+cookies[ne]+'</li>';
	}
	var cookies_string = cookielist;
	var photos_string = jQuery('#media_file_names').text();

	ajaxformsendmail(
		ajaxcontactname.value,
		ajaxcontactemail.value,
		ajaxcontactphone.value,
		ajaxcontactsubject.value,
		ajaxcontactpickupdate.value,
		ajaxcontactcontents.value,
		photos_string,
		cookies_string);

});
</script>

<?php
}

function ajaxcontact_send_mail(){
	
$results = "<ion-icon name='close-circle-outline' style='color:red'></ion-icon> The quote could not be sent.";
$error = 0;
$name = $_POST['acfname'];
$email = $_POST['acfemail'];
$phone = $_POST['acfphone'];
$subject = $_POST['acfsubject'];
$pickupdate = $_POST['acfpickupdate'];
$contents = $_POST['acfcontents'];
$file_names = $_POST['acffilenames'];
$cookies = $_POST['acfcookies'];
$admin_email = get_option('admin_email');

$email_content = "
<html><body>
<p><strong>You have a website quote request</strong></p>
From: ".$name."<br>
Email: ".$email."<br>
Phone: ".$phone."<br>
Subject: ".$subject."<br>
Pickup date: ".$pickupdate."<br>
Cookies: ".$cookies."<br>
Details: ".$contents."<br><br>
Search images in the media library, by contact name or file name:<br>
Photos: ".$file_names."
</body></html>";
	
if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && strlen($email) == 0){
$results = "Email address is invalid.";
$error = 1;
}

elseif((!filter_var($name, FILTER_SANITIZE_STRING)) && strlen($name) == 0){
$results = "Name is invalid.";
$error = 1;
}
	
elseif(strlen($pickupdate) == 0){
$results = "Date is invalid.";
$error = 1;
}

elseif((!filter_var($phone, FILTER_VALIDATE_INT)) && strlen($phone) == 0){
$results = "Phone number is invalid.";
$error = 1;
}

elseif(!filter_var($subject, FILTER_SANITIZE_STRING) && strlen($subject) == 0){
$results = "Subject is invalid.";
$error = 1;
}

elseif(!filter_var($contents, FILTER_SANITIZE_STRING) && strlen($contents) == 0){
$results = "Content is invalid.";
$error = 1;
}

if($error == 0){

	$headers = array('Content-Type: text/html; charset=UTF-8','From:'.$email. 'rn');
	if(wp_mail($admin_email, 'Website quote', $email_content, $headers)){
	$results = "<ion-icon name='checkmark-circle-outline' style='color:green'></ion-icon> Thanks for you enquiry.";
	}
	else{
	$results = "<ion-icon name='close-circle-outline' style='color:red'></ion-icon> The quote could not be sent.";
	}
}

// Return the String
die($results);
}

$image_count = 0;
function media_file_upload(){
	
	if( empty( $_FILES[ 'media_file' ] ) ) {
		wp_die( 'No files selected.' );
	}
	
	//Count uploads - 2 max
	$image_count ++;
	if($image_count == 2){
		wp_die( 'Max uploads' );
	}
	
	$upload = wp_handle_upload( 
		$_FILES[ 'media_file' ], 
		array( 'test_form' => false ) 
	);
	if( ! empty( $upload[ 'error' ] ) ) {
		wp_die( $upload[ 'error' ] );
	}
	
	$errors = array();
	$maxsize = 10485760;
    $acceptable = array(
        'application/pdf',
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    );
	
	if(($_FILES[ 'media_file' ]['size'] >= $maxsize) || ($_FILES[ 'media_file' ]["size"] == 0)) {
        $errors[] = 'File too large, must be less than 10 megabytes.';
    }
    if((!in_array($_FILES[ 'media_file' ]['type'], $acceptable)) && (!empty($_FILES[ 'media_file' ]["type"]))) {
        $errors[] = 'Invalid file type, only PDF, JPG, GIF and PNG types are accepted.';
    }
	if(count($errors) != 0) {
        foreach($errors as $error) {
            echo '<script>alert("'.$error.'");</script>';
        }
        die();
    }

	// it is time to add our uploaded image into WordPress media library
	$attachment_id = wp_insert_attachment(
		array(
		'guid'           => $upload[ 'url' ],
		'post_mime_type' => $upload[ 'type' ],
		'post_title'     => basename( $upload[ 'file' ] ),
		'post_content'   => $_POST[ 'cutomer_name' ],
		'post_status'    => 'inherit'
		),
		$upload[ 'file' ]
	);

	if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		wp_die( 'Upload error.' );
	}

	// update medatata, regenerate image sizes
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	wp_update_attachment_metadata(
		$attachment_id,
		wp_generate_attachment_metadata( $attachment_id, $upload[ 'file' ] )
	);
	die;
}

function ajaxcontact_shortcode_func( $atts ){
ob_start();
ajaxcontact_show_contact();
$output = ob_get_contents();
ob_end_clean();
return $output;
}
add_shortcode( 'ajaxcontact', 'ajaxcontact_shortcode_func' );

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_ajaxcontact_send_mail', 'ajaxcontact_send_mail' );
add_action( 'wp_ajax_ajaxcontact_send_mail', 'ajaxcontact_send_mail' );

add_action( 'wp_ajax_mediaupload', 'media_file_upload' );
add_action( 'wp_ajax_nopriv_mediaupload', 'media_file_upload' );
