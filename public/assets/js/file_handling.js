$(document).ready(() => {
    fetchListing();

    function fetchListing() {
        $.ajax({
            url: route('file.handle.list'),
            method: 'get',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success(json_file) {
                $("#filehanding").html('');

                var html = ''
console.log(json_file.files.length)
                if (json_file.files !== null || json_file.files.length > 0) {
                    for (var i in json_file.files) {
                        html += '<tr>' +
                            '<td>' + json_file.files[i].name + '</td>' +
                            '<td>' + json_file.files[i].email + '</td>' +
                            '<td>' + json_file.files[i].phone + '</td>' +
                            '<td>' + json_file.files[i].message + '</td>' +
                            '<td>' + json_file.files[i].created_at + '</td><td>' +
                            '<a href="javascript:void(0)" class="edit" data-id="' + json_file
                            .files[i].unique_id +
                            '">Edit</a> |  <a href="javascript:void(0)" class="delete" data-id="' +
                            json_file.files[i].unique_id + '">delete</a>';
                        html += '</td><tr>'
                    }
                    $("#filehanding").html(html);

                }
            },
            error(e) {
            },
        });
    }

    // File store part
    $('#file_handling_form').on('submit', (event) => {
        let formData = $('#file_handling_form').serializeArray();
        console.log(formData)
        let formobj = {}
        $.each(formData, function(key, field) {
            formobj[field.name] = field.value;
        })

        $.ajax({
            url: route('file.handle.store'),
            method: 'post',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                ...formobj
            },
            success(result) {
                fetchListing();
            },
            error(e) {},
        });

    });

});

$(document).on('click', ".edit", function() {
    var edit_id = $(this).attr('data-id')

    $.ajax({
        url: route('file.handle.edit'),
        method: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            edit_id
        },
        success(result) {
            var resultfile = result
            var modal_id = $("#myFilehanding").modal();
            modal_id.find("#e_file_name").val(resultfile.files.name)
            modal_id.find("#e_file_email").val(resultfile.files.email)
            modal_id.find("#e_file_phone").val(resultfile.files.phone)
            modal_id.find("#e_file_message").val(resultfile.files.message)
            modal_id.find("#hiddenIds").val(resultfile.files.unique_id)
            $("#myFilehanding").modal('show')
        },
        error(e) {

        },
    });
})
$(document).on("click", ".btnupdate", function() {
    var name = $('#e_file_name').val();
    var phone = $("#e_file_phone").val();
    var email = $("#e_file_email").val();
    var message = $("#e_file_message").val();
    var hiddenIds = $("#hiddenIds").val();
    $.ajax({
        url: route('file.handle.update'),
        method: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name,
            phone,
            email,
            message,
            hiddenIds
        },
        success(result) {
            $("#myFilehanding").modal('hide')
        },
        error(e) {
        },
    });
})
$(document).on("click", ".delete", function() {
    var delete_id = $(this).data('id')
    $.ajax({
        url: route('file.handle.delete'),
        method: 'delete',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            delete_id
        },
        success(result) {

        },
        error(e) {
        },
    });
})
