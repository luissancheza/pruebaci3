<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Carga la vista básica de una página: header, vista y footer.
*
* @param controlador $contexto   Desde dónde se llamará a la vista
* @param string $vista      El nombre de la vista que se cargará después del header
* @param array  $data       Arreglo con los campos que usará templates/header y $vista
*/
if(!function_exists('carga_pagina_basica')){
    function carga_pagina_basica($contexto, $vista = '', $data) {
        $contexto->load->view('templates/header', $data);
        $contexto->load->view($vista, $data);
        $contexto->load->view('templates/footer');
    }// carga_pagina_basica
}

if(!function_exists('enviaDataJson')){
  function enviaDataJson($status, $data, $contexto) {
    return $contexto->output
          ->set_status_header($status)
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
  }// enviaDataJson()
}

if(!function_exists('is_request_ajax')){
  function is_request_ajax($contexto) {
    if ($contexto->input->is_ajax_request()) {
      return TRUE;
    } else {
      redirige_prohibido($contexto);
    }
  }// is_request_ajax()
}

if(!function_exists('redirige_prohibido')){
  function redirige_prohibido($contexto) {
    $contexto->session->set_flashdata("mensaje_error", crea_mensaje(ERRORMESSAGE, "Acceso prohibido"));
    $contexto->session->set_flashdata("titulo", 'Acceso prohibido');
    $contexto->session->set_flashdata("url_back", site_url());
    redirect('errorint/error');
    //$this->carga_pagina_basica($contexto, 'templates/acceso_prohibido', $data);
    return;
  }
}