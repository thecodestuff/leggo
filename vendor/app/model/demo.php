<?php 
/**
 * Class : YOUR_MODEL_CLASS_NAME 
 * This class fetch data from the test table  
 */

class demo extends Model{
	private $table_name ='YOUR_TABLE_NAME' ;

	public function get_demo_data(){
		// intilizing model instance 
		parent::__construct() ;

		$sql = 'SELECT * FROM '.$this->table_name ;
		$this->db->query($sql) ;
		$row = $this->db->resultset() ;
		return $row ;
	}
}

?>