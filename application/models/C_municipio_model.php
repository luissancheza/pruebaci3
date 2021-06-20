<?php
class C_municipio_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  public function get_municipiosxestado($idestado){
    $query = "SELECT id, nombre
                FROM c_municipio
                WHERE id_estado = ?
              ";
    return $this->db->query($query, [$idestado])->result();
  }

}