<?php include('header.php'); ?>
<br>
    <?php 
    if (!empty($classes)) { ?>
        <table>
            <tr>
                <th>Class</th>
                <th>&nbsp;</th>
            </tr>        
            <?php foreach ($classes as $class) : ?>
            <tr>
                <td><?php echo $class['Class']; ?></td>
                <td>
                    <form action="index.php" method="post" id="delete_class">
                        <input type="hidden" name="action" value="delete_class">
                        <input type="hidden" name="class_id" value="<?php echo $class['ID']; ?>"/>
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    <?php } else { ?>
	    <p style="font-weight:bold">No class exists. Please add a class!</p><br><br>
	<?php } ?>

    <h2 class="margin_top_increase">Add Class</h2>
    <form action="index.php" method="post" id="add_class_form">
        <input type="hidden" name="action" value="add_class">
        <label>Class:</label>
        <input type="text" name="class" />
        <input id="add_class_button" type="submit" value="Add"/>
    </form>
    <?php include('status.php'); ?>
    <br>
<?php include('footer.php'); ?>