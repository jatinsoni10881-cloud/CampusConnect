
# CampusConnect | SPSU

## Campus Event Management and Registration System

CampusConnect is a web-based application developed using PHP and MySQL to manage campus events and student registrations.

## Features

- Student Registration and Login
- Admin Login
- View Upcoming Events
- Search and Filter Events
- Student Event Registration
- Admin Dashboard
- Add and Manage Events
- View Student Registrations

## Technologies Used

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- Git and GitHub

## Software Requirements

- XAMPP
- MySQL Server
- Web Browser

## Installation Steps

1. Download or clone this repository.
2. Copy the project folder into XAMPP's `htdocs` directory.
3. Open phpMyAdmin or MySQL Workbench.
4. Create a database named `campus_event_management`.
5. Import the `database/campus_event_management.sql` file into the database.
6. Open the project folder and create a new folder named `config`.
7. Open the `database` folder and copy the `db.example.php` file.
8. Paste the copied file inside the newly created `config` folder and rename it to `db.php`.
9. Open `config/db.php` and enter your local MySQL database name, username and password.
10. Start Apache in XAMPP.
11. Start your MySQL Server.
12. Open the following URL in your browser:

http://localhost/CampusEventManagement/

## Database Configuration

The database credentials are stored locally in config/db.php.

The actual configuration file is not included in this repository for security reasons.

## Project Information

- Project Name: CampusConnect
- Institution: SPSU
- Course: B.Tech CSE AIML
- Subject: Web Development

## Security Notice

Do not upload real student information, database passwords or private credentials.

## Future Enhancements

- Online Event Notifications
- Advanced Event Search
- Event Analytics
- Online Deployment
