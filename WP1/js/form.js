$(document).ready(function(){

    //отправка формы
    (function(){
        $('#form_submit').on('click', function(e) {

            e.preventDefault();
            var data = $('#order-form').serialize();

            $.ajax({
                url: 'form.php',
                method: 'POST',
                dataType: 'html',
                data: data,
            }).done(function(response) {
                var jsoned = JSON.parse(response);
                if (jsoned.success){ //если скрипт отработал удачно, очищаем поля ввода и показываем попап с успехом. В консоль пишем сообщение сервера.
                    $('#success').addClass("popup__active");
                    $('#successMessage').html(jsoned.message);
                    $('#order-form')[0].reset();
                } else { //если скрипт отработал с ошибкой, показываем попап с ошибкой. В консоль пишем сообщение сервера.
                    $('#error').addClass("popup__active");
                    $('#errorMessage').html(jsoned.message);
                }
            })
        })
    }());

    //закрытие попапа
    (function(){
        $('.status-popup__close').on('click', function (e) {
            e.preventDefault();
            $this = $(this);
            $this.closest('.status-popup').removeClass("popup__active");
        })
    }());

})