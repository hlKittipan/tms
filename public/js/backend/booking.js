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
function formatRepo (repo) {
    if (repo.loading) {
        return repo.text;
    }

    var container = $("<div><b>ID : </b>"+repo.id+"<b> Name : </b>"+repo.name+"</div>");

    return container;
}

function formatRepoSelection (repo) {
    return repo.name || repo.text
}

$('#searchProduct').on('select2:select', function (e) {
    var data = e.params.data;
    addProductCard(data);
});

function addProductCard(repo){
    var check_list = $("#table_body").find("tr#list_id_"+repo.id).html();
    var card_product_list = "";
    if (repo.id != "" || check_list == undefined){
        /*start card header*/
        card_product_list = '<div class="card mb-3" id="list_id_3"><div class="card-header"><b>'+lg_id+'</b> : '+repo.id+'  <b>'+lg_product_name+'</b> : '+repo.name+'  ' +
            '<span class="float-right" id="avalable_span_'+repo.id+'"></span></div>'+
            //end card header
            /*start card body*/
            '<div class="card-body"><div class="form-row"><div class="col-md-6">' +
            //left show price
            '<div class="form-group col-md-12"><label><b>'+lg_adult+' : </b>'+repo.public_adult+'</label></div>'+
            '<div class="form-group col-md-12"><label><b>'+lg_child+' : </b>'+repo.public_child+'</label></div>'+
            '<div class="form-group col-md-12"> <label><b>'+lg_infant+' : </b>'+repo.public_infant+'</label></div></div>'+
            //right form
            //number_of_adult
            '<div class="col-md-6"><div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_number_of_adult+'</label>'+
            '<div class="col-sm-8"><input type="number" class="form-control text-right" value="0"></div> </div>'+
            //number_of_child
            '<div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_number_of_child+'</label>'+
            '<div class="col-sm-8"><input type="number" class="form-control text-right" value="0"></div></div>'+
            //number_of_infant
            '<div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_number_of_infant+'</label>'+
            '<div class="col-sm-8"><input type="number" class="form-control text-right" value="0"></div></div>'+
            //discount
            '<div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_discounts+'</label>' +
            '<div class="col-sm-8"><input type="number" class="form-control text-right" value="0"></div></div>'+
            //total
            '<div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_total+'</label>'+
            '<div class="col-sm-8"><input type="number" readonly class="form-control text-right" value="1000"></div></div>'+
            //vat
            '<div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_vat+'</label>'+
            '<div class="input-group col-sm-8"><div class="input-group-prepend"><div class="input-group-text">%</div></div><input type="number" class="form-control text-right" value="7"></div></div>'+
            //net total
            '<div class="form-group row"><label class="col-sm-4 col-form-label">'+lg_net_total+'</label>'+
            '<div class="col-sm-8"><input type="number" readonly class="form-control text-right" value="1070"></div></div> </div> </div> </div> </div>';
            $("#product_list").append(card_product_list);
    }
    checkAvailable(repo.id,repo.number_of_pax);
}

function removeProduct(id){
    var reset_button = confirm("Are you sure?");
    if (reset_button) {
        $("#list_id_"+id).remove();
    }

}

function checkAvailable(product_id,number_of_pax){
    $.ajax({
        type:'get',
        url:urlCheckAvailable,
        data:{product_id:product_id},
        success:function(data) {
            $("#avalable_span_"+product_id).html(lg_available+' '+data+'/'+number_of_pax +'&nbsp;&nbsp;<button type="button" class="btn btn-primary">' +
            '<i class="fas fa-trash" onclick="removeProduct('+product_id+')"></i></button> ');
        }
    });
}
