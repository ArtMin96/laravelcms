var laravelCms = {

    ajaxMethod: "GET",

    checkCurrentPwd: function () {
        var currentPwd = $('#current_pwd').val();

        $.ajax({
            url: '/admin/check-pwd',
            type: this.ajaxMethod,
            data: {currentPwd: currentPwd},
            beforeSend: function() {

            },
            success: function (result) {
                if(result == 'false') {
                    $('#current_pwd').removeClass('is-valid');
                    $('#current_pwd').addClass('is-invalid');
                    $('#invalid_current_pwd').attr('class', 'invalid-feedback').text('Current Password is Incorrect');
                } else if(result == 'true') {
                    $('#current_pwd').removeClass('is-invalid');
                    $('#current_pwd').addClass('is-valid');
                    $('#invalid_current_pwd').attr('class', 'valid-feedback').text('Current Password is Correct');
                } else if(result == 'empty') {
                    $('#current_pwd').removeClass('is-valid');
                    $('#current_pwd').addClass('is-invalid');
                    $('#invalid_current_pwd').attr('class', 'invalid-feedback').text('Current Password cannot be blank');
                }
            }
        });
    },

    updatePassword: function () {
        var currentPwd = $('#current_pwd').val();
        var newPwd = $('#new_pwd').val();
        var confirmPwd = $('#password_confirmation').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#changePwd-error').find('ul').empty();

        $.ajax({
            url: '/admin/update-pwd',
            type: this.ajaxMethod,
            data: {currentPwd: currentPwd, newPwd: newPwd, confirmPwd: confirmPwd},
            beforeSend: function() {

            },
            success: function (result) {
                if(result.flash_message_error) {
                    $('#changePwd-success').addClass('d-none');
                    $.each(result.flash_message_error, function (key, val) {
                        $('#changePwd-error').removeClass('d-none').find('ul').append('<li>'+val+'</li>');
                    });
                } else if(result.flash_message_success) {
                    $('#changePwd-error').addClass('d-none');
                    $('#changePwd-success').removeClass('d-none').find('ul').html('<li>'+result.flash_message_success+'</li>');
                }
            }
        });
    }

};
