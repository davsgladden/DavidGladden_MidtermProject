<?php
require_once('model/database.php');
require_once('model/zippyusedautos_db.php');

	$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
	if(!$action) {
		$action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
		if(!$action) {
			$action = 'list_vehicles';
		}
	}

// views
if ($action == 'list_vehicles') {
    $type_ID = filter_input(INPUT_GET, 'type_ID', FILTER_VALIDATE_INT);
    $make_ID = filter_input(INPUT_GET, 'make_ID', FILTER_VALIDATE_INT);
    $class_ID = filter_input(INPUT_GET, 'class_ID', FILTER_VALIDATE_INT);
    $orderBy = filter_input(INPUT_GET, 'orderBy', FILTER_UNSAFE_RAW);
	if ($type_ID == NULL || $type_ID == FALSE) {$type_ID = -1;}
	if ($make_ID == NULL || $make_ID == FALSE) {$make_ID = -1;}
	if ($class_ID == NULL || $class_ID == FALSE) {$class_ID = -1;}
	if ($orderBy == NULL || $orderBy == FALSE) {$orderBy = "Price";}

		$vehicles = get_vehicles($type_ID, $make_ID, $class_ID, $orderBy);

	$makes = get_makes();
	$types = get_types();
	$classes = get_classes();
	$orderBy = $orderBy;
	include('view/vehicle_list.php');

} else if ($action == 'add_vehicle_form') {
	$makes = get_makes();
	$types = get_types();
	$classes = get_classes();
	include('view/add_vehicle_form.php');

} else if ($action == 'list_makes') {
	$makes = get_makes();
	include('view/make_list.php');

} else if ($action == 'list_types') {
	$types = get_types();
	include('view/type_list.php');

}  else if ($action == 'list_classes') {
	$classes = get_classes();
	include('view/class_list.php');

// inserts
} else if ($action == 'add_vehicle') {
	$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
	$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
	$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
	$year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
	$model = filter_input(INPUT_POST, 'model', FILTER_UNSAFE_RAW);
	$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
	if ($make_id == NULL || $type_id == NULL|| $class_id == NULL ||
		$year == NULL || $model == NULL || $price == NULL) {
		$error_message = "Invalid data. Check all fields and try again.";
		include('view/error.php');
	} else {
		$count = insert_vehicle($make_id, $type_id, $class_id, $year, $model, $price);
		header("Location: .?action=add_vehicle_form&created={$count}");
	}

} else if ($action == 'add_make') {
	$make = filter_input(INPUT_POST, 'make', FILTER_UNSAFE_RAW);
	if ($make == NULL) {
		$error_message = "Invalid data. Check all fields and try again.";
		include('view/error.php');
	} else {
		$count = insert_make($make);
		header("Location: .?action=list_makes&created={$count}");
	}

} else if ($action == 'add_type') {
	$type = filter_input(INPUT_POST, 'type', FILTER_UNSAFE_RAW);
	if ($type == NULL) {
		$error_message = "Invalid data. Check all fields and try again.";
		include('view/error.php');
	} else {
		$count = insert_type($type);
		header("Location: .?action=list_types&created={$count}");
	}

} else if ($action == 'add_class') {
	$class = filter_input(INPUT_POST, 'class', FILTER_UNSAFE_RAW);
	if ($class == NULL) {
		$error_message = "Invalid data. Check all fields and try again.";
		include('view/error.php');
	} else {
		$count = insert_class($class);
		header("Location: .?action=list_classes&created={$count}");
	}


// deletes
} else if ($action == 'delete_vehicle') {
	$vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
	if ($vehicle_id == NULL || $vehicle_id == FALSE) {
		$error_message = "Missing or incorrect Vehicle_ID.";
		include('view/error.php');
	} else {
		$count = delete_vehicle($vehicle_id);
		header("Location: .?action=list_vehicles&deleted={$count}");
	}

} else if ($action == 'delete_make') {
	$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
	if ($make_id == NULL || $make_id == FALSE) {
		$error_message = "Missing or incorrect MakeID.";
		include('view/error.php');
	} else {
		$count = delete_make($make_id);
		header("Location: .?action=list_makes&deleted={$count}");
	}

} else if ($action == 'delete_type') {
	$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
	if ($type_id == NULL || $type_id == FALSE) {
		$error_message = "Missing or incorrect MakeID.";
		include('view/error.php');
	} else {
		$count = delete_type($type_id);
		header("Location: .?action=list_types&deleted={$count}");
	}

} else if ($action == 'delete_class') {
	$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
	if ($class_id == NULL || $class_id == FALSE) {
		$error_message = "Missing or incorrect MakeID.";
		include('view/error.php');
	} else {
		$count = delete_class($class_id);
		header("Location: .?action=list_classes&deleted={$count}");
	}
}
?>