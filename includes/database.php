<?php

	include_once("constant.php");
	
	class Database
	{
		
		
		function connectDb()
		{
			$conn=mysqli_connect(SERVER,USERNAME,PASSWORD, databaseName)or  die("Failed Connecting To Mysql");
		//	$seldb=mysqli_select_db(databaseName)or Die("Failed Connecting To Database");
			
			return $conn;
		}

		function disconnectDb()
		{
			mysqli_close($conn);
		}
		
		
		function execute($sql)
		{
			$query=mysqli_query($this->connectDb(),$sql) or die(mysqli_error($this->connectDb()));
			
			if($query)
			{
				return $query;
			}
		}
		
		
		function fetchArray($query)
		{
			$row=mysqli_fetch_array($query);
			
			return $row;
		}

		function fetchAssociate($query)
		{
			$row=mysqli_fetch_assoc($query);

			return $row; 
		}
		


		function insert()
	    	{
			$query="INSERT INTO $this->table SET ";
			foreach($this->data as $k=>$v)
			{
				$arr[$k]="$k='$v'";
			}
			
			if(count($arr)>0)
			{
				$query.=implode(",",$arr);
			}
			else
			{
				echo "Wrong Query";
				exit;
			}
		
			$this->execute($query);
	
		}

	
		function update()
		{
			$query="UPDATE $this->table SET ";
			
			foreach($this->data as $key=>$value)
	    		{
				$arr[$key]="$key='$value'";
			}
			
			if(count($arr)>0)
			{
				$query.=implode(",",$arr);
			}
		
			foreach($this->cond as $key=>$value)
	    		{
				$val[$key]="$key='$value'";
			}
		
			if(count($val)>0)
			{
				$query.=" WHERE ".implode(" and ",$val);
		
			}
		
			$this->execute($query);
		}
	
		
		function delete()
		{
			$query="DELETE FROM $this->table ";
		
			foreach($this->cond as $key=>$val)
			{
				$value[$key]="$key='$val'";
			}
		
			if(count($value)>0)
			{
				$query.=" WHERE ".implode(" and " , $value);
			}
		
				$this->execute($query);
		
		}


		function totalRows($rs)
		{
			return mysqli_num_rows($rs);
		}


	}
	

?>