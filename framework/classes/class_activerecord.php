<?php

	// Active Record style class
	// Simon Skinner - 2012
	
	
	
	/**
	 * ActiveRecord class.
	 */
	class ActiveRecord
	{
		private $_data = array();
		
		private $_host = "localhost";
		private $_database = "cashltd_cash";
		private $_table = "total_claimants";
		private $_username = "root";
		private $_password = "oliviashaw";
		
		private $_pk = id;
		
		private $_connection;
		private $_result;
		private $_rows;
		
		
		public function getByKey($id)
		{
			$this->_query("WHERE ".$this->_pk."='".$id."'");

			for ($i = 0; $i <= mysql_num_fields($this->_result)-1; $i++) {
				$col = mysql_fetch_field($this->_result, $i);
				$this->_data[$col->name] = $this->_rows[$col->name];
			}
			
			return $this;
		}

		
		
		public function getByKeys()
		{
			$arg_list = func_get_args();
			$listArray = array();
			
			foreach ($arg_list AS $iKey)
			{
				$listArray[$iKey] = &new activerecord();
				$listArray[$iKey]->getByKey($iKey);
			}
			
			return $listArray;
			
		}
		
				
		public function save()
		{

		}
	
	
	
		
		/**
		 * setPK function.
		 * 
		 * @access public
		 * @param mixed $pk
		 * @return void
		 */
		public function setPK($pk)
		{
			$this->_pk = $pk;
		}
	


		/**
		 * _query function.
		 * 
		 * @access private
		 * @param mixed $sql
		 * @return void
		 */
		private function _query($sql)
		{
			$this->_connection = mysql_connect($this->_host, $this->_username, $this->_password);
			mysql_select_db($this->_database);
			$this->_result = mysql_query("SELECT * FROM ".$this->_table." " . $sql . ";");
			$this->_rows = mysql_fetch_array($this->_result, MYSQL_ASSOC);
		}
	
		/**
		 * __set function.
		 * 
		 * @access public
		 * @param mixed $name
		 * @param mixed $value
		 * @return void
		 */
		public function __set($name, $value)
		{
			$this->_data[$name] = $value;
		}
		
		/**
		 * __get function.
		 * 
		 * @access public
		 * @param mixed $name
		 * @return void
		 */
		public function __get($name)
		{
			if (array_key_exists($name, $this->_data)) {
            	return $this->_data[$name];
        	}
		}
		
	    /**
	     * __isset function.
	     * 
	     * @access public
	     * @param mixed $name
	     * @return void
	     */
	    public function __isset($name)
	    {
	        return isset($this->_data[$name]);
	    }
	
	    /**
	     * __unset function.
	     * 
	     * @access public
	     * @param mixed $name
	     * @return void
	     */
	    public function __unset($name)
	    {
	        unset($this->_data[$name]);
	    }
		
		/**
		 * __construct function.
		 * 
		 * @access public
		 * @return void
		 */
		public function __construct()
		{

		}
	
	}

?>