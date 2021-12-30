window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
const Swal = require('sweetalert2');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


$(document).on('click', '.new_client', function() {

    let name = $("#name_client").val();
    let city = $("#city").val();

    axios.post('client', {
            name: name,
            city: city
        })
        .then(function(response) {
            if (response.status == 200) {
                alerta("success", "Cliente creado con exito!");
                $("#name_client").val("");
                $("#city").val("");
                $("#clientNew").modal('toggle');
                window.location.reload();
            }

        })
});
$(document).on('click', '.edit_client', function() {
    let code = $(this).data("id");
    axios.get('client/' + code)
        .then(function(response) {
            console.log(response.data);
            $("#name_client").val(response.data.name);
            $("#city").val(response.data.cities.code);
            $("#save_client").removeClass("new_client");
            $("#save_client").addClass("save_change");
            $('#save_client').html("Actualizar");
            $('#code_client').val(response.data.code);
        })
});

$(document).on('click', '#add_client', function() {
    $("#save_client").removeClass("save_change");
    $("#save_client").addClass("new_client");
    $('#save_client').html("Guardar cliente");
});

$(document).on('click', '.save_change', function() {
    let name = $("#name_client").val();
    let city = $("#city").val();
    let code = $('#code_client').val();
    axios.put('client/' + code, {
            name: name,
            city: city
        })
        .then(function(response) {

            if (response.status == 200) {
                alerta("success", "Cliente actualizado con exito!");
                $("#name_client").val("");
                $("#city").val("");
                $("#clientNew").modal('toggle');
                window.location.reload();
            }
        })
});
$(document).on('click', '.delete_client', function() {
    let code = $(this).data("id");

    axios.delete('client/' + code)
        .then(function(response) {
            if (response.status == 200) {
                alerta("success", "Cliente eliminado con exito!");
                window.location.reload();
            }
        })
});

function alerta(icon, message) {
    Swal.fire({
        position: 'top-end',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
}