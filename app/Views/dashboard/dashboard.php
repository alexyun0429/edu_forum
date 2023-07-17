<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            height: 200px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <h1>Welcome, <?= $username ?></h1>

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
    <hr>
    <h2>Enrolled Courses</h2>
    <hr>
    <small>
        Search thread title that you want.
    </small>
    <div class="container">
        <form class="d-flex" action="<?= base_url('dashboard') ?>" method="get">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <hr>
        <div class="row">
            <?php
                $colours = array("bg-primary", "bg-secondary", "bg-success", "bg-danger", "bg-warning", "bg-info", "bg-dark");

                foreach ($enrolled_courses as $course):

                    $index = rand(0, count($colours) - 1);
                    $colour = $colours[$index];

                    echo '<div class="col-md-4">';
                    echo '<div class="card text-white '.$colour.' mb-3 shadow" style="max-width: 18rem;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$course->course_name.'</h5>';
                    echo '<p class="card-text">'.$course->course_code.'</p>';
                    echo '<a href="'.base_url('forum/'.$course->course_name.'/'.$course->course_code).'" class="text-white">Go to Forum</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                endforeach; 
            ?>
        </div>
    </div>
    </br></br>
    <hr>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo session()->get('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($threads)): ?>
        <h2>Search Results</h2>
        <div class="row">
            <?php foreach ($threads as $thread): ?>
                <div class="col-md-4">
                    <div class="card mb-3 shadow" onclick="location.href='<?= base_url('/forum/'.$thread->course_code.'/thread/' . $thread->thread_id) ?>'">
                        <div class="card-body">
                            <h4 class="card-title"><?= $thread->course_code ?></h4>
                            <h5 class="card-title">Title: <?= $thread->title ?></h5>
                            <hr>
                            <b>Content:</b>
                            <p class="card-text"><?= $thread->content ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?> 

    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>

    <!-- <script>
        const searchInput = document.querySelector('input[type="search"]');

        const cards = document.querySelectorAll('.card');

        searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();

        cards.forEach(function(card) {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const content = card.querySelector('.card-text').textContent.toLowerCase();

            if (title.includes(query) || content.includes(query)) {
            card.style.display = 'block';
            } else {
            card.style.display = 'none';
            }
        });
        });
    </script> -->
</body>
</html>