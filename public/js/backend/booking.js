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
    addProductTable(data);
});

function addProductTable(repo){
    var check_list = $("#table_body").find("tr#list_id_"+repo.id).html();
    if (repo.id != "" || check_list == undefined){
        $("#table_body").append("<tr id='list_id_"+repo.id+"'><td>"+repo.id+"</td><td>"+repo.name+"</td><td id='available"+repo.id+"'></td><td>"+repo.public_adult+
            "</td><td>"+repo.public_child+"</td><td>"+repo.public_infant+"</td><td>"+
            "<a href='#'><i class=\"fas fa-trash\" onclick='removeProduct("+repo.id+")'></i></a></td></tr>");
    }
    checkAvailable(repo.id,repo.number_of_pax);
}

function removeProduct(id){
    $("#list_id_"+id).remove();
}

function checkAvailable(product_id,number_of_pax){
    $.ajax({
        type:'get',
        url:urlCheckAvailable,
        data:{product_id:product_id},
        success:function(data) {
            $("#available"+product_id).html(data+'/'+number_of_pax);
        }
    });
}
