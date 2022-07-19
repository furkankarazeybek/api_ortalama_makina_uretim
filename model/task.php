<?php 
// Task Model Object

// empty TaskException class so we can catch task errors
class TaskException extends Exception { }

class Task {
	// define private variables
	// define variable to store task id number
	private $_UrunKodu;
	private $_MAKINAORT;

	
  
  
  // constructor to create the task object with the instance variables already set
	public function __construct($UrunKodu,$MAKINAORT) {
	
		$this->setUrunKodu($UrunKodu);
		$this->setMAKINAORT($MAKINAORT);
	
	}
  
  // function to return task ID
	
  
  
	public function getUrunKodu() {
		return $this->_UrunKodu;
	}

	public function getMAKINAORT() {
		return $this->_MAKINAORT;
	}
  
  
	
	

  
	// function to set the private task ID

  
	public function setUrunKodu($UrunKodu) {
		
		
		$this->_UrunKodu = $UrunKodu;
	}

	  
	public function setMAKINAORT($MAKINAORT) {
		
		
		$this->_MAKINAORT = $MAKINAORT;
	}
  

	
	
  
  
  // function to return task object as an array for json
	public function returnTaskAsArray() {
		$task = array();
		$task['UrunKodu'] = $this->getUrunKodu();
		$task['MAKINAORT'] = $this->getMAKINAORT();
	
		return $task;
	}
  
}