// Dashboard

$(document).ready(function () {

    $('button[name="m-close"]').click(function (event) {
        $(this).closest('div[name="Modal"]').hide();
        interests = [];
        interestsContainer.innerHTML = '';
    });

    $('button[id="editPic"]').click(function (event) {
        $('#picModal').toggle();
    });

    $('#cover').on('click', function (event) {
        $('#coverModal').toggle();
    });

    $('#update-modal').click(function () {
        showPreviousEvents();
        $('#updateModal').toggle();

    });

    $('#dropdownCheckboxButton').click(function () {
        $('#dropdownDefaultCheckbox').toggle();
    });
});

//  Create and Edit Event

const interestsContainer = document.getElementById('interests-container');
const interestInput = document.getElementById('interest-input');
const form = document.getElementById('profileForm');

let interests = [];

interestInput.addEventListener('keydown', function (event) {
    if (event.key === 'Enter' && interestInput.value.trim() !== '') {
        const interest = interestInput.value.trim();
        addInterest(interest);
        interests.push(interest);
        interestInput.value = '';
    }
});

function getRandomColor() {
    var letters = 'BCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * letters.length)];
    }
    return color;
}

function addInterest(interest) {
    // Create interestElement
    const interestElement = document.createElement('div');
    interestElement.style.display = 'flex';
    interestElement.style.alignItems = 'center';
    interestElement.style.backgroundColor = getRandomColor();
    interestElement.style.padding = '4px 8px';
    interestElement.style.borderRadius = '4px';

    // Create interestText
    const interestText = document.createElement('span');
    interestText.style.marginRight = '4px';
    interestText.textContent = interest;

    // Append interestText to interestElement
    interestElement.appendChild(interestText);

    const removeIcon = document.createElement('span');
    removeIcon.classList.add('remove-icon');
    removeIcon.style.cursor = 'pointer';
    removeIcon.innerHTML = '&#10006;';
    removeIcon.addEventListener('click', function () {
        interestElement.remove();
        interests = interests.filter(item => item !== interest);
    });
    interestElement.appendChild(removeIcon);

    interestsContainer.appendChild(interestElement);
}

form.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});

form.addEventListener('submit', function (event) {
    event.preventDefault();

    const input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'interests');
    input.setAttribute('value', JSON.stringify(interests));

    form.appendChild(input);
    form.submit();
});

function showPreviousEvents() {
    $.ajax({
        type: "POST",
        url: '/trainee/getinterests',

        data: {
            _token: document.querySelector('meta[name="csrf-token"]').content
        },
        success: function (data) {
            Array.from(data).forEach(topic => {
                const interest = topic.topic_name;
                addInterest(interest);
                interests.push(interest);
            });

        },
        error: function (data, textStatus, errorThrown) {
            console.log(errorThrown);
        },
    });
}

