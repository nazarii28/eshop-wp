// Login
$('#login-form').on('submit', function(e){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_obj.url,
        data: {
            'action': 'login_action', //calls wp_ajax_nopriv_ajaxlogin
            'username': $('#login-form #username').val(),
            'password': $('#login-form #password').val(),
            'security': $('#login-form #security').val(),
            'nonce' : ajax_obj.nonce,
        },
        beforeSend:function(xhr){
            showAlert('Ждите...');
        },
        success: function(data){
            if (data.loggedin == true){
                document.location.href = ajax_obj.redirecturl;
            } else {
                showAlert(data.message);
            }
        }
    });
    e.preventDefault();
});

function showAlert(text) {
    $('.my-alert').html(text).show();
    setTimeout(function () {
        $('.my-alert').hide();
    }, 3000);
}

// Register

$('#register-form').on('submit', function(e){
    console.log('loading')
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_obj.url,
        data: {
            'action': 'register_action', //calls wp_ajax_nopriv_ajaxlogin
            'username': $('#register-form #username').val(),
            'password': $('#register-form #password').val(),
            'security': $('#register-form #security').val(),
            'nonce' : ajax_obj.nonce,
        },
        beforeSend:function(xhr){
            showAlert('Ждите...');
        },
        success: function(data){
            if (data.loggedin == true){
                document.location.href = ajax_obj.redirecturl;
            } else {
                showAlert(data.message);
            }
        }
    });
    e.preventDefault();
});

// get products
$('.home_category_button').on('click', function(e){
    e.preventDefault();
    $('.home_category_button').removeClass('active');
    $(this).addClass('active');
    var data = {
        action: 'eshop_products_action',
        category: $(this).attr('data-category'),
        nonce : ajax_obj.nonce,
    };

    $.ajax({
        url: ajax_obj.url,
        data: data,
        type:'POST',
        dataType:'json',
        beforeSend:function(xhr){
            $('.trending_products').addClass('loading');
        },
        success:function(data){
            $('.trending_products').removeClass('loading');
            $('.trending_products .row').html(data.out);
        }
    });
});

// quickview

jQuery(function($){
    $('.quickview-btn').on('click', function(e) {
        e.preventDefault();

        var data = {
            product_id: $(this).attr('data-id'),
            action: 'quickview_action',
            nonce : ajax_obj.nonce
        };

        $.ajax({
            url: ajax_obj.url,
            data :data,
            type:'POST',
            dataType:'json',
            beforeSend:function(xhr){

            },
            success:function(data){
                $('#quickviewModal .modal-body').html(data.out);
            }
        });
    });
});

//Search

jQuery(function($){
    $('#search-btn').on('click', function(e) {
        e.preventDefault();
        var category = $('.search-bar .nice-select .current').html();
        var search = $('#search-inp').val();
        if (search.length < 4) {
            $('.search-result').html('<p>Введите не меньше 4 символов</p>');
            return false;
        }
        var data = {
            s: search,
            category : category,
            action: 'search_action',
            nonce : ajax_obj.nonce
        };

        $.ajax({
            url: ajax_obj.url,
            data :data,
            type:'POST',
            dataType:'json',
            beforeSend:function(xhr){
                $('.search-result').html('<p>Ищем...</p>');
            },
            success:function(data){
                $('.search-result').html(data.out);
            }
        });
    });
});