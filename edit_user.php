<?php 
 
 	include plugin_dir_path(__FILE__).'menu.php';
 
?>
<div class="wrap custom-form-design">
<?php if(isset($updated)): ?>
	<div class="updated">
		<p> <?php _e('The user has been updated successfully', 'PKRVTECH_SMARTSite_Settings_class'); ?></p>
	</div>
<?php endif; ?>
<form method="post" name="createuser" id="createuser" class="validate" novalidate="novalidate" _lpchecked="1">
	<input type="hidden" name="_caa_update_user_nonce" value="<?php echo $caa_update_user_nonce; ?>" />
	<table class="form-table">
		<tbody>
			<tr class="form-field form-required">
				<th scope="row"><label for="user_login"><?php _e('Username', 'PKRVTECH_SMARTSite_Settings_class'); ?></label></th>
				<td><input name="user_login" disabled type="text" class="caa_field caa_small_field" id="user_login" value="<?php echo esc_attr($user->data->user_login); ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60">
				<p class="description"><?php _e('Unfortunately, WordPress does not allow the change of usernames', 'PKRVTECH_SMARTSite_Settings_class'); ?>.</p>
				</td>
			</tr>			
			<tr class="form-field form-required">
				<th scope="row"><label for="user_menu_access"><?php _e('Menu Access', 'PKRVTECH_SMARTSite_Settings_class'); ?> <span class="description">(<?php _e('required', 'PKRVTECH_SMARTSite_Settings_class'); ?>)</span></label></th>
				<td>
					
				<?php  $c = 1; foreach($caa_menu as $part): ?>
									<div class="caa_menuitems">
										<ul>
											<?php   foreach($part as $item): ?>
												  <li>
												  	<?php if(isset($item['sub_items'] )): ?>
												  		<span class="dashicons dashicons-arrow-right-alt2 caa_arrow" data-id="<?php echo $c; ?>"></span>
												  	<?php else: ?>
												  		<span class="dashicons dashicons-menu"></span>
												  	<?php endif; ?>
												    <input type="checkbox" name="main_items[]" value="<?php echo $item['slug']; ?>" id="<?php echo $item['slug']; ?>" <?php  PKRVTECH_SMARTSite_Settings_class::is_disabled($item['slug']); ?> >
												    <label for="<?php echo $item['slug']; ?>"><?php echo PKRVTECH_SMARTSite_Settings_class::prepare_title($item['title']); ?></label>
												    <?php if(isset($item['sub_items'] )): ?>
														    <ul class="subitem_menu" id="subitem_menu_<?php echo $c; ?>">
															<?php foreach($item['sub_items'] as $sub_item):
                                                                if (isset($sub_item[4]) && $sub_item[4] === 'hide-if-no-customize') continue; ?>
															      <li>
															        <input type="checkbox" name="sub_items[]" value="<?php echo $sub_item[2]; ?>" id="<?php echo $sub_item[1]; ?>" <?php PKRVTECH_SMARTSite_Settings_class::is_disabled($item['slug'], $sub_item[2]); ?> >
															        <label for="<?php echo $sub_item[1]; ?>"><?php echo $sub_item[0]; ?></label>
															      </li>
															<?php endforeach; ?>
														    </ul>
													<?php endif; ?>
												  </li>
											<?php $c++; endforeach; ?>
										</ul>
									</div>
				<?php endforeach; ?>
				</td>
			</tr>
						
		</tbody>
	</table>
<p class="submit">
	<input type="submit" name="updateuser" id="updateusersub" class="button button-primary" value="<?php _e('Update User', 'PKRVTECH_SMARTSite_Settings_class'); ?>">
</p>
</form>
</div>
