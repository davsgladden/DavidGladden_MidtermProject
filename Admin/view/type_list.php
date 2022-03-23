<?php include('header.php'); ?>
<br>
    <?php 
    if (!empty($types)) { ?>
        <table>
            <tr>
                <th>Type</th>
                <th>&nbsp;</th>
            </tr>        
            <?php foreach ($types as $type) : ?>
            <tr>
                <td><?php echo $type['Type']; ?></td>
                <td>
                    <form action="index.php" method="post" id="delete_type">
                        <input type="hidden" name="action" value="delete_type">
                        <input type="hidden" name="type_id" value="<?php echo $type['ID']; ?>"/>
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    <?php } else { ?>
	    <p style="font-weight:bold">No types exist. Please add a type!</p><br><br>
	<?php } ?>

    <h2 class="margin_top_increase">Add Type</h2>
    <form action="index.php" method="post" id="add_type_form">
        <input type="hidden" name="action" value="add_type">
        <label>Type:</label>
        <input type="text" name="type" />
        <input id="add_type_button" type="submit" value="Add"/>
    </form>
    <?php include('status.php'); ?>
    <br>
<?php include('footer.php'); ?>