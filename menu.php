<h1><?php _e('Controlled Admin Access', 'PKRVTECH_SMARTSite_Settings_class'); ?></h1>

<h2 class="nav-tab-wrapper">
  <a href="<?php echo admin_url('admin.php?page=marketplace-user-role') ?>" class="nav-tab <?php if($_GET['page'] == 'marketplace-user-role'){ echo 'nav-tab-active'; } ?>"><?php _e('User Capability', 'PKRVTECH_SMARTSite_Settings_class'); ?></a>

  <a href="<?php echo admin_url('admin.php?page=Manage-user-role') ?>" class="nav-tab <?php if($_GET['page'] == 'Manage-user-role'){ echo 'nav-tab-active'; } ?>"><?php echo _e('Manage user role', 'PKRVTECH_SMARTSite_Settings_class'); ?></a>

   <a href="<?php echo admin_url('admin.php?page=menusee') ?>" class="nav-tab <?php if($_GET['page'] == 'menusee'){ echo 'nav-tab-active'; } ?>"><?php echo _e('Menu Editor', 'PKRVTECH_SMARTSite_Settings_class'); ?></a>
</h2>