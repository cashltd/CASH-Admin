<?php

	/** Internal Mail Class - Using this database structure!
	 *
	 *  CREATE TABLE `internal_mail` (
	 *  `id` INT NOT NULL AUTO_INCREMENT ,
	 *  `to` INT NOT NULL ,
	 *  `from` INT NOT NULL ,
	 *  `subject` VARCHAR( 255 ) NOT NULL ,
	 *  `message` TEXT NOT NULL ,
  	 *  `status` INT NOT NULL ,
	 *  `timestamp` TIMESTAMP NOT NULL ,
	 *  PRIMARY KEY ( `id` )
     *  ) ENGINE = MYISAM
	 *
	 *  Status' for messages are as follows
	 * 		0 = Unread
	 * 		1 = System Message (Important)
	 * 		2 = Message Read
	 * 		3 = Replied To
	 * 		4 = System Message (Important) Read
	 * 		9 = Deleted Mail (To be stored for security)
	 *
	 */

		class internalmail {

			private $maildatabase;
			private $currentNname;
			private $currentUserID;
			private $mailTable;

			public function __construct( $data=DB_DATA, $table="internal_mail", $host=DB_HOST, $user=DB_USER, $pass=DB_PASS ) {
				$this->mailTable = $table;
				$this->maildatabase = new database($data, $host, $user, $pass);

				$tempUser = new user('users',$data);
					 $this->currentname = $tempUser->getCurrentUserName();
					$this->currentUserID = $tempUser->getCurrentUserID();
			}

					// Functions purely for the reading of Internal Mail

			public function countUsersMessages($status=null){
				if ($status > -1) $addWhere = " AND `status` = " . (int)$status;
				else $addWhere = "";

				$this->maildatabase->getAll( "	SELECT * FROM " . $this->mailTable . "
												WHERE `to` = " . (int)$this->currentUserID  . $addWhere);
				return $this->maildatabase->rows;
			}

			public function getUsersMessageIDs($status=null){
				if ($status > -1) $addWhere = " AND `status` = " . (int)$status;
				else $addWhere = "";

				$usermessages = $this->maildatabase->getAll( "SELECT id FROM " . $this->mailTable . " WHERE `to` = " . (int)$this->currentUserID  . $addWhere );
				if (!$this->maildatabase->empty) {
					$returnArray = "";
					foreach ($usermessages AS $usr) {
						$returnArray[] = $usr['id'];
					}
				}
				return $returnArray;
			}

			public function getMailStatus( $id ) {
				$dbDets = $this->maildatabase->getFirst( "SELECT status FROM " . $this->mailTable . " WHERE `id` = " . (int)$id );
				return $dbDets['status'];
			}

			public function getMailContent( $id ) {
				$dbDets = $this->maildatabase->getFirst( "SELECT `from`, `subject`, `message`, `timestamp` FROM " . $this->mailTable . " WHERE `id` = " . (int)$id );
				return $dbDets;
			}

					// Functions purely for the updating of Internal Mail

			public function markRead() {
				print $sql = "UPDATE `" . $this->mailTable . "` SET `status` = '4' WHERE `id` = " . safe::get('id') . " LIMIT 1 ;";
				$this->maildatabase->query($sql);
			}


					// Functions purely for the Sending of Internal Mail


		}


?>