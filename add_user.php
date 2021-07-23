<?php 
 if(!isset($_GET['action'])){
  include plugin_dir_path(__FILE__).'menu.php';
 }
?>
<div style="overflow-x:hidden; padding: 0 20px 0 0;">
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<?php 
        global $menu; 	          
          echo '<form class="editor-menuss" method="POST">';
		  foreach ($menu as $key => $value) { 
			if($value[0]) { ?>

               	<input type="hidden" name="menu_id[]" value="<?php echo $key; ?>">
              	<input type="text" name="menu_name[]" value="<?php echo strip_tags($value[0]); ?>">														
		    <?php } } 			
             echo '<button type="submit" name="submitCZXCZ" value="update">update</button>';
             echo '</form>';           
             if(isset($_POST['submitCZXCZ']))  {             
                $as = $_POST['menu_id'];
                $ad = $_POST['menu_name'];
               $arr =  array_combine($as, $ad);
                 update_option( 'rename_admin_menu', $arr, '', 'yes' );  
           }         
           if(!$ad==""){
              
               ?> <script><?php echo("location.href = '".admin_url()."admin.php?page=menusee'");?></script><?php
 
              }
     ?>
	</div>


  <div class="">
    <?php
     
            $Ank  = get_option('ghfg_admin_menu');
            echo '<form class="editor-menuss" method="POST">';
            foreach($Ank as $akey => $a_valuess) {
             if($a_valuess[0]) { ?>

              <input type="hidden" name="menu_id[]" value="<?php echo $akey; ?>" readonly>
                    <input type="text" name="menu_name[]" value="<?php echo strip_tags($a_valuess[0]); ?>" readonly>
        <?php } } 
         echo '<button type="submit" name="reset" value="reset">Reset</button>';
                 echo '</form>';           
                 if(isset($_POST['reset']))  {                               
                     delete_option( 'rename_admin_menu' ); 
                    ?> <script><?php echo("location.href = '".admin_url()."admin.php?page=menusee'");?></script><?php
               }   
    ?>
   </div>
</div>
</div>










    
