<br>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form_direccion">
                    <input type="hidden" name="iddireccion" id="iddireccion" value="<?=(isset($iddireccion))?$iddireccion:0 ?>">
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="slc_estado" class="form-label">Estado</label>
                                <select id="slc_estado" name="slc_estado"class="form-control">
                                <option value="0">SELECCIONAR</option>
                                <?php foreach ($estados as $estado): ?>
                                    <option value="<?= $estado->id ?>" <?=(isset($datos) && $datos->id_estado == $estado->id)?"selected":"" ?> ><?= $estado->nombre ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="slc_municipio" class="form-label">Municipio</label>
                                <select id="slc_municipio" name="slc_municipio"class="form-control">
                                <option value="0">SELECCIONAR</option>
                                <?php foreach ($municipios as $municipio): ?>
                                    <option value="<?= $municipio->id ?>" <?=(isset($datos) && $datos->id_municipio == $municipio->id)?"selected":"" ?> ><?= $municipio->nombre ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="txt_localidad" class="form-label">Localidad</label>
                                <input type="text" class="form-control" id="txt_localidad" name="txt_localidad" value="<?= (isset($datos)?$datos->localidad :"" )?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="txt_latitud" class="form-label">Latitud</label>
                                <input type="text" class="form-control" id="txt_latitud" name="txt_latitud" value="<?= (isset($datos)?$datos->latitud :"" )?>">
                            </div>
                            <div class="form-group col-md-6 col-lg-4 col-xl-4">
                                <label for="txt_longitud" class="form-label">Longitud</label>
                                <input type="text" class="form-control" id="txt_longitud" name="txt_longitud" value="<?= (isset($datos)?$datos->longitud :"" )?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                <label for="txt_direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" value="<?= (isset($datos)?$datos->direccion :"" )?>">
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary">Grabar</button>
                        <a href="<?= base_url('/direccion')?>" class="btn btn-light btn-sm">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<p>*Arrastre el marcador en el mapa para capturar las coordenadas</p>
<div id="map"></div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeuEClO4YjWsurino-z0RIdG4GUwVFqlY&callback=initMap&libraries=&v=weekly" async></script>
<script src="<?= base_url("assets/js/utilerias/mapa.js") ?>"></script>
<script src="<?= base_url("assets/js/direccion/direccion.js") ?>"></script>