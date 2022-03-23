<?php include('header.php') ?>


    <br>
    <section>
        <form name="myform" action="index.php" method="post">
            <select name="makes" id="makes">
                <option value=".?make_ID=-1">View All Makes</option>
                <?php foreach ($makes as $make_items) : ?>
                    <option value="?make_ID=<?php echo $make_items['ID']; ?>"
                        <?php if($make_items['ID'] == $make_ID) { ?> selected <?php } ?>> 
                    <?php echo $make_items['Make']; ?>
                </option>
            <?php endforeach; ?>
            </select><br><br>
            <select name="types" id="types">
                <option value="type_ID=-1">View All Types</option>
                <?php foreach ($types as $type_items) : ?>
                <option value="type_ID=<?php echo $type_items['ID']; ?>"
                    <?php if($type_items['ID'] == $type_ID) { ?> selected <?php } ?>> 
                    <?php echo $type_items['Type']; ?>
                </option>
            <?php endforeach; ?>
            </select><br><br>
            <select name="classes" id="classes">
                <option value="class_ID=-1">View All Classes</option>
                <?php foreach ($classes as $class_items) : ?>
                <option value="class_ID=<?php echo $class_items['ID']; ?>"
                    <?php if($class_items['ID'] == $class_ID) { ?> selected <?php } ?>> 
                    <?php echo $class_items['Class']; ?>
                </option>
            <?php endforeach; ?>
            </select><br><br>
            <label>Sort by:</label>
            <input type="radio" id="Price" name="sort" value="orderBy=Price" 
                <?php if ($orderBy=="Price") { ?> checked <?php } ?>>
                <label for="Price">Price</label>
            <input type="radio" id="Year" name="sort" value="orderBy=Year"
                <?php if ($orderBy=="Year") { ?> checked <?php } ?>>
                <label for="Year">Year</label>
            <input type="button" value="Submit" onClick='redirectPage()' style='font-weight:bold;'/>
        </form>
    </section>
   <?php 
        if ($vehicles) { ?>
            <section>
                <!-- display a table of vehicles -->
                <div style='overflow-x:auto'>
                <table>
                    <tr>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Class</th>
                        <th>Price</th>
                    </tr>

                    <?php foreach ($vehicles as $rows) : ?>
                            <tr>
                                <td><?php echo $rows['Year']; ?></td>
                                <td><?php echo $rows['Make']; ?></td>
                                <td><?php echo $rows['Model']; ?></td>
                                <td><?php echo $rows['Type']; ?></td>
                                <td><?php echo $rows['Class']; ?></td>
                                <td><?php echo $rows['Price']; ?></td>
                                <td>
                                    <form action="index.php" method="post" id="delete_vehicle">
                                        <input type="hidden" name="action" value="delete_vehicle">
                                        <input type="hidden" name="vehicle_id" value="<?php echo $rows['Vehicle_ID']; ?>"/>
                                        <input type="submit" value="Delete"/>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                </table>
                </div>
		<?php } else if (sizeof($vehicles)<1) {?>
                <p style="font-weight:bold">No more vehicles left for this selection. Please select a different make, type, or class.</p><br><br>
         <?php } ?>
            </section>
<?php include('footer.php') ?>
<script>
let redirectPage = () => {
    let url ='index.php';
    let v1 = document.getElementById('makes');
    let v2 = document.getElementById('types');
    let v3 = document.getElementById('classes');
    let v4 = '';
    if(document.getElementById('Year').checked) {
        v4 = document.getElementById('Year');
    } else {
        v4 = document.getElementById('Price');
    }

    let new_url = url + v1.value + '&' + v2.value + '&' + v3.value + '&' + v4.value;

    window.location.href = new_url;
}
</script>
