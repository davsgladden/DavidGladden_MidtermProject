<?php

	// select all vehicles -default ordering
	function get_vehicles($type_ID, $make_ID, $class_ID, $orderBy) {
		global $db;
		$query = 'SELECT
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

	// select all vehicles -default ordering
	function get_vehiclesByMake($make_ID) {
		global $db;
		$query = 'SELECT
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
                  Where m.ID = :make_ID
                  Order by price desc';

        $statement = $db->prepare($query);
        $statement->bindValue(':make_ID', $make_ID);
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

    	// select all vehicles -default ordering
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

    	// select all vehicles -default ordering
	function get_TypeName($type_ID) {
		global $db;
		$query = 'SELECT *
                  From Types
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

    	// select all vehicles -default ordering
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
?>