<?php
class Query {

	protected $prefix = "prefix_";
	protected $serverName = "yourServerName";
	protected $userName = "userName";
	protected $password = "password";
	protected $dbName = "dbName";

	public function _Select($table, $params, $where, $order = false, $ord = '')
	{ 
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "SELECT ";
		foreach ($params as $key => $value) {
			$query.= $mysqli->real_escape_string($value).", ";			
		}
		$query = substr($query, 0, -2);
		$query .= " FROM ".$mysqli->real_escape_string($table)." ";
		if(!empty($where)){
			$query .= "WHERE ";
			foreach ($where as $key => $value) {
				$res=gettype($value);
				if($res != "Integer")
				{
					$query .= $mysqli->real_escape_string($key)."="."'".$mysqli->real_escape_string($value)."' AND ";
				}
				else
				{
					$query .= $mysqli->real_escape_string($key)."=".$mysqli->real_escape_string($value)." AND ";
				}
			}
			$query = substr($query, 0, -4);
		}
		if($order)
		{
			if($ord != '')
			{
				$query.=" ORDER BY ".$ord." DESC";
			}
			else{
				$query.=" ORDER BY id DESC";
			}
		}
		else{
		    if($ord == '') {
		        $query .=" ORDER BY id";    
		    } else {
		        $query.=" ORDER BY ".$ord;
		    }
		}
		$result = $this->_Execute($query, $params);
		mysqli_close($mysqli);
		return $result;
	}
	
	public function _SelectInRange($table, $params, $where, $order = false, $ord = '')
	{
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "SELECT ";
		foreach ($params as $key => $value) {
			$query.= $mysqli->real_escape_string($value).", ";			
		}
		$query = substr($query, 0, -2);
		$query .= " FROM ".$mysqli->real_escape_string($table)." ";
		if(!empty($where)){
			$query .= "WHERE ";
			foreach ($where as $key => $value) {
				$query .= $mysqli->real_escape_string($key)." IN (".$mysqli->real_escape_string($value).") AND ";
			}
			$query = substr($query, 0, -4);
		}
		if($order)
		{
			if($ord != '')
			{
				$query.=" ORDER BY ".$ord." DESC";
			}
			else{
				$query.=" ORDER BY id DESC";
			}
		}
		else{
		    $query .=" ORDER BY id";
		}
        $result = $this->_Execute($query, $params);
		mysqli_close($mysqli);
		return $result;
	}

	public function _Insert($table, $params)
	{
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "INSERT INTO ".$mysqli->real_escape_string($table)." (";
		foreach ($params as $key => $value) {
			$query .= $mysqli->real_escape_string($key).", ";
		}
		$query = substr($query, 0, -2);
		$query.= ") VALUES (";
		foreach ($params as $key => $value) {
			$res=gettype($value);
			if($res != "Integer")
				{
			$query.="'".$mysqli->real_escape_string($value)."', ";
		}
		else
				{
					$query.=$mysqli->real_escape_string($value).", ";
				}
		}
		$query = substr($query, 0, -2);
		$query.= ")";
		$result = $this->_Execute($query, array());
		mysqli_close($mysqli);
		return $result;
	}

	public function _Update($table, $params, $where, $symbol = 0)
	{
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "UPDATE ".$mysqli->real_escape_string($table)." SET ";
		foreach ($params as $key => $value) {
			$query .= $mysqli->real_escape_string($key)."='".$mysqli->real_escape_string($value)."', ";
		}
		$query=substr($query, 0, -2);
		$query .= " WHERE "; 
		if($symbol == 0){
		    foreach ($where as $key => $value) {
			$query .= $mysqli->real_escape_string($key)."='".$mysqli->real_escape_string($value)."' AND ";
		}
		}
		else{
		    $i = 0;
		    foreach ($where as $key => $value) {
			$query .= $mysqli->real_escape_string($key).$symbol[$i]."'".$mysqli->real_escape_string($value)."' AND ";
			$i++;
		}
		}
		$query=substr($query, 0, -4);
		$result = $this->_Execute($query, array());
		mysqli_close($mysqli);
		return $result;
	}

