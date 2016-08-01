<?php require_once('dbConfig.php'); ?>

<?php 

		function create_tables() {
			$link = db_connect();
			$query = "CREATE TABLE IF NOT EXISTS 
						employees (
						id INT UNSIGNED NOT NULL AUTO_INCREMENT,
						name VARCHAR(255),
						gender CHAR(10),						
						salary INT,
						PRIMARY KEY(id)
						) ENGINE=InnoDB CHARACTER SET=UTF8;";
			$result = mysqli_query($link, $query);
			if (!$result)
		    	return FALSE;	
			$query = "CREATE TABLE IF NOT EXISTS 
						country (
						id INT UNSIGNED NOT NULL AUTO_INCREMENT,
						name VARCHAR(255),
						PRIMARY KEY(id)
						) ENGINE=InnoDB CHARACTER SET=UTF8;";
			$result = mysqli_query($link, $query);
			if (!$result)
		    	return FALSE;	
			$query = "CREATE TABLE IF NOT EXISTS 
						city (
						id INT UNSIGNED NOT NULL AUTO_INCREMENT,
						country_id INT UNSIGNED NOT NULL,
						name VARCHAR(255),
						PRIMARY KEY(id),
						FOREIGN KEY (country_id) REFERENCES country(id)
						) ENGINE=InnoDB CHARACTER SET=UTF8;";
			$result = mysqli_query($link, $query);
			if (!$result)
		    	return FALSE;			    			    		
		    mysqli_close($link);
		   	return TRUE;
		}

		function getAllStudents() {
			$link = db_connect();
			$query = "SELECT * from students";
			$result = mysqli_query($link, $query);	
			if (mysqli_num_rows($result) > 0) {
				$students = array();
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		            $students[] = $row;                
		        }        
			}
			else {
				mysqli_free_result($result);
				mysqli_close($link);
				return FALSE;
			}
			mysqli_free_result($result);
			mysqli_close($link);
			return $students;
		}

		function getStudent($studentID) {
			$link = db_connect();
			$query = "SELECT * from students WHERE id = $studentID";
			$result = mysqli_query($link, $query);	
			if (mysqli_num_rows($result) !== 1) {
				mysqli_free_result($result);
		    	mysqli_close($link);
		        return FALSE;    
		    }
		    else {
		    	$student = mysqli_fetch_array($result, MYSQLI_ASSOC);
		    	mysqli_free_result($result);
		    	mysqli_close($link);
		    	return $student;
		    }	
		}	

		function db_connect() {
		  $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME); 

		  if (mysqli_connect_errno()) {
			     echo 'Ошибка при подключении к серверу баз данных - ' . mysqli_connect_errno();
			     die;
		     }
		  else
		    return $link;
		}

?>