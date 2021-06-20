<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Direccion extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('appweb');
        $this->load->model('c_estado_model');
        $this->load->model('c_municipio_model');
        $this->load->model('direccion_model');

    }

	public function index() {
        $data = array();
        $data['estados'] = $this->c_estado_model->get_estados();
        carga_pagina_basica($this, 'direccion/index', $data);
	}

    public function direccion() {
        $data = array();
        $data['estados'] = $this->c_estado_model->get_estados();
        carga_pagina_basica($this, 'direccion/direccion', $data);
	}

    public function editar_direccion($iddireccion){
        $data = array();
        $data['iddireccion'] = $iddireccion;
        $data['estados'] = $this->c_estado_model->get_estados();
        $datos = $this->direccion_model->get_infoDireccion($iddireccion);
        $data['municipios'] = $this->c_municipio_model->get_municipiosxestado($datos->id_estado);
        $data['datos'] = $datos;
        carga_pagina_basica($this, 'direccion/direccion', $data);
    }

    public function buscar_direcciones(){
        if (is_request_ajax($this)) {
            $idestado = $this->input->post("slc_estado");
            $idmunicipio = $this->input->post("slc_municipio");
            $localidad = $this->input->post("txt_localidad");
            $direccion = $this->input->post("txt_direccion");

            $direcciones = $this->direccion_model->buscar_direcciones($idestado, $idmunicipio, $localidad, $direccion);
            
            $response = array(
                'direcciones' => $direcciones,
            );
    
            enviaDataJson(200, $response, $this);
            exit;
        }
    }

    public function get_municipiosxestado() {
        if (is_request_ajax($this)) {
            $idestado = $this->input->post("idestado");
            $municipios = $this->c_municipio_model->get_municipiosxestado($idestado);
            
            $response = array(
                'municipios' => $municipios,
            );
    
            enviaDataJson(200, $response, $this);
            exit;
        }
	}

    public function insert_update() {
        if (is_request_ajax($this)) {
            $iddireccion = $this->input->post("iddireccion", TRUE);
            $idestado = $this->input->post("slc_estado", TRUE);
            $idmunicipio = $this->input->post("slc_municipio", TRUE);
            $localidad = $this->input->post("txt_localidad", TRUE);
            $latitud = $this->input->post("txt_latitud", TRUE);
            $longitud = $this->input->post("txt_longitud", TRUE);
            $direccion = $this->input->post("txt_direccion", TRUE);

            if($iddireccion == 0){
                $status = $this->direccion_model->insert_update_direccion($idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion);
            }else{
                $status = $this->direccion_model->insert_update_direccion($idestado, $idmunicipio, $localidad, $latitud, $longitud, $direccion, $iddireccion);
            }
            
            $response = array(
                'respuesta' => $status,
            );
    
            enviaDataJson(200, $response, $this);
            exit;
        };
	}

    public function delete_direccion() {
        if (is_request_ajax($this)) {
            $iddireccion = $this->input->post("iddireccion", TRUE);
            
            $status = $this->direccion_model->delete_direccion($iddireccion);

            $response = array(
                'respuesta' => $status,
            );
    
            enviaDataJson(200, $response, $this);
            exit;
        };
	}

}