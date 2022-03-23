<?php

	// dynamic select vehicles 
	function get_vehicles($type_ID, $make_ID, $class_ID, $orderBy) {
		global $db;
		$query = 'SELECT
                     Vehicle_ID,
	                 Year,
                     Make,
                     Model,
                     Type,
                     Class,
                     CONCAT("$", format(Price, 2)) as Price 
                  From vehicles v
	                  join makes m 
                      on v.Make_ID = m.ID
    	                  join types t 
                          on v.Type_ID = t.ID
        	                  join classes c 
                              on V.Class_ID = C.ID
                  Where 1=1';

         if($type_ID != -1) {
              $query .= ' and V.Type_ID = :type_ID';
         }
         if($make_ID != -1) {
              $query .= ' and V.Make_ID = :make_ID';
         }
         if($class_ID != -1) {
              $query .= ' and V.Class_ID = :class_ID';
         }
         if($orderBy == "Year") {
              $query .= ' Order by Year desc';
         } else {
              $query .= ' Order by ABS(Price) desc';
         }
        $statement = $db->prepare($query);
        if($type_ID != -1) {$statement->bindValue(':type_ID', $type_ID);}
        if($make_ID != -1) {$statement->bindValue(':make_ID', $make_ID);}
        if($class_ID != -1) {$statement->bindValue(':class_ID', $class_ID);}
        $statement->execute();
        $vehicles = $statement->fetchAll();
        $statement->closeCursor();
        return $vehicles;
	}

    // select all Makes
	function get_Makes() {
		global $db;
		$query = 'SELECT *
                  From makes
                  Order by Make';

        $statement = $db->prepare($query);
        $statement->execute();
        $makes = $statement->fetchAll();
        $statement->closeCursor();
        return $makes;
	}

    // select make name
	function get_MakeName($make_ID) {
		global $db;
		$query = 'SELECT *
                  From makes
                  Where ID = :make_ID';

        $statement = $db->prepare($query);
        $statement->bindValue(':make_ID', $make_ID);
        $statement->execute();
        $make = $statement->fetch();
        $makeName = $make['Make'] ??= "All";
        $statement->closeCursor();
        return $makeName;
	}   
    
    // select all Types
	function get_Types() {
		global $db;
		$query = 'SELECT *
                  From types
                  Order by Type';

        $statement = $db->prepare($query);
        $statement->execute();
        $types = $statement->fetchAll();
        $statement->closeCursor();
        return $types;
	}

    // select type name
	function get_TypeName($type_ID) {
		global $db;
		$query = 'SELECT *
                  From types
                  Where ID = :type_ID';

        $statement = $db->prepare($query);
        $statement->bindValue(':type_ID', $type_ID);
        $statement->execute();
        $type = $statement->fetch();
        $typeName = $type['Type'] ??= "All";
        $statement->closeCursor();
        return $typeName;
	}

    // select all Classes
	function get_Classes() {
		global $db;
		$query = 'SELECT *
                  From classes
                  Order by Class';

        $statement = $db->prepare($query);
        $statement->execute();
        $classes = $statement->fetchAll();
        $statement->closeCursor();
        return $classes;
	}

    // select class name
	function get_ClassName($class_ID) {
		global $db;
		$query = 'SELECT *
                  From classes
                  Where ID = :class_ID';

        $statement = $db->prepare($query);
        $statement->bindValue(':class_ID', $class_ID);
        $statement->execute();
        $class = $statement->fetch();
        $className = $class['Class'] ??= "All";
        $statement->closeCursor();
        return $className;
	}

    // add vehicle to the database
     function insert_vehicle($make_id, $type_id, $class_id, $year, $model, $price) {
        global $db;
        // Add the product to the database  
        $query = 'INSERT INTO vehicles
                     (Year, Model, Price, Type_ID, Class_ID, Make_ID)
                  VALUES
                     (:year, :model, :price, :type_ID, :class_ID, :make_ID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':year', $year);
        $statement->bindValue(':model', $model);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':type_ID', $type_id);
        $statement->bindValue(':make_ID', $make_id);
        $statement->bindValue(':class_ID', $class_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
     }

    // Add the make to the database  
    function insert_make($make) {
        global $db;
        $query = 'INSERT INTO makes (Make)
                  VALUES (:make)';
        $statement = $db->prepare($query);
        $statement->bindValue(':make', $make);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Add the type to the database  
    function insert_type($type) {
        global $db;
        $query = 'INSERT INTO types (Type)
                  VALUES (:type)';
        $statement = $db->prepare($query);
        $statement->bindValue(':type', $type);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Add the Class to the database  
    function insert_class($class) {
        global $db;
        $query = 'INSERT INTO classes(class)
                  VALUES (:class)';
        $statement = $db->prepare($query);
        $statement->bindValue(':class', $class);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Delete vehicle from database
    function delete_vehicle($vehicle_id) {
        global $db;
        $query = 'DELETE FROM vehicles 
                  WHERE Vehicle_ID = :vehicle_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':vehicle_id', $vehicle_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Delete make from database
    function delete_make($make_id) {
        global $db;
        $query = 'DELETE FROM makes 
                  WHERE ID = :make_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':make_id', $make_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Delete type from database
    function delete_type($type_id) {
        global $db;
        $query = 'DELETE FROM types 
                  WHERE ID = :type_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':type_id', $type_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Delete class from database
    function delete_class($class_id) {
        global $db;
        $query = 'DELETE FROM classes 
                  WHERE ID = :class_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':class_id', $class_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }
?>