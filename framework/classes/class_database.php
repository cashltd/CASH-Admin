<?php

		class database {

			public $empty, $reser;

		    /**
		     * Checks to see if the database is empty
		     * @
		     * @param array|string $tpl_var the template variable name(s)
		     * @param mixed $value the value to assign
		     */
			private function checkEmpty() {
				if ($this->rows	> 0) $this->empty = FALSE;
				else  $this->empty = TRUE;
			}

			/**
		    * Initiates the database
		    *
		    * @param string $data Database to connect to when not the default
		    * @param mixed $host Hostname to connect to when not the default
		    * @param mixed $user Username to connect with when not the default
		    * @param mixed $pass Password to connect with when not the defualt
		    */
			public function __construct($data=DB_DATA, $host=DB_HOST, $user=DB_USER, $pass=DB_PASS) {
				
				$this->connection=mysql_connect($host, $user, $pass);
				mysql_select_db ($data, $this->connection);
			}

			/**
		    * Inserts a record into the database
		    *
		    * @param mixed $insert SQL String to insert
		    * @return integer Returns the id of the inserted string
		    */
			public function insert($insert) {
				mysql_query($insert,$this->connection);
				return mysql_insert_id($this->connection);
			}

			public function query($insert) {
				mysql_query($insert,$this->connection);
			}

			/**
		    * Deletes a row in the database by the ID of that row
		    *
		    * @param mixed $table The name of the table the row is being deleted from
		    * @param integer $id The ID of the row to be deleted
		    */
			public function deleteID($table, $id) {
				mysql_query("DELETE FROM " . $table . " WHERE id=" . $id . " LIMIT 0,1;",$this->connection);
			}

			/**
		    * Gets all the rows from the specified database Query
		    *
		    * @param mixed $select SQL query to run
		    * @return array An array of the requested database query
		    */
			public function getAll($select) {
				$this->result = mysql_query($select,$this->connection);
				$this->rows = mysql_num_rows($this->result);
				$this->checkEmpty();
				$v = 0;
				if (!$this->empty) {
					while ($res = mysql_fetch_array($this->result)) {
						foreach ($res AS $key => $cord) {
							if (!is_numeric($key)) {
							 $kary[$v][$key] = $cord;
							}
						}
						$v++;
					}
					return $kary;
				}
			}

			/**
		    * Gets the first row from the specified database Query
		    *
		    * @param mixed $select SQL query to run
		    * @return array An array of the requested database query
		    */
			public function getFirst($select) {
				$this->result = mysql_query($select,$this->connection);
				$this->rows = mysql_num_rows($this->result);
				$this->checkEmpty();

				while ($res = mysql_fetch_array($this->result)) {
					$this->reser[] = $res;
				}
				return $this->reser[0];
			}

			public function close() {
				mysql_close($this->connection);
			}

			
			function __destruct() {
		     //  mysql_close($this->connection);
		   }
			
			
		}

?>