	public function _Delete($table, $where)
	{
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "DELETE FROM ".$mysqli->real_escape_string($table);
		$query .= " WHERE "; 
		foreach ($where as $key => $value) {
			$query .= $mysqli->real_escape_string($key)."='".$mysqli->real_escape_string($value)."' AND ";
		}
		$query=substr($query, 0, -4);
		$result = $this->_Execute($query, array());
		mysqli_close($mysqli);
		return $result;
	}

	public function _SelectMoreOrLess($table, $params, $where, $symbols, $order = false, $ord='')
	{
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "SELECT ";
		foreach ($params as $key => $value) {
			$query.= $mysqli->real_escape_string($value).", ";			
		}
		$query = substr($query, 0, -2);
		$query .= " FROM ".$mysqli->real_escape_string($table)." ";
		if(!empty($where)){
			$query .= "WHERE ";
			$i = 0;
			foreach ($where as $key => $value) {
				$res=gettype($value);
				if($res != "Integer")
				{
					$query .= $mysqli->real_escape_string($key).$symbols[$i]."'".$mysqli->real_escape_string($value)."' AND ";
				}
				else
				{
					$query .= $mysqli->real_escape_string($key).$symbols[$i].$mysqli->real_escape_string($value)." AND ";
				}
				$i++;
			}
			$query = substr($query, 0, -4);
		}
		
		if($order)
		{
			if($ord != '')
			{
				$query.=" ORDER BY ".$ord." DESC";
			}
			else{
				$query.=" ORDER BY id DESC";
			}
		}
		else{
		    $query .=" ORDER BY id";
		}
		$result = $this->_Execute($query, $params);
		mysqli_close($mysqli);
		return $result;
	}

	public function _getCount($table, $params)
	{
		$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
		mysqli_query($mysqli, "SET NAMES 'utf8'");
		$table = $this->prefix.$table;
		$query = "SELECT COUNT(*) FROM ".$mysqli->real_escape_string($table)." WHERE";
		foreach ($params as $key => $value) {
			$res=gettype($value);
			if($res != "Integer"){
				$query .= " ".$mysqli->real_escape_string($key)."='".$mysqli->real_escape_string($value)."',";
			}
			else
			{
				$query .= " ".$mysqli->real_escape_string($key)."=".$mysqli->real_escape_string($value).",";
			}
		}
		$query = substr($query, 0, -1);
		$par = array();
		$par[0] = "COUNT(*)";
		$result = $this->_Execute($query, $par);
		mysqli_close($mysqli);
		return $result;
	}

	protected function _Execute($query, $res)
	{

		if(count($res)>0)
		{
			$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
			mysqli_query($mysqli, "SET NAMES 'utf8'");
			$stmt = mysqli_query( $mysqli, $query);  
			if( $stmt === false)  
			{  				
     			$result = $mysqli->error;
     			echo $result;
     			mysqli_close($mysqli);
     			die();
     			return null;
			}						
			$i = 0;
			$result = array();
			while($row = $stmt->fetch_assoc())
			{								
				foreach ($res as $key => $value) 
				{
					$result[$i][$value] = $row[$value];
				}

				$i++;
			}		
			mysqli_close($mysqli);
			return $result;
		}
		else
		{
			$mysqli = new mysqli( $this->serverName, $this->prefix.$this->userName, $this->password, $this->prefix.$this->dbName);
			mysqli_query($mysqli, "SET NAMES 'utf8'");
			$stmt = mysqli_query( $mysqli, $query);  
			if( $stmt === false)  
			{    
     			$result = $mysqli->error;
     			mysqli_close($mysqli);
     			return $result; 
			}  
			else
			{
				return null;
			}
			mysqli_close($mysqli);  
		}		
	}
}
?>