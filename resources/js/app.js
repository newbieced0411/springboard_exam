import './bootstrap'

//todo:jquery
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    });

    $("#register").submit(function (event) {
        event.preventDefault()

        let payload = {
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            password_confirmation: $("#c_password").val()
        }

        $.post("http://127.0.0.1:8000/api/user/register", payload)
        .done(function (response) {
            $('#result').html(response.message)
            $("#name").val('')
            $("#email").val('')
            $("#password").val('')
            $("#c_password").val('')
            // localStorage.setItem("token", data);
        })
        .fail(function(jqXHR) {
            // handle error response
            var errors = jqXHR.responseJSON.errors
            var error_message = ''
            for (var key in errors) {
                error_message += errors[key][0] + '\n'
            }
            alert(error_message)
        })
    })

    $("#login").submit(function (event) {
        event.preventDefault()

        let payload = {
            email: $("#email").val(),
            password: $("#password").val(),
        }
        console.log(payload)
        $.post("http://127.0.0.1:8000/api/user/login", payload)
        .done(function (response) {
            localStorage.setItem("token", response.access_token);
            // localStorage.setItem("user", response.user);
            window.location.href = "/"
        })
        .fail(function(jqXHR) {
            // handle error response
            $("#errors").children().remove()
            if(jqXHR.status == 401){
                $("#errors").append('<p>Email or password incorrect.</p>' )
            }
            else {
                var errors = jqXHR  .responseJSON.errors
                for (var key in errors) {
                    $('#errors').append('<p>' + errors[key][0] + '</p>' )
                }
            }
        })
    })
})