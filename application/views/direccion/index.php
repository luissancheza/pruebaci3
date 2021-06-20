
        <!-- page-content  -->
        <main class="page-content pt-2">
          <div id="overlay" class="overlay"></div>
          <div class="container-fluid px-4 py-5 mt-3">
           
            <!-- FORMULARIOS -->

            <div class="card mb-4 shadow-sm">
              <div class="card-header">
               Consultar direcciones
              </div>
              <form id ="form_buscar_direccion">
                <div class="card-body">
                <div class="row">
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="slc_estado" class="form-label">Estado</label>
                                <select id="slc_estado" name="slc_estado"class="form-control">
                                <option value="0">SELECCIONAR</option>
                                <?php foreach ($estados as $estado): ?>
                                    <option value="<?= $estado->id ?>" <?=(isset($params_user) && $params_user->idarea == $estado->id)?"selected":"" ?> ><?= $estado->nombre ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="slc_municipio" class="form-label">Municipio</label>
                                <select id="slc_municipio" name="slc_municipio"class="form-control">
                                <option value="-1">SELECCIONAR</option>
                                <?php foreach ($municipios as $municipio): ?>
                                    <option value="<?= $municipio->id ?>" <?=(isset($params_user) && $params_user->idarea == $municipio->id)?"selected":"" ?> ><?= $municipio->nombre ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="txt_localidad" class="form-label">Localidad</label>
                                <input type="text" class="form-control" id="txt_localidad" name="txt_localidad" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                <label for="txt_direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" aria-describedby="emailHelp">
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                  <button  class="btn btn-primary btn-sm" id="btn_buscar_direcciones">Buscar</button>
                  <a id="btn_limpiar_filtros" class="btn btn-light btn-sm">Limpiar filtros</a>
                  <a href="<?= base_url('/direccion/direccion')?>" class="btn btn-light btn-sm">Agregar</a>
                </div>
              </form>
            </div>
            
            <!-- TABLES -->
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="row">

                  <div class="col-12 col-sm-12">
                    <div class="table-responsive">
                      <table id="tbl_consulta_direcciones" class="table table-striped table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Municipio</th>
                            <th scope="col">Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td colspan="4"><center>Sin datos para mostrar</center></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </main>
        <!-- page-content" -->
        <script src="<?= base_url("assets/js/direccion/buscador.js") ?>"></script>