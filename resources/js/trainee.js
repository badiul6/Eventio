// Dashboard

$(document).ready(function () {

    $('button[name="m-close"]').click(function (event) {
        $(this).closest('div[name="Modal"]').hide();
    });

    $('#event-modal').click(function () {
        $('#eventModal').toggle();
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

function addInterest(interest) {
    const interestElement = document.createElement('div');
    interestElement.classList.add('interest');

    const interestText = document.createElement('span');
    interestText.classList.add('interest-text');
    interestText.textContent = interest;
    interestElement.appendChild(interestText);

    const removeIcon = document.createElement('span');
    removeIcon.classList.add('remove-icon');
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

