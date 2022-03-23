</main>
<footer>
    <?php if ($action == NULL || $action == "add_vehicle_form" ||
        $action == "list_makes" || $action == "list_types" ||
        $action == "list_classes") { ?>
    <p style="text-align:left;"><a href="index.php">View Full Vehicle List</a></p>
    <?php } if ($action != "add_vehicle_form") { ?>
        <p style="text-align:left;"><a href="?action=add_vehicle_form">Add Vehicle</a></p>
    <?php } if ($action != "list_makes") { ?>
        <p style="text-align:left;"><a href="?action=list_makes">View/Edit Vehicle Makes</a></p>    
    <?php } if ($action != "list_types") { ?>
    <p style="text-align:left;"><a href="?action=list_types">View/Edit Vehicle Types</a></p>    
    <?php } if ($action != "list_classes") { ?>
    <p style="text-align:left;"><a href="?action=list_classes">View/Edit Vehicle Classes</a></p>  
    <?php } ?>
    <br>
    <p>&copy; <?php echo date("Y"); ?> Zippy Used Autos</p>
</footer>
</body>
</html>