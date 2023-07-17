<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">User Profile</h1>
        <?php
        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ?>

        </br>
        <div class="text-center">
            <?php if ($profilePicture != NULL): ?>
                <img src="<?= $profilePicture?>" alt="Profile Picture" class="rounded-circle"  height="250px">
            <?php else: ?>
                <img src="<?= base_url('../../assets/img/defaultImage.png') ?>" alt="Profile Picture" class="rounded-circle"  height="250px">
            <?php endif; ?>
            
        </div>

        <?php if ($is_email_verified == FALSE): ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="aler alert-danger" role="alert">
                        <strong>Email verification needed.</strong> </br>Please verify your email address to access all features.
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($is_phone_verified == FALSE): ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-danger" role="alert">
                        <strong>Phone verification needed.</strong>
                    </div>
                    <?php echo form_open(base_url().'profile/phoneVerify'); ?>
                        <div class="mb-3">
                            <label for="phoneVerify" class="form-label">Enter the verification code:</label>
                            <input type="password" name="phoneVerify" id="phoneVerify" required class="form-control">
                        </div>
                        <input type="submit" value="Verify phone number" class="btn btn-info">
                    <?php echo form_close(); ?>
                </div>
            </div>
        <?php endif; ?>


        <h4>Username:</h4>
        <p><?= $user['username'] ?></p>

        <h4>Email:</h4>
        <p><?= $user['email'] ?></p>

        <h4>Phone number:</h4>
        <p><?= $user['phone'] ?></p>
        
        <h4>Enrolled Courses</h4>
        <ul>
            <?php foreach ($user['enrolled_courses'] as $course): ?>
                <li><?= $course['course_name'] ?></li>
            <?php endforeach; ?>
        </ul><br>
        <!-- $html = '<h1>Hello, World!</h1>';
$mpdf->WriteHTML($html);
$mpdf->Output(); -->
        <a href="<?= base_url().'profile/generateProfilePDF' ?>" class="btn btn-info">Download PDF</a>
        
        <a href="<?= base_url().'profile_edit' ?>" class="btn btn-primary">Edit Profile</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>