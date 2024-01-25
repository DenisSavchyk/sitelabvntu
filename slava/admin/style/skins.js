$(function() {
    $('.skin_info').click(function(){
        var id = $(this).data('id');
        $post = $(this);
        $.ajax({
            type: 'GET',
            url: './inc/skin-ajax.php',
            data: 'id='+id,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function( data, status, jqXHR ){
                if( typeof data.error === 'undefined' ){
                    $(".skin_image").attr("src", data.image);
                    $(".skin_submit").attr("value", data.submit);
                    $(".server_id").attr("value", data.server);
                    $(".id_skin").attr("value", data.input);
                    $('.skin_name').html(data.name);
                    $('#modal-skins').modal('show');
                } else {
                    console.log('ОШИБКА: ' + data.error);
                    $('#modal-skins').modal('hide');
                    alert('ОШИБКА: ' + data.error);
                }
                console.log(data);
            },
            error: function( jqXHR, status, errorThrown ){
                console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
            }
        });
    });
    $('#skins').change(function(){
        $(this).val($(this).prop('checked') ? 1:0);
        if ($(this).prop('checked')){
            $('#skins_file').prop('disabled', false);
            $('#skins_save').prop('disabled', false);
            $("#fileskin").attr("style", 'display: block;');
        } else {
            $('#skins_file').prop('disabled', true);
            $('#skins_save').prop('disabled', true);
            $('#fileskin').hide(1);
        }
    });
});
$(document).ready(function(){
    var num = $("#skinstwo").val();
    if( num == 1 ){
        $('#skinstwo').prop('checked', true);
        $('#skins_file').prop('disabled', false);
        $('#skins_save').prop('disabled', false);
        $("#fileskin").attr("style", 'display: block;');
        $('#skinstwo').click(function(){
            $("#skinstwo").attr("value", 0);
            $("#skins_file").attr("disabled", true);
            $('#skins_save').prop('disabled', true);
        });
    }
    if( num === 0 ){
        $('#skinstwo').prop('checked', false);
        $('#skins_file').prop('disabled', true);
        $('#skins_save').prop('disabled', true);
        $('#skinstwo').click(function(){
            $("#skinstwo").attr("value", 1);
            $('#skinstwo').prop('checked', true);
            $("#skins_file").attr("disabled", false);
            $('#skins_save').prop('disabled', false);
        });
    }
    $('#skinstwo').click(function(){
        if( $('#skinstwo').prop('checked') ){
            $("#skinstwo").attr("value", 1);
            $('#skinstwo').prop('checked', true);
            $("#skins_file").attr("disabled", false);
            $('#skins_save').prop('disabled', false);
            $("#fileskin").attr("style", 'display: block;');
        } else {
            $('#skinstwo').prop('checked', false);
            $("#skinstwo").attr("value", 0);
            $("#skins_file").attr("disabled", true);
            $('#skins_save').prop('disabled', true);
            $("#fileskin").attr("style", 'display: none;');
        }
    });
});