$(function() {
    function updates() {
        $.ajax({
            type: "POST",
            url: "inc/up-ajax.php",
            data: "action=1",
            dataType:"json",
            success: function(data) {
                if(!data.version){
                    $('#updates_version').html(data.msg);
                } else {
                    $('#updates_version').html(data.msg);
                    desc();
                }
            }
        });
    }
    function desc() {
        var version = $('.version').data('id');
        if(!version) return;
        $.ajax({
            type: "POST",
            url: "inc/up-ajax.php",
            data: "action=2&version="+version,
            dataType:"json",
            success: function(data) {
                if(data.desc) {
                    $('.updates_desc').html(data.desc);
                } else {
                    $('.updates_desc').html('Обновлений нет!');
                }
            }
        });
    }
    $('.updates_desc').html('Обновлений нет!');
    updates();
    setInterval(updates, 3000);
});
function get_update() {
    $('.overlay').css('display', 'block');
    $.ajax({
        type: "POST",
        url: "inc/up-ajax.php",
        data: "action=3",
        dataType:"json",
        success: function(data) {
            if(data.status == 2){
                over_false();
                $('#mess').jGrowl('<center><strong>'+data.message+'</strong></center>', { life: 5000 });
            } else if(data.status == 3){
                over_false();
                $('#mess').jGrowl('<center><strong>'+data.message+'</strong></center>', { life: 5000 });
            } else if(data.status == 1) {
                over_true();
                $('#mess').jGrowl('<center><strong>'+data.message+'</strong></center>', { life: 5000 });
                $('.updates_desc').html('Обновлений нет!');
            }
        }
    });
}
function over_true() {
    let int = setInterval(function overlay() {
                            $('.overlay').html('<i class="fa fa-check"></i>');
                            let int2 = setInterval(function overlay2() {
    $('.overlay').css('display', 'none');
    $('.overlay').html('<i class="fa fa-refresh fa-spin"></i>');
    clearInterval(int);
    clearInterval(int2);
}, 1500);
                        }, 3000);
}
function over_false() {
    let int = setInterval(function overlay() {
                            $('.overlay').html('<i class="fa fa-times"></i>');
                            let int2 = setInterval(function overlay2() {
    $('.overlay').css('display', 'none');
    $('.overlay').html('<i class="fa fa-refresh fa-spin"></i>');
    clearInterval(int);
    clearInterval(int2);
}, 1500);
                        }, 3000);
}