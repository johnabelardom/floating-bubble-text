<?php
    global $wpdb;
    $table_name = $wpdb->prefix . "floating_bubble_text";
    $id = $_GET["id"];
    $name = $_POST["name"];
    $picture_link = $_POST["picture_link"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
            $table_name, //table
            array('name' => $name, 'picture_link' => $picture_link), //data
            array('id' => $id), //where
            array('%s', '%s'), //data format
            array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update 
        $bubbles = $wpdb->get_results($wpdb->prepare("SELECT id, name, picture_link from $table_name where id=%s", $id));
        foreach ($bubbles as $s) {
            $name = $s->name;
            $picture_link = $s->picture_link;
        }
    }
    ?>
    <div class="wrap">
        <h2>Floating Bubbles</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Bubble deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=floating-bubble-main') ?>">&laquo; Back to bubbles list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Bubble updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=floating-bubble-main') ?>">&laquo; Back to bubbles list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $name; ?>"/></td></tr>
                    <tr><th>Picture Link</th><td><input type="text" name="picture_link" value="<?php echo $picture_link; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure you want to delete?')">
            </form>
        <?php } ?>

    </div>