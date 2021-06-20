let marker;

function initMap() {
var lati = ($("#txt_latitud").val() != '')? parseFloat($("#txt_latitud").val()):19.138894578533517; 
var long = ($("#txt_longitud").val() != '')? parseFloat($("#txt_longitud").val()):-98.21779003906248; 
const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 9,
    center: { lat: lati, lng:  long},
});
marker = new google.maps.Marker({
    map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: { lat: lati, lng:  long },
});

marker.addListener('dragend', function(event) {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        $("#txt_latitud").val(this.getPosition().lat());
        $("#txt_longitud").val(this.getPosition().lng());
        // document.getElementById("coords").value =  + "," + ;
    });
}