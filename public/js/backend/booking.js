$(function () {
    /*$.ajax({
        type: 'get',
        url: urlTransport,
        success: function (data) {
            $.each(JSON.parse(data), function (k, v) {
                transportList = transportList + "<option value='" + v.id + "'>" + v.name + " " + v.price + "</option>"
            })
        }
    });*/
});
var available_of_product = {};

$('#searchProduct').select2({
    ajax: {
        url: urlSearch,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            var query = {
                search: params.term,
                page: params.page
            }

            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
                results: data.data,
                pagination: {
                    more: (params.page * 30) < data.total
                }
            };
        },
        cache: true
    },
    placeholder: 'Search product',
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});

function formatRepo(repo) {
    if (repo.loading) {
        return repo.text;
    }
    var spacial = '';
    if (repo.status == 2) {
        spacial = "Spacial price"
    }
    var container = $("<div><b>" + spacial + " ID : </b>" + repo.id + "<b> Name : </b>" + repo.name + "</div>");

    return container;
}

function formatRepoSelection(repo) {
    return repo.name || repo.text
}

$('#searchProduct').on('select2:select', function (e) {
    var data = e.params.data;
    addProductCard(data);
});

function addProductCard(repo) {
    var check_list = $("#table_body").find("tr#list_id_" + repo.id).html();
    var card_product_list = "";
    var public_price = {};
    var spacial = '';
    if (repo.status == 2) {
        spacial = "Spacial price"
    }
    if (repo.id != "" || check_list == undefined) {
        /*start card header*/
        card_product_list = '<div class="card mb-3" id="list_id_' + repo.id + '"><div class="card-header"><b>' + spacial + ' ' + lg_id + '</b> : ' + repo.id + '  <b>' + lg_product_name + '</b> : ' + repo.name + '  ' +
            '<span class="float-right" id="available_span_' + repo.id + '" number_of_pax="' + repo.number_of_pax + '"></span>' +
            '<input type="hidden" name="product_id[]" value="' + repo.id + '"></div>' +
            //end card header
            /*start card body*/
            '<div class="card-body"><div class="form-row"><div class="col-md-6">' +
            //left show price
            '<div class="form-group col-md-12"><label><b>' + lg_adult + ' : </b>' + repo.public_adult + '</label></div>' +
            '<div class="form-group col-md-12"><label><b>' + lg_child + ' : </b>' + repo.public_child + '</label></div>' +
            '<div class="form-group col-md-12"> <label><b>' + lg_infant + ' : </b>' + repo.public_infant + '</label></div><hr>' +
            '<div class="form-group row"><label class="col-sm-2 col-form-label">' + lg_date + '</label><div class="col-sm-10"><input type="text" name="date_' + repo.id + '" class="form-control form-date" onchange="checkAvailable(' + repo.id + ',' + repo.number_of_pax + ')"></div> </div>' +
            '<div class="form-group row"><label class="col-sm-3 col-form-label">' + lg_add_transport + '</label>' +
            '<div class="col-sm-9">' +
            //'<select class="form-control" name="trans_' + repo.id + '">' + transportList + '</select> ' +
            '</div></div></div>' +
            //right form
            //number_of_adult
            '<div class="col-md-6"><div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_number_of_adult + '</label>' +
            '<div class="col-sm-8"><input type="number" name="noa_' + repo.id + '" class="form-control text-right" value="0" onchange="calculatePrice(' + repo.id + ',\'noa_\')" price="' + repo.public_adult + '"></div> </div>' +
            //number_of_child
            '<div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_number_of_child + '</label>' +
            '<div class="col-sm-8"><input type="number" name="noc_' + repo.id + '" class="form-control text-right" value="0" onchange="calculatePrice(' + repo.id + ',\'noc_\')" price="' + repo.public_child + '"></div></div>' +
            //number_of_infant
            '<div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_number_of_infant + '</label>' +
            '<div class="col-sm-8"><input type="number" name="noi_' + repo.id + '" class="form-control text-right" value="0" onchange="calculatePrice(' + repo.id + ',\'noi_\')" price="' + repo.public_infant + '"></div></div>' +
            //discount
            '<div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_discounts + '</label>' +
            '<div class="col-sm-8"><input type="number" name="d_' + repo.id + '" class="form-control text-right" value="0" onchange="calculatePrice(' + repo.id + ',\'\')"></div></div>' +
            //total
            '<div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_total + '</label>' +
            '<div class="col-sm-8"><input type="number" name="t_' + repo.id + '" readonly class="form-control text-right" ></div></div>' +
            //vat
            '<div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_vat + '</label>' +
            '<div class="input-group col-sm-8"><div class="input-group-prepend"><div class="input-group-text">%</div></div>' +
            '<input type="number" name="v_' + repo.id + '" class="form-control text-right" value="7" onchange="calculatePrice(' + repo.id + ',\'\')"></div></div>' +
            //net total
            '<div class="form-group row"><label class="col-sm-4 col-form-label">' + lg_net_total + '</label>' +
            '<div class="col-sm-8"><input type="number" name="nt_' + repo.id + '" readonly class="form-control text-right" ></div></div> </div> </div> </div> </div>';
        $("#product_list").append(card_product_list);
        $('input[name="date_' + repo.id + '"]').daterangepicker({
            "singleDatePicker": true
        });
    }
}

