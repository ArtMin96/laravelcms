// Delete Product image
$(document).on('click', '#ajaxRemoveImage', function () {
    var _this = $(this);
    var parent = _this.parent();
    var id = _this.data('image-id');

    $.ajax({
        url: '/admin/delete-product-image/'+id,
        type: "GET",
        data: {id: id},
        success: function(result) {
            parent.remove();
            toastr.success(result.flash_message_success, 'Success');
        }
    });
});

// Delete More Photo
$(document).on('click', '#ajaxRemoveMorePhoto', function () {
    var _this = $(this);
    var parent = _this.parent();
    var id = _this.data('image-id');

    $.ajax({
        url: '/admin/delete-more-photos/'+id,
        type: "GET",
        data: {id: id},
        success: function(result) {
            parent.remove();
            toastr.success(result.flash_message_success, 'Success');
        }
    });
});

$(document).on('click', '#deleteRecord', function (e) {
    var id = $(this).attr('rel');
    var deleteFunction = $(this).attr('rel1');
    swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this record again!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Yes, delete it!'
        },
        function () {
            window.location.href = '/admin/'+deleteFunction+'/'+id;
        });
});

// Add attributes input group
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row">\n' +
        '                                        <div class="col form-group">\n' +
        '                                            <input type="text" name="sku[]" class="form-control" id="sku" placeholder="SKU">\n' +
        '                                        </div>\n' +
        '                                        <div class="col form-group">\n' +
        '                                            <input type="text" name="size[]" class="form-control" id="size" placeholder="Size">\n' +
        '                                        </div>\n' +
        '                                        <div class="col form-group">\n' +
        '                                            <input type="text" name="price[]" class="form-control" id="price" placeholder="Price">\n' +
        '                                        </div>\n' +
        '                                        <div class="col form-group">\n' +
        '                                            <input type="text" name="stock[]" class="form-control" id="stock" placeholder="Stock">\n' +
        '                                        </div>\n' +
        '                                        <div class="col form-group">\n' +
        '                                            <a href="javascript:void(0);" class="remove_button">Remove</a>\n' +
        '                                        </div>\n' +
        '                                    </div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

var table = $('#productsTable').DataTable({
    // lengthChange: false,
    buttons: ['copy', 'excel', 'pdf', 'colvis']
});

table.buttons().container().appendTo('#example_wrapper');
