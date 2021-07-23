<?php   if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="wrap">
    <div class="container">
    <div class="form_center">
    <form >
        <div class="form-group">
            <label for="license_key">License Key</label>
            <input type="password" class="form-control" id="license_key" aria-describedby="emailHelp" placeholder="License Key">           
        </div>        
        <button type="submit" class="btn btn-primary activate_license">Activate</button>
    </form>
    </div>
    </div>
</div>


<script>
    jQuery(".activate_license").click(function(e){
	e.preventDefault();
	var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' )?>";
	var license_key = jQuery('#license_key').val();
	var data = {
			'action': 'check_license_key',
			'license_key': license_key,			
	};    
	jQuery.post(ajaxurl, data, function(response) {
		
	});	
});
</script>