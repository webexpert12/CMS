<?php 

$siteoptionGdpr = get_option('SMARTSite_settings_gdpr'); 
$contentGDPR = $siteoptionGdpr['pk_gdpr_content'];
$btn_text_color = ($siteoptionGdpr['pk_btn_text']) ? $siteoptionGdpr['pk_btn_text'] : '#fff';
$btn_bgcolor = ($siteoptionGdpr['pk_btn_bgcolor']) ? $siteoptionGdpr['pk_btn_bgcolor'] : '#006dcc';
$notice_textcolor = ($siteoptionGdpr['pk_notice_textcolor']) ? $siteoptionGdpr['pk_notice_textcolor'] : '#fff';
$notice_bgcolor = ($siteoptionGdpr['pk_notice_bgcolor']) ? $siteoptionGdpr['pk_notice_bgcolor'] : '#000';

echo "<div class='pk_smartsite_gdpr' style='display:none;background-color:".$notice_bgcolor."!important;'>
	<div class='pk_smartsite_gdpr_notice' style='color:".$notice_textcolor."!important;'>".stripslashes($contentGDPR)."</div>
	<div class='pk_gdpr_enable'><span style='color:".$btn_text_color."!important; background-color:".$btn_bgcolor."!important;'>Accept</span></div>
	<div class='pk_gdpr_reject'><span>Reject</span></div>
</div>";		
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	var cookiePK = jQuery.cookie("smartsite_pk_cookie");	
	if(cookiePK == 'yes'){
		jQuery('.pk_smartsite_gdpr').hide();
	}else{
		jQuery('.pk_smartsite_gdpr').show();
	}
	jQuery('.pk_gdpr_enable').click(function(){
		var cookieval = '<?php echo  $siteoptionGdpr['pk_gdpr_cookie'] ?>';
		jQuery('.pk_smartsite_gdpr').hide();
		console.log(cookieval);
		if(cookieval == 'on'){	  		
			var date = new Date();
			date.setTime(date.getTime() + 7*24*60*60*1000, { path: '/' }); 

			jQuery.cookie('smartsite_pk_cookie', 'yes', {
				expires: date
			});
		}
	});	

	jQuery('.pk_gdpr_reject').click(function(e){ //cookie save rejected
		e.preventDefault();
		jQuery('.pk_smartsite_gdpr').hide();
	})

	
});
</script>