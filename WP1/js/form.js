$(document).ready(function(){

    //отправка формы
    (function(){
        $('#form_submit').on('click', function(e) {
            e.preventDefault();

            var name = $('#name').val();
            var tel = $('#tel').val();
            var email = $('#email').val();
            var street = $('#street').val();
            var house = $('#house').val();
            var corp = $('#corp').val();
            var appt = $('#appt').val();
            var floor = $('#floor').val();
            var comment = $('#comment').val();
            var callback = $('#callback:checked').val();
            var payment = $('input[name=payment]:checked').val();

            $.ajax({
                url: 'form.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                    tel: tel,
                    email: email,
                    street: street,
                    house: house,
                    corp: corp,
                    appt: appt,
                    floor: floor,
                    comment: comment,
                    callback: callback,
                    payment: payment
                }
            }).done(function(response) {
                if (response.success){ //если скрипт отработал удачно, очищаем поля ввода и показываем попап с успехом. В консоль пишем сообщение сервера.
                    $('#name').val('');
                    $('#tel').val('');
                    $('#email').val('');
                    $('#street').val('');
                    $('#house').val('');
                    $('#corp').val('');
                    $('#appt').val('');
                    $('#floor').val('');
                    $('#comment').val('');
                    $('input[name=payment]').prop('checked', false);
                    $('#callback').prop('checked', false);

                    console.log(response.message);

                    $('#success').addClass("popup__active");
                } else { //если скрипт отработал с ошибкой, показываем попап с ошибкой. В консоль пишем сообщение сервера.
                    console.log(response.message);
                    $('#error').addClass("popup__active");
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