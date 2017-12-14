<?php
    $name = $_POST["name"];
    $picture_link = $_POST["picture_link"];

    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "floating_bubble_text";

        if ($name != "" && $picture_link != "") {
            try {
    	        $wpdb->insert(
                    $table_name, //table
                    array('name' => $name, 'picture_link' => $picture_link) //, //data
    	        );
            	$message.="Floating Bubble Added";

    	    } catch( Exception $e ) {
    			echo "ERROR: ";
    			var_dump($e);
    		} 
        } else {
            ?>
            <div class="" style="color: red;"><p>Name and Picture Link is required.</p>
            <?php
        }
    }
    ?>
    <div class="wrap">
        <h2>Add New Bubble</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Name</th>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Picture Link</th>
                    <td><input type="text" name="picture_link" value="<?php echo $picture_link; ?>" class="ss-field-width" /></td>
                </tr>
            </table>
            <?php if (isset($message)) { ?>
                <a href="<?php echo admin_url('admin.php?page=floating-bubble-main') ?>">&laquo; Back to bubbles list</a>
            <?php } else { ?>
                <input type='submit' name="insert" value='Save' class='button'>
            <?php } ?>
        </form>
    </div>