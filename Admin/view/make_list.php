<?php include('header.php'); ?>
<br>
    <?php 
    if (!empty($makes)) { ?>
        <table>
            <tr>
                <th>Make</th>
                <th>&nbsp;</th>
            </tr>        
            <?php foreach ($makes as $make) : ?>
            <tr>
                <td><?php echo $make['Make']; ?></td>
                <td>
                    <form action="index.php" method="post" id="delete_make">
                        <input type="hidden" name="action" value="delete_make">
                        <input type="hidden" name="make_id" value="<?php echo $make['ID']; ?>"/>
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    <?php } else { ?>
	    <p style="font-weight:bold">No make items exist. Please add a make!</p><br><br>
	<?php } ?>

    <h2 class="margin_top_increase">Add Make</h2>
    <form action="index.php" method="post" id="add_make_form">
        <input type="hidden" name="action" value="add_make">
        <label>Make:</label>
        <input type="text" name="make" />
        <input id="add_make_button" type="submit" value="Add"/>
    </form>
    <?php include('status.php'); ?>
    <br>
<?php include('footer.php'); ?>