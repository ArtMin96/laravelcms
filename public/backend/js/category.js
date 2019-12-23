var table = $('#categoryTable').DataTable({
    // lengthChange: false,
    buttons: ['copy', 'excel', 'pdf', 'colvis']
});

table.buttons().container().appendTo('#example_wrapper');

$(document).on('click', '#deleteCategory', function () {
    if(confirm('Are you sure you want to delete this Category?')) {
        return true;
    } else {
        return  false;
    }
});
