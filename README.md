<<<<<<< HEAD
solved
# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
=======
# Edu Forum

This is the README file for the Edu Forum project, a student forum website built using PHP with the CodeIgniter 4 framework and Bootstrap 5.

## Project Overview
Edu Forum is an interactive educational platform designed to facilitate student discussions and enhance learning through engagement. The website follows the Model-View-Controller (MVC) architectural pattern and utilizes MySQL as the database management system.

### Key Features
- User Registration and Login: Users can create an account, register with their email and phone number, and log in securely.
- Email and Phone Verification: Account verification is implemented through email and phone verification to ensure the authenticity of user information.
- Dashboard: Upon logging in, users are presented with a dashboard that displays the courses in which they are enrolled.
- User Profile: Users have a dedicated profile page where they can view and edit their personal information.
- Course Enrollment: Students can self-enroll in the courses they wish to participate in.
- Post Management: Users can create posts with titles, details, tags, and image uploads. Teachers have additional capabilities to edit and delete posts and comments.
- Commenting and Rating System: Students can comment on posts and rate questions to foster discussions and identify valuable content.
- Search Functionality: The website includes a search box with autocompletion for finding specific questions or posts within a course.
- File Uploads: Users can upload files by using drag and drop functionality for sharing relevant materials.
- Web Security: Strong password encryption and hashing techniques are implemented to ensure web security. Careful coding practices are followed to prevent SQL injection attacks.
- AJAX Functionality: AJAX is used for seamless upload and modification of comments on posts.
- Third-Party API Integration: The project integrates a third-party SMS API for specific functionalities.
- Scroll Position Maintenance: The website maintains scroll position for a smoother user experience.
- PDF Manipulation: Third-party API integration allows for PDF manipulation.

## Project Objectives
The main objective of the Edu Forum website is to provide students with a platform for interactive discussions and knowledge sharing. The key features aim to enable students to post questions, engage in discussions, rate content, and search for relevant information within their enrolled courses. Additionally, teachers have administrative functions to maintain the quality of content and manage student posts and comments.

## UI/UX Design
The user interface of the Edu Forum website is designed to be intuitive and user-friendly. The index page serves as the login page with links to the forgot password and registration pages. Once logged in, users are presented with a dashboard displaying their enrolled courses. The header contains different buttons for students and teachers, such as "Join" and "Create," respectively.

When accessing a course, the page displays the course title, a list of questions, and a sidebar with tags for filtering. A search box is available to search for questions using keywords. Teachers have additional editing capabilities to manage posts and comments.

The student self-enrollment page provides filters by course categories or alphabetical order. For teachers, the page allows them to create courses instead of enrolling.

The user profile page displays the user's username, email, enrolled courses, and profile image. Users can change their passwords and profile images from this page.

## Installation
To install and run the Edu Forum website locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/alexyun0429/edu_forum.git)https://github.com/alexyun0429/edu_forum.git
1. Configure the database connection settings in the app/Config/Database.php file.

2. Import the database schema using the provided SQL file.

3. Ensure that your PHP environment meets the requirements of CodeIgniter 4 and the necessary dependencies, including Bootstrap 5.

4. Start the local development server or configure a web server to serve the application.

>>>>>>> 38d9cee0173201f9f82dd6124e7a1e21820defab
