// Dashboard

$(document).ready(function () {

    $('#topic').trigger("change");

    $('button[name="m-close"]').click(function (event) {
        $(this).closest('div[name="Modal"]').hide();
        location.reload();
    });

    $('button[id="editPic"]').click(function (event) {
        $('#picModal').toggle();
    });

    $('#cover').on('click', function (event) {
        $('#coverModal').toggle();
    });


    $('#CheckboxButton').click(function () {
        $('#DefaultCheckbox').toggle();
    });

    $('#dropdownCheckboxButton').click(function () {
        $('#dropdownDefaultCheckbox').toggle();
    });

    $('tr[name="event-update"]').on('click', function () {
        var row = $(this).closest("tr");

        $.ajax({
            type: "POST",
            url: '/university/getEvents',

            data: {
                event_id: row[0].id,
                _token: document.querySelector('meta[name="csrf-token"]').content
            },

            success: function (data) {
                let events = data[0];
                let trainees = data[1];
                let index = 0;

                $('#name-inp').val(events.name);
                $('#capacity').val(events.capacity);
                $('#desc').val(events.description);
                $('#id').val(events.id);
                $('#idd').val(events.id);

                if (trainees.length > 0) {
                    Array.from(trainees).forEach(trainee => {
                        var liElement = $('<li></li>');

                        var divElement = $('<div></div>').addClass('flex items-center');
                        liElement.append(divElement);

                        var inputElement = $('<input>')
                            .attr({
                                'id': 'checkbox-item-' + (index + 1),
                                'name': 't_ids[]',
                                'type': 'checkbox',
                                'value': trainee.id
                            })
                            .addClass('w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500');
                        divElement.append(inputElement);

                        var labelElement = $('<label></label>')
                            .attr('for', 'checkbox-item-' + (index + 1))
                            .addClass('ml-2 text-sm font-medium text-gray-900')
                            .text(trainee.first_name + ' ' + trainee.last_name);
                        divElement.append(labelElement);

                        $('#dropDownULL').append(liElement);
                        index += 1;

                    });
                }
            },

            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });



        $('#updateEvent').toggle();
    });
    $('#event-modal').click(function () {
        $('#eventModal').toggle();
    });


    $('#update-modal').click(function () {
        $('#updateModal').toggle();
    });
});

// Create Event Modal

$('#topic').on('change', function () {
    $.ajax({
        type: "POST",
        url: '/university/getFilteredTrainees',

        data: {
            topic: $("#topic").val(),
            _token: document.querySelector('meta[name="csrf-token"]').content
        },

        success: function (data) {
            populateDropDown(data);
        },

        error: function (data, textStatus, errorThrown) {
            console.log(data);
        },
    });


});

function populateDropDown(trainees) {
    let index = 0;

    $('#dropDownUL').empty();

    Array.from(trainees).forEach(trainee => {
        var liElement = $('<li></li>');

        var divElement = $('<div></div>').addClass('flex items-center');
        liElement.append(divElement);

        var inputElement = $('<input>')
            .attr({
                'id': 'checkbox-item-' + (index + 1),
                'name': 'trainee_ids[]',
                'type': 'checkbox',
                'value': trainee.id
            })
            .addClass('w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500');
        divElement.append(inputElement);

        var labelElement = $('<label></label>')
            .attr('for', 'checkbox-item-' + (index + 1))
            .addClass('ml-2 text-sm font-medium text-gray-900')
            .text(trainee.first_name + ' ' + trainee.last_name);
        divElement.append(labelElement);

        $('#dropDownUL').append(liElement);
        index += 1;

    });
}

$('#eventForm').on('submit', function (event) {
    event.preventDefault();

    var selectedTrainees = $('input[name="trainee_ids[]"]:checked');

    var traineeIds = [];

    selectedTrainees.each(function () {
        traineeIds.push($(this).val());
    });

    var hiddenInput = $('<input>')
        .attr({
            type: 'hidden',
            name: 'trainee_ids[]',
            value: traineeIds.join(',')
        });

    $('#existingForm').append(hiddenInput);

    this.submit();
});