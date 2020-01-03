let laravelCMS = {

    postMethod: "POST",
    getMethod: "GET",

    // Get product attributes
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

    // Check current password
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
    },

    // Set billing info in shipping form
    sameAsShipping: function (element) {

        if (element.checked) {
            $('#shipping-name').val($('#billing-name').val());
            $('#shipping-address').val($('#billing-address').val());
            $('#shipping-phone').val($('#billing-phone').val());
            $('#shipping-pincode').val($('#billing-pincode').val());
            $('#shipping-city').val($('#billing-city').val());
            $('#shipping-state').val($('#billing-state').val());
            $('#shipping-country').val($('#billing-country').val());
        } else {
            $('#shipping-name').val('');
            $('#shipping-address').val('');
            $('#shipping-phone').val('');
            $('#shipping-pincode').val('');
            $('#shipping-city').val('');
            $('#shipping-state').val('');
            $('#shipping-country').val('');
        }
    },

    selectPaymentMethod: function () {
        if ($('#PayPal').is(':checked') || $('#COD').is(':checked')) {
            console.log('checked');
        }
    }

};

$('#message-toast').toast('show');
