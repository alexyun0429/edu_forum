<!DOCTYPE html>
<html>
    <head>
        <title>Join new course</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <body>
        <div class="container mt-5">
            <h1>Join new course</h1>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>

            <h4>Available Courses</h4>

            <form action="<?= base_url('/join_course') ?>" method="post">
                <?= csrf_field() ?>

                <div id="course_dropdowns">
                    <div class="course_dropdown mb-3">
                        <select class="form-select" name="course_name[]">
                            <option value="">Select Course</option>
                            <?php foreach($courses as $course): ?>
                                <?php if(!in_array($course['course_id'], $user['enrolled_courses'])): ?>
                                    <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <button type="button" class="btn btn-secondary me-3" id="add_more">Add More</button>
                    <input type="submit" class="btn btn-primary" value="Enroll">
                </div>
                </br>
                <a href="<?= base_url().'dashboard' ?>" class="btn btn-warning">Back to Dashboard</a>
            </form>
            
        </div>

        <script>
            document.getElementById('add_more').addEventListener('click', function() {
                // Get the course dropdowns container element
                var container = document.getElementById('course_dropdowns');

                // Create a new course dropdown element
                var dropdown = document.createElement('div');
                dropdown.className = 'course_dropdown mb-3';
                dropdown.innerHTML = `
                    <select class="form-select" name="course_name[]">
                        <option value="">Select Course</option>
                        <?php foreach($courses as $course): ?>
                            <?php if(!in_array($course['course_id'], $user['enrolled_courses'])): ?>
                                <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                `;

                // Append the new course dropdown to the container
                container.appendChild(dropdown);
            });
        </script>
    </body>
</html>