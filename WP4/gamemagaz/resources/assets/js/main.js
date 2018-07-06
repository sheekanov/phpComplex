//отправка формы регистрации пользователя
(function(){
    $('#orderFormSubmit').on('click', function (e) {
        e.preventDefault();

        var data = $('#orderForm').serialize();

        $.ajax({
            url: '/cart/send',
            method: 'POST',
            dataType: 'html',
            data: data,
        }).done(function (response) {
            var jsoned = JSON.parse(response);
            $('#orderForm').addClass('modal__form--hidden');
            $('#orderFormSubmit').addClass('modal__form-submit-hidden');
            $('#orderMessage').html(jsoned.message);
        })
    })

    $('.modals__cart-refresh').on('click', function (e) {
        e.preventDefault();
        document.location.href = '/cart';
    })
}());