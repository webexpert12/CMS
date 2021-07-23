<div class="wrap">
<?php 
 if(!isset($_GET['action'])){
 	include plugin_dir_path(__FILE__).'menu.php';
 }
?>
	<form id="events-filter" method="get" action="">
		<input type="hidden" name="noheader" value="true" />
	    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
	    <?php //print_r($testListTable);
	     $testListTable->display() ?>
	</form>
</div>