function removeProduct(id) {
    var reset_button = confirm("Are you sure?");
    if (reset_button) {
        $("#list_id_" + id).remove();
    }

}


function checkAvailable(product_id, number_of_pax) {
    $.ajax({
        type: 'get',
        url: urlCheckAvailable,
        data: {product_id: product_id, book_date: $("input[name='date_" + product_id + "']").val()},
        success: function (data) {
            $("#available_span_" + product_id).html(lg_available + ' ' + data + '/' + number_of_pax + '&nbsp;&nbsp;<button type="button" class="btn btn-primary">' +
                '<i class="fas fa-trash" onclick="removeProduct(' + product_id + ')"></i></button> ');
            available_of_product[product_id] = data;
        }
    });
}

function calculatePrice(product_id, input_name) {
    var noa = parseInt($('input[name="noa_' + product_id + '"]').val());
    var noc = parseInt($('input[name="noc_' + product_id + '"]').val());
    var noi = parseInt($('input[name="noi_' + product_id + '"]').val());
    var total_pax = (noa + noc + noi) + parseInt(available_of_product[product_id]);
    var d = parseInt($('input[name="d_' + product_id + '"]').val());
    var vat = parseInt($('input[name="v_' + product_id + '"]').val());
    var t = 0;
    var nt = 0;
    var public_adult = parseInt($('input[name="noa_' + product_id + '"]').attr('price'));
    var public_child = parseInt($('input[name="noc_' + product_id + '"]').attr('price'));
    var public_infant = parseInt($('input[name="noi_' + product_id + '"]').attr('price'));
    var number_of_pax = parseInt($("#available_span_" + product_id).attr('number_of_pax'));
    var charge = 0;
    var transports = $('#sl_tran option:selected').attr('price');

    if (!$.isNumeric(noa) || !$.isNumeric(noc) || !$.isNumeric(noi)) {
        return false
    }

    if (total_pax > number_of_pax) {
        $("#alertMessageBody").html('<p>The number of passengers exceeds the maximum number of products.</p>');
        $('#alertMessage').modal('show');
        resetValuePax(input_name + product_id);
    } else {
        charge = transports*(noa+noc+noi);
        t = ((noa * public_adult) + (noc * public_child) + (noi * public_infant));
        nt = ((t+charge) + ((t+charge) * vat / 100));
        $('input[name="t_' + product_id + '"]').val(t.toFixed(2));
        $('input[name="charge_' + product_id + '"]').val(charge.toFixed(2));
        $('input[name="nt_' + product_id + '"]').val(nt.toFixed(2));
    }

}

function resetValuePax(input_name) {
    $('input[name="' + input_name + '"]').val(0)
}

