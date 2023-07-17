<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Forum - <?= $course_name ?></title>
    <style>
        .card {
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4">
                
                <h3 class="mt-4"> <a href="<?= base_url("forum/{$course_code}/thread/add_thread") ?>"> Add New Thread </a></h3>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url().'/forum/'.$course_name.'/'.$course_code ?>">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url().'/forum/'.$course_name.'/'.$course_code.'?tag=General' ?>">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url().'/forum/'.$course_name.'/'.$course_code.'?tag=Lecture' ?>">Lecture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url().'/forum/'.$course_name.'/'.$course_code.'?tag=Practical' ?>">Practical</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url().'/forum/'.$course_name.'/'.$course_code.'?tag=Assignment' ?>">Assignment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url().'/forum/'.$course_name.'/'.$course_code.'?sort=most_liked' ?>">Most Liked</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?= $course_name ?> (<?= $course_code ?>)</h1>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                <?php
                usort($threads, function($a, $b) {
                    if ($a['created_at'] == $b['created_at']) {
                        return 0;
                    }
                    return ($a['created_at'] > $b['created_at']) ? -1 : 1;
                });
                ?>
                <?php foreach ($threads as $thread): ?>
                    <div class="card mb-3 bg-light shadow-sm" onclick="location.href='<?= base_url('/forum/'.$course_code.'/thread/' . $thread['thread_id']) ?>'">
                        <div class="card-body">
                            <h5 class="card-title"><?= $thread['title'] ?></h5>
                            <p class="card-text text-truncate"><?= $thread['content'] ?></p>
                            <?php if ($thread['updated_at'] !== NULL): ?>
                            <p class="card-text"><small class="text-muted"><?= $thread['updated_at'] ?> <?= $thread['tag_name'] ?> <?= $thread['vote_count'] ?> likes</small></p>
                            <?php else: ?>
                            <p class="card-text"><small class="text-muted"><?= $thread['created_at'] ?> <?= $thread['tag_name'] ?> <?= $thread['vote_count'] ?> likes</small></p>
                            <?php endif; ?>
                            <?php if ($thread['user_id'] == $user_id): ?>
                            <a href="<?= base_url('/edit/' . $thread['thread_id']) ?>" class="btn btn-primary">Edit</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" id="current-page" value="1">
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <script>
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
    </script>

    <script>
        $(function() {
            const availableTags = <?= json_encode($availableTags) ?>;

            $('input[type="search"]').autocomplete({
                source: availableTags
            });
        });
    </script>

    <script>
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(function(navLink) {
            navLink.addEventListener('click', function() {
                navLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <script>
        $(document).ready(function () {
            if ($.cookie("scroll") !== null) {
                $(document).scrollTop($.cookie("scroll"));
            }
            $('#submit').on("click", function () {
                $.cookie("scroll", $(document).scrollTop());
            });
        });
    </script>

    <!-- <script>
        let lastWheelEventTime = 0;
        const wheelEventDelay = 1800;
        document.addEventListener ('wheel', (event) => {
            const currentTime = new Date().getTime();
            if (currentTime - lastWheelEventTime > wheelEventDelay) {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()-500) {
                    // console.log('Scroll event triggered');
                    let page = parseInt($('#current-page').val()) + 1;
                    $('#current-page').val(page);
                    let base_url = '< base_url() ?>';
                    let course_name = '<$course_name ?>';
                    let course_code = '<$course_code ?>';
                    let user_id = '$user_id ?>';
                    let page_url = base_url + 'forum/' + course_name + '/' + course_code + '/load_more_threads/' + page;
                    let thread_url = base_url + 'forum/' + course_code + '/thread/';

                    $.ajax({
                        url: page_url,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            response.sort(function(a, b) {
                                if (a.created_at > b.created_at) {
                                    return -1;
                                } else if (a.created_at < b.created_at) {
                                    return 1;
                                } else {
                                    return 0;
                                }
                            });                        
                            response.forEach(function(thread) {
                                let card = document.createElement('div');
                                card.className = 'card mb-3 bg-light shadow-sm';
                                card.onclick = function() {
                                    location.href = base_url + '/forum/' + course_code + '/thread/' + thread.thread_id;
                                };
                                
                                let cardBody = document.createElement('div');
                                cardBody.className = 'card-body';
                                
                                let cardTitle = document.createElement('h5');
                                cardTitle.className = 'card-title';
                                cardTitle.textContent = thread.title;
                                
                                let cardText = document.createElement('p');
                                cardText.className = 'card-text text-truncate';
                                cardText.textContent = thread.content;
                                
                                let cardTextSmall = document.createElement('p');
                                cardTextSmall.className = 'card-text';
                                
                                let smallText = document.createElement('small');
                                smallText.className = 'text-muted';
                                smallText.textContent = (thread.updated_at !== null ? thread.updated_at : thread.created_at) + ' ' + thread.tag_name + ' ' + thread.vote_count + ' likes';
                                
                                cardTextSmall.appendChild(smallText);
                                
                                cardBody.appendChild(cardTitle);
                                cardBody.appendChild(cardText);
                                cardBody.appendChild(cardTextSmall);
                                
                                if (thread.user_id == user_id) {
                                    let editButton = document.createElement('a');
                                    editButton.href = base_url + '/edit/' + thread.thread_id;
                                    editButton.className = 'btn btn-primary';
                                    editButton.textContent = 'Edit';
                                    cardBody.appendChild(editButton);
                                }
                                
                                card.appendChild(cardBody);
                                // console.log('card:', card); // log the constructed card element
                                
                                // append the new card to the page
                                document.querySelector('.col-sm-8').appendChild(card);
                            });
                        }
                    });
                }
                lastWheelEventTime = currentTime;
             }
        }, false);
    </script> -->
</body>
</html>
