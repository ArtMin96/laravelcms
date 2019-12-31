let laravelCMS = {

    postMethod: "POST",
    getMethod: "GET",

    getProductAttribute: function (attributeValue) {
        let currentAttributeValue = attributeValue.value;

        if(currentAttributeValue == '') {
            return false;
        } else {
            $.ajax({
                url: '/get-product-price',
                type: this.getMethod,
                data: {productByAttribute: currentAttributeValue},
                success: function (result) {
                    let array = result.split('#');
                    $('#currentPrice').html('$'+array[0]);
                    $('#currentPriceSelected').val(array[0]);

                    if(array[1] == 0) {
                        // If stock is 0 do something
                        $('#availability').text('Out Of Stock');
                        $('#availability').parent().removeClass('product-available').addClass('badge-danger');
                    } else {
                        $('#availability').text('In Stock');
                        $('#availability').parent().removeClass('badge-danger').addClass('product-available');
                    }
                }
            });
        }
    },

    checkPassword: function () {
        var currentPassword = $('#current_password').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/check-user-password',
            type: this.postMethod,
            data: {currentPassword: currentPassword},
            success: function (response) {
                if(response == 'false') {
                    $('#checkPasswordSuccess').addClass('d-none');
                    $('#checkPasswordError').removeClass('d-none').html('Current password is incorrect.');
                } else if(response == 'true') {
                    $('#checkPasswordError').addClass('d-none');
                    $('#checkPasswordSuccess').removeClass('d-none').html('Current password is correct.');
                }
            }
        });
    }

};

$('#message-toast').toast('show');
