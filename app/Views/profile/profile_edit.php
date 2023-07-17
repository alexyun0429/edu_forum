<!DOCTYPE html>
<html>
<head>
    <title>Profile Edit Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        main {
            padding-top: 10px; 
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Profile Edit Page</h1>

        <div class="row">
            <div class="col-sm-4">
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo session()->get('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo session()->get('error'); ?>
                    </div>
                <?php endif; ?>

                <h3>Upload Profile Picture</h3>

                <?php echo form_open_multipart(base_url().'profile/upload_picture'); ?>
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture:</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    </div>
                    <input type="submit" value="Upload Picture" class="btn btn-primary">
                <?php echo form_close(); ?>

                <h4 class="mt-5">Username:</h4>
                <p><?= $user['username'] ?></p>

                <h4>Email:</h4>
                <p><?= $user['email'] ?></p>

                <h4>Phone number:</h4>
                <p><?= $user['phone'] ?></p>

                <h3 class="mt-5">Change Password</h3>

                <?php echo form_open(base_url().'profile/change_password'); ?>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password:</label>
                        <input type="password" name="current_password" id="current_password" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" name="new_password" id="new_password" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_new_password" class="form-label">Confirm New Password:</label>
                        <input type="password" name="confirm_new_password" id="confirm_new_password" required class="form-control">
                    </div>

                    <input type="submit" value="Change Password" class="btn btn-primary">
                <?php echo form_close(); ?>

                <h3 class="mt-5">Drop Course</h3>

                <?php echo form_open(base_url('profile/drop_course')); ?>
                    <div class="mb-3">
                        <label for="course_select" class="form-label">Course:</label>
                        <select name="course_select" id="course_select" class="form-select">
                            <?php foreach ($user['enrolled_courses'] as $course): ?>
                                <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="submit" value="Drop Course" class="btn btn-danger">
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <a href="<?= base_url().'profile' ?>" class="btn btn-secondary mt-3">Back to Profile</a>
    </br></br></br></br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>