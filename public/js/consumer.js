//ajax удаление абонента
$(document).ready(function () {

$('.del_consumer').click( function(){

    var button = $(this);

    var consumer_id = button.data('consumer_id');

    $.ajax({
        type: 'POST',                //метод
        url: location.href,              //URL на который отправляем запрос
        data: {consumer_id: consumer_id},
        cache: false,
        success: function(response) {    //код в этом блоке выполняется при успешной отправке сообщения
            /*$('.news[data-post_id = '+response+']').hide();
            $('.news[data-post_id = '+response+']').after(''+
                '<div class="return_post" data-post_id="'+response+'">'+
                '<a class="return_post_btn">Восстановить</button>'+
                '</div>'+
                '');*/
            alert(1);
        }
    });
});

});