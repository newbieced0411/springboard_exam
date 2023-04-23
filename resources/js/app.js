import './bootstrap'

$(document).ready(function () {
    let api = "http://127.0.0.1:8000/api"
    // This is for ajax header setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            "Authorization": 'Bearer ' + localStorage.getItem('token')
        }
    })

    $("#register").submit(function (event) {
        event.preventDefault()

        let payload = {
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            password_confirmation: $("#c_password").val()
        }

        $.post(`${api}/user/register`, payload)
            .done(function (response) {
                $("#result").html(response.message)
                $(":input").val('')
                $("#errors").children().remove()
            })
            .fail(function (jqXHR) {
                $("#errors").children().remove()
                $("#result").val('')
                var errors = jqXHR.responseJSON.errors
                for (var key in errors) {
                    $("#errors").append(`<p>${errors[key][0]}</p>`)
                }

            })
    })

    $("#login").submit(function (event) {
        event.preventDefault()

        let payload = {
            email: $("#email").val(),
            password: $("#password").val(),
        }

        $.post(`${api}/user/login`, payload)
            .done(function (response) {
                localStorage.setItem("token", response.access_token)
                window.location.href = "/"
            })
            .fail(function (jqXHR) {
                $("#errors").children().remove()
                if (jqXHR.status == 401) {
                    $("#errors").append("<p>Email or password incorrect.</p>")
                }
                else {
                    var errors = jqXHR.responseJSON.errors
                    for (var key in errors) {
                        $("#errors").append(`<p>${errors[key][0]}</p>`)
                    }
                }
            })
    })

    $("#addBranch").click(function () {
        $.post(`${api}/branch/add`, { name: $("#inputBranch").val() })
            .done(function (response) {
                console.log(response)
                $("#inputBranch").val('')
                $("#branches ul").children().remove()
                getBranches()
            })
            .fail(function (jqXHR) {
                console.log(jqXHR.responseJSON.message)
            })
    })

    $("#addProduct").submit(function () {
        event.preventDefault()

        let payload = {
            name: $("#name").val(),
            description: $("#description").val(),
            price: $("#price").val(),
            stock: $("#stock").val()
        }

        $.post(`${api}/product/add`, payload)
            .done(function (response) {
                $(":input").val('')
                $("#errors").children().remove()
                $('#result').html(response.message)
                $("#listBranches form").children().remove()
                $("#listProducts form").children().remove()
                tagBranchProduct()
            })
            .fail(function (jqXHR) {
                // handle error response
                $("#errors").children().remove()
                $("#result").remove()
                var errors = jqXHR.responseJSON.errors
                for (var key in errors) {
                    $("#errors").append(`<p class="mb-1 text-sm">*${errors[key][0]}</p>`)
                }
            })
    })

    function getBranches() {
        $.get(`${api}/branch`, function (response) {
            $.each(response.branches, function (index, branch) {
                $("#branches ul").append(`<li id="${branch.id}"class="p-2 rounded border-b-2 transition duration-300 ease-in-out hover:bg-blue-500 hover:text-gray-100"> ${branch.name} </li>`)
            })

            $("#branches ul li").click(function () {
                let branchId = $(this).attr("id")
                $("#branches ul li").removeClass("active")
                $(this).addClass('active');
                $.get(`${api}/branch/${branchId}`, function (response) {
                    $("#products ul").children().remove()
                    $.each(response.branch.products, function (index, product) {
                        $("#products ul").append(`<li id="${product.id}"class="flex flex-col px-1 py-2 rounded border-2 transition duration-300 ease-in-out hover:bg-blue-500 hover:text-gray-100"> 
                            <span class="mb-2 text-lg font-semibold">${product.name}</span>
                            <span class="mb-2 text-xl font-semibold">₱${product.price}</span>
                            <span class="text-sm justify">${product.description}</span>
                        </li>`)
                    })
                })
            })
        })
    }

    function tagBranchProduct() {
        $.get(`${api}/branch`, function (response) {
            $.each(response.branches, function (index, branch) {
                $("#listBranches form").append(`
                <div>
                    <input type="checkbox" id="${branch.id}" value="${branch.id}" class="mr-2">${branch.name}
                </div>`)
            })
        })

        $.get(`${api}/product`, function (response) {
            $.each(response.products, function (index, product) {
                $("#listProducts form").append(`
                <div>
                    <input type="checkbox" id="${product.id}" value="${product.id}" class="mr-2">${product.name}
                </div>`)
            })
        })

        $("#tag").click(function () {
            let branchIds = $("#formBranches input[type=checkbox]:checked").map(function () {
                return this.value;
            }).get()

            let productIds = $("#formProducts input[type=checkbox]:checked").map(function () {
                return this.value;
            }).get()

            $.post(`${api}/tag/insert`, { products: productIds, branches: branchIds })
            .done(function (response) {
                $("#result").html(response.message)
            })
            .fail(function (jqXHR) {
                console.log(jqXHR.responseJSON)
            })
        })
    }

    tagBranchProduct()
    getBranches()
})