<?php
class EventSystem {

  private $dbHost = 'localhost';
  private $dbUser = 'root';
	private $dbPwd   = '';
  private $dbName  = 'eventsystem';
	private $eventsTbl = 'events';
  private $userTbl = 'users';
  private $user_eventTbl = 'user_events';
  private $db = false;

	public function __construct(){
  		if(!$this->db){
  				// Connect to the database
  				$conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPwd, $this->dbName);
  				$conn->set_charset('utf8');
  				if($conn->connect_error){
  						die("Failed to connect with MySQL: " . $conn->connect_error);
  				}else{
  						$this->db = $conn;
  				}
  		}
    }

  function createEvent($data = array()) {
  		if(!isset($data['title']) || !isset($data['time']) || !isset($data['description'])) {
  					return "Missing argument";
  			} else {

          $query = "INSERT INTO `$this->eventsTbl`
                            (title,timeOfEvent,description,groupID,pplGoing,type)
                    VALUES
                            ('$data[title]','$data[time]','$data[description]',$data[group],3,1)";
  			 }
  			if ($this->db->query($query) === TRUE) {
  			    echo "New record created successfully";
  			} else {
  			    echo "Error: " . $query . "<br>" . $this->db->error;
  			}
  }

	function getEvent($eventId) {
    $query = sprintf('SELECT * FROM  %s  WHERE id=%d',$this->eventsTbl, $eventId);
    $result = $this->db->query($query);  
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $event = array('groupDd' => $row["groupID"], 'title' => $row["title"], 'description' => $row['description'], 'time' =>  $row["timeOfEvent"], 'going' => $row['pplGoing']);
        }
        return $event;
    } else {
        return  false;
    }
  }

  function getUserEvents($userId) {
    $query  = "SELECT eventID FROM $this->user_eventTbl WHERE userID=$userId";
    $result = $this->db->query($query);
    if ($result->num_rows > 0) {        // output data of each row
        while($row = $result->fetch_assoc()) {
            $events[] = $row['eventID'];
        }
        return $events;
    } else {
        return  false;
    }
  }
	function updateEvent($eventId, $add) {
      if($add==1){
        $query = "UPDATE $this->eventsTbl SET pplGoing = pplGoing + 1 WHERE id=$eventId";
      } else if ($add == -1) {
        $query = "UPDATE $this->eventsTbl SET pplGoing = pplGoing - 1 WHERE id=$eventId";
      }
      if ($this->db->query($query)) {
          echo "Event record updated successfully";
      } else {
          echo "Error updating record: " . mysqli_error($conn);
      }
  }

  function createDeleteUserEvent ($eventId,$userId,$joinoleave) {
    if(!isset($eventId) || !isset($userId)) {
          return "Missing argument";
      } else {
        if($joinoleave==1){
            $query = "INSERT INTO `$this->user_eventTbl`
                                  (userID, eventID)
                        VALUES    ($userId,$eventId)";
          } else if ($joinoleave == -1){
            $query = "DELETE FROM `$this->user_eventTbl`
                      WHERE  (userID = $userId AND eventID = $eventId)";
          }
       }
      if ($this->db->query($query) === TRUE) {
          echo "New record created successfully";
          return true;
      } else {
          echo "Error: " . $query . "<br>" . $this->db->error;
          return false;
      }
  }

  function joinLeaveEvent($eventId,$userId, $joinoleave){
   if($this->createDeleteUserEvent($eventId,$userId,$joinoleave)){
    $this->updateEvent($eventId, $joinoleave);
   }
  }

  function createUser($data = array()) {
      if(!isset($data['name'])) {
            return "Missing argument";
        } else {
          $data['address'] = (isset($data['address'])) ? $data['address'] : NULL;
          $data['phone'] = (isset($data['phone'])) ? $data['phone'] : NULL;
          $query = "INSERT INTO `$this->userTbl` (name,address,phone) VALUES('$data[name]','$data[address]','$data[phone]')";
         }
        if ($this->db->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $this->db->error;
        }
  }

}


?>
