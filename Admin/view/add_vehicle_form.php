<?php include('header.php'); ?>

    <main>
        <h1>Add vehicle</h1>
        <form action="index.php" method="post" id="add_vehicle_form">
            <input type="hidden" name="action" value="add_vehicle">
            <label>Make:</label>
            <select name="make_id">
            <?php foreach ($makes as $make) : ?>
                <option value="<?php echo $make['ID']; ?>">
                    <?php echo $make['Make']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Type:</label>
            <select name="type_id">
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type['ID']; ?>">
                    <?php echo $type['Type']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Class:</label>
            <select name="class_id">
            <?php foreach ($classes as $class) : ?>
                <option value="<?php echo $class['ID']; ?>">
                    <?php echo $class['Class']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Year:</label>
            <input type="number" name="year"><br>

            <label>Model:</label>
            <input type="text" name="model"><br>
            
            <label>Price:</label>
            <input type="number" name="price"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Vehicle" style='max-width:100px; font-weight:bold;'><br>
        </form>
    </main>
    <?php include('status.php'); ?>
    <br>
<?php include('footer.php'); ?>