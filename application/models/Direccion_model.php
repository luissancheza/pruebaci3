<?php
class Direccion_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  public function delete_direccion($iddireccion){
    $this->db->where('id', $iddireccion);
    return $this->db->delete('direccion');
  }

  public function buscar_direcciones($idestado, $idmunicipio, $localidad, $direccion){
    $datos = [];  
    $where = "";
      if($idestado != 0){
        $where .= " AND d.id_estado = ?";
        array_push($datos, $idestado);
      }
      if($idmunicipio != -1){
        $where .= " AND d.id_municipio = ?";
        array_push($datos, $idmunicipio);
      }
      if($localidad != ""){
        $scape = $this->db->escape_str($localidad);
        $where .= " AND d.localidad LIKE '%{$scape}%' ";
      }
      if($direccion != ""){
        $scape = $this->db->escape_str($direccion);
        $where .= " AND d.direccion LIKE '%{$scape}%' ";
      }
    $query = "SELECT d.id, e.nombre AS nestado, m.nombre AS nmunicipio FROM direccion d
    INNER JOIN c_estado e ON e.id = d.id_estado
    INNER JOIN c_municipio m ON m.id = d.id_municipio
    WHERE  1 = 1 $where ";
    // echo $query; die();
    return $this->db->query($query, $datos)->result_array();
  }

  public function insert_update_direccion($idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion, $iddireccion = null){
    $data = array(
    'id_estado'=> $idestado,
    'id_municipio' => $idmunicipio,
    'localidad' => $localidad,
    'latitud' => $latitud,
    'longitud' => $longitud,
    'direccion'=> $direccion
    );
    if($iddireccion){
        $this->db->where('id', $iddireccion);
        return $this->db->update('direccion', $data);
    }else{
        return $this->db->insert('direccion', $data);
    }
  }

  public function get_infoDireccion($iddireccion){
    $query = "SELECT id, id_estado, id_municipio, localidad, latitud, longitud, direccion FROM direccion 
    WHERE  id = ? ";
    return $this->db->query($query, [$iddireccion])->row();
  }

}