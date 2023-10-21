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
The user interface of the Edu Forum website is designed to be intuitive and user-friendly. However, it is important to note that the project heavily focuses on SERVER SIDE coding rather than interface development. That's why Bootstrap 5 is used to provide a responsive and consistent layout, but the primary emphasis is on robust server-side functionality.

The index page serves as the login page with links to the forgot password and registration pages. Once logged in, users are presented with a dashboard displaying their enrolled courses. The header contains different buttons for students and teachers, such as "Join" and "Create," respectively.

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

Feel free to explore the server-side coding, robust functionality, and responsive layout that the Edu Forum project offers. If you have any specific questions or need further assistance regarding the project, don't hesitate to ask.
