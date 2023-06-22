$(document).ready(function() {

    $('#profileArea').on('click', function(event) {
        $('#profileDropDown').toggle();
    });
    $('#update').on('click', function(event) {
        $('#updateModal').toggle();
    });
    $('#uupdate').on('click', function(event) {
        $('#updateModal').toggle();
    });
    $('button[name="m-close"]').click(function(event) {
        $(this).closest('div[name="Modal"]').hide();
    });

    $('button[id="editPic"]').click(function(event) {
        $('#picModal').toggle();
    });

    $('#cover').on('click', function(event) {
        $('#coverModal').toggle();
    });
});