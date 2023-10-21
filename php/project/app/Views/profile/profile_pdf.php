<!DOCTYPE html>
<html>
<head>
    <title>User Profile PDF</title>
    <style>
        /* Add any styles you want to apply to the PDF here */
    </style>
</head>
<body>
    <h1>User Profile</h1>

    <h2>Username:</h2>
    <p><?= $user['username'] ?></p>

    <h2>Email:</h2>
    <p><?= $user['email'] ?></p>

    <h2>Phone number:</h2>
    <p><?= $user['phone'] ?></p>

    <h2>Enrolled Courses:</h2>
    <ul>
        <?php foreach ($user['enrolled_courses'] as $course): ?>
            <li><?= $course['course_name'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
