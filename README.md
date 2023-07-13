# 🎉 Eventio - Event Management System for Universities 🎓

Welcome to the Event Management System for universities! This system, built using Laravel and Tailwind CSS, allows universities to effortlessly organize events, hire trainers, and enables trainers and attendees to join events. 📅✨

## Features

✅ **Authentication**: Secure user authentication and authorization system for universities, trainers, and attendees.

✅ **Event Organization**: Universities can easily create, manage, and track various events.

✅ **Trainer Hiring**: Universities can hire experienced trainers to conduct events and share their expertise.

✅ **Event Joining**: Trainers can view and join events they are interested in.

✅ **Attendee Registration**: Attendees can easily register and participate in the events of their choice.

## Technologies Used

🔧 This Event Management System is developed using the following technologies:

- Laravel - A powerful PHP framework for web application development.
- Tailwind CSS - A utility-first CSS framework for building modern and responsive interfaces.
- Laravel Breeze - A lightweight authentication scaffold for Laravel applications, providing pre-built authentication features.
- SQL - A standard language for interacting with relational databases, used for managing data in the Event Management System.
- XAMPP - A popular cross-platform web server solution that includes Apache, MySQL, PHP, and other tools, used for local development and testing of the Event Management System.

## Installation

To set up the Event Management System on your local machine, follow these steps:

1. Clone the repository:
```
git clone https://github.com/afk-Legacy/Eventio.git
```
2. Navigate to the project directory:
```
cd Eventio
```
3. Install the dependencies using Composer:
```
composer install
```
4. Create a copy of the `.env.example` file and rename it to `.env`. Update the necessary configuration values such as the database connection settings.
5. Generate a new application key:
```
php artisan key:generate
```
6. Run the database migrations:
```
php artisan serve
```

8. Visit `http://localhost:8000` in your web browser to access the Event Management System.

## Usage

Once the Event Management System is set up, here's how you can use its different modules:

### For Universities

1. **Event Creation**: Log in as a university representative and create new events by providing details such as event name, date, location, and description.

2. **Trainer Hiring**: Explore the list of available trainers, view their profiles, and hire the most suitable ones for your events.

3. **Event Management**: Monitor and manage the events you have created. Track attendee registrations, make changes to event details, and cancel events if required.

### For Trainers

1. **Event Exploration**: Browse the list of available events and view their details, including the event date, location, and description.

2. **Event Joining**: Select the events you want to participate in and register as a trainer.

### For Attendees

1. **Event Discovery**: Discover various events organized by universities and explore their details, including the event name, date, location, and description.

2. **Event Registration**: Sign up as an attendee and register for the events that interest you the most.

## Contributing

Contributions to the Event Management System are welcome! If you encounter any bugs, have suggestions for new features, or would like to contribute in any way, please open an issue or submit a pull request.

## Acknowledgements
Special thanks to the Laravel and Tailwind CSS communities for their amazing tools and resources that made this project possible.

Let's collaborate and make event management for universities more efficient and exciting! 🎓🚀




















