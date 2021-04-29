$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
});

function add_customer() {
    $.ajax({
        url: $('#form_add_customer').attr('action'),
        data: $('#form_add_customer').serialize(),
        dataType: "json",
        type: "POST",
        beforeSend: function() {
            var someForm = $('#form_add_customer');
            $.each($('#form_add_customer')[0].elements, function(index, elem) {
                if (elem.id) {
                    $("#" + elem.id).removeClass('is-invalid');
                    $('#' + elem.id).nextAll('.text-danger').remove();
                }
            });
        },
        success: function(data) {
            if (data['status'] == 1) {
                document.location.reload();
            } else {
                if (data['errors'] != '') {
                    $.each(data['errors'], function(key, value) {
                        $("#" + key).addClass('is-invalid');
                        $("#" + key).parent().append('<span class="text-danger">' + value + '</span>');
                    });
                    return false;
                } else {
                    alert("Something went wrong. Please try again.");
                    return false;
                }
            }
        },
        error: function(xhr) {
            if (xhr.responseJSON.message != '') {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $("#" + key).addClass('is-invalid');
                    $("#" + key).parent().append('<span class="text-danger">' + value + '</span>');
                });
            }
        }
    });
}

function get_customer_details(id) {
    $.ajax({
        url: $('#customer_details_url').val(),
        data: 'id=' + id,
        dataType: "json",
        type: "POST",
        success: function(data) {
            if (data['status'] == 1) {
                $("#customer_id").val(id);
                $.each(data['data'], function(key, value) {
                    if (value == null) value = '';
                    if (key == 'address') {
                        $('#' + key).html(value);
                    } else {
                        $('#' + key).val(value);
                    }
                });
                $('#add_customer').modal('show');
            } else {
                if (data['msg'] != '') {
                    alert(msg);
                    return false;
                } else {
                    alert("Something went wrong. Please try again.");
                    return false;
                }
            }
        }
    });
}