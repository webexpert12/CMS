<?php 
 if(!isset($_GET['action'])){
 	include plugin_dir_path(__FILE__).'menu.php';
 }
?>
<div class="wrap custom-form-design">	

<form method="post" name="createuser" id="createuser" class="validate" novalidate="novalidate" _lpchecked="1">

 	<?php //echo "<pre>"; //print_r($caa_create_user_nonce); echo "</pre>";  ?>
	

	<table class="form-table">
		<tbody>
              <?php
               global $wpdb;  
               $tableee_name = $wpdb->prefix ."users";  
                 $abc = $wpdb->get_results("SELECT ID, user_login FROM $tableee_name order by ID");                
                // unset($abc['0']);
                 if(!empty($abc)) { ?> 
                  <label for="User">Select the user for the dashboard pages</label>     
                   <select name="user_login" id ="user_login"> 
                    <?php foreach ($abc as $abc_data) { ?> 
                 <option value = "<?php echo $abc_data->ID; ?>"> <?php echo $abc_data->user_login; ?> </option>
                       <?php } ?>               
                    </select> 
                   <?php } ?> 
                   <br>
                   <br>
               <!--  <label for="User_role"> Select the user role </label> -->
                <!-- <?php
				   $roles_obj = new WP_Roles();				   
				    $roles_names_array = $roles_obj->get_names();				  
				    unset($roles_names_array['administrator']);
				    echo '<select name="role-name">';
				   foreach ($roles_names_array as $role_name) {
				    echo '<option>'.$role_name.'</option>';
				  }
				   echo '</select>';
                ?>  --> 
                   
			  <tr class="form-field form-required">
				<th scope="row"><label for="user_menu_access"><?php _e('Menu Access','PKRVTECH_SMARTSite_Settings_class'); ?> <span class="description">(required)</span></label></th>
				<td>
				<?php $c = 1; 
                       

				 foreach($caa_menu as $part): ?>
									<div class="caa_menuitems">
										<ul>
											<?php   foreach($part as $item): ?>
												  <li>
												  	<?php if(isset($item['sub_items'] )):											  	
												  	?>
												  		<span class="dashicons dashicons-arrow-right-alt2 caa_arrow" data-id="<?php echo $c; ?>"></span>

												  	<?php else: ?>

												  		<span class="dashicons dashicons-menu"></span>
												  	<?php endif; ?>

												    <input type="checkbox" name="main_items[]" value="<?php echo $item['slug']; ?>" id="<?php echo $item['slug']; ?>" <?php  $this->is_disabled($item['slug']);
												     ?> >

												    <label for="<?php echo $item['slug']; ?>"><?php echo $this->prepare_title($item['title']); ?></label>

												    <?php if(isset($item['sub_items'] )): ?>

														    <ul class="subitem_menu" id="subitem_menu_<?php echo $c; ?>">

															<?php foreach($item['sub_items'] as $sub_item):
                                                                if (isset($sub_item[4]) && $sub_item[4] === 'hide-if-no-customize') continue; ?>

															      <li>

															        <input type="checkbox" name="sub_items[]" value="<?php echo $sub_item[2]; ?>" id="<?php echo $sub_item[1]; ?>" <?php $this->is_disabled($item['slug'], $sub_item[2]); ?> >

															        <label for="<?php echo $sub_item[1]; ?>">

															        	<?php echo $sub_item[0]; ?></label>

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
	<input type="submit" name="createuser" id="createusersub" class="button button-primary" value="<?php _e('Manage permission','PKRVTECH_SMARTSite_Settings_class'); ?>">
</p>
</form>
</div>

<?php 
if(isset($_POST['createuser'])) { 

	?> <script><?php echo("location.href = '".admin_url()."admin.php?page=marketplace-user-role'");?></script><?php

}
?>