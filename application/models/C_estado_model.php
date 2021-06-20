<?php
class C_estado_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  public function get_estados(){
    $query = "SELECT id, nombre
                FROM c_estado 
              ";
    return $this->db->query($query)->result();
  }

}
