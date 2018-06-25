$(document).ready(function(){
    //открытие попапа
    (function(){
        $('.darkness__activator').on('click', function(e) {
            e.preventDefault();
            $('.darkness').addClass('darkness--active');
            $('.darknesspopup').addClass('darknesspopup--active');
        });
    }());

        //закрытие попапа
    (function(){
        $('.darknesspopup__close').on('click', function(e) {
            e.preventDefault();
            $('.darkness').removeClass('darkness--active');
            $('.darknesspopup').removeClass('darknesspopup--active');
        });

        $('.darkness').on('click', function(e) {
            $(this).removeClass('darkness--active');
            $('.darknesspopup').removeClass('darknesspopup--active');
        });
    }());

    //отправка формы регистрации пользователя
    (function(){
        $('#registerSubmit').on('click', function (e) {
            e.preventDefault();

            var data = $('#registerForm').serialize();

            $.ajax({
                url: '/login/create',
                method: 'POST',
                dataType: 'html',
                data: data,
            }).done(function (response) {
                var jsoned = JSON.parse(response);
                if (jsoned.success) {
                    document.location.href = '/profile';
                } else {
                    $('#registerNameError').html(jsoned.message);
                }
            })
        })
    }());

    });





