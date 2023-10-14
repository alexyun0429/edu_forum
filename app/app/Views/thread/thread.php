<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-4">
        <h3 class="mt-4"> <button id="back-button" class="btn btn-primary">Back to forum</button></h3>
        
        
        <hr class="d-sm-none">
      </div>

        <div class="col-sm-8">
          <div class="panel panel-default">

            <div class="panel-heading">
            <h3 class="panel-title"><?= $thread['title'] ?></h3>
            </div>

            <div class="panel-body">
              <p><?= $thread['content'] ?></p>

              <?php if (!empty($attachments)): ?>
                <h6>Attachments</h6>
                <div class="row">
                  <?php foreach ($attachments as $attachment): ?>
                    <div class="col-sm">
                      <img src="<?= base_url('writable/uploads/' . $attachment['filename']) ?>" class="img-fluid" alt="<?= $attachment['filename'] ?>">
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <?php if ($thread['updated_at'] !== NULL): ?>
                <p><small class="text-muted"><?= $thread['updated_at'] ?> by <?= $thread['username'] ?> <?= $thread['tag_name'] ?> <span class="likes-count"><?= $thread['vote_count'] ?></span> likes</small></p>
              <?php else: ?>
                <p><small class="text-muted"><?= $thread['created_at'] ?> by <?= $thread['username'] ?> <?= $thread['tag_name'] ?> <span class="likes-count"><?= $thread['vote_count'] ?></span> likes</small></p>
              <?php endif; ?>

              <button type="button" class="btn btn-default btn-like" data-thread-id="<?= $thread['thread_id'] ?>">Like</button>
              <hr>

              <h4>Comments</h4>
              <?php foreach ($comments as $comment): ?>
                <div class="card mb-3 bg-light shadow-sm">
                  <div class="card-body">
                    <p><?= $comment->content ?></p>
                    <p><small class="text-muted"><?= $comment->created_at ?> by <?= $comment->username ?></small></p>
                  </div>
                </div>
              <?php endforeach; ?>

            <hr>
            <form id="add-comment-form" method="POST">
              <div class="form-group">
                <label for="content">Write a comment:</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                <input type="hidden" name="thread_id" value="<?= $thread['thread_id'] ?>">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </br>
  </div>
  </br>

  <script>
    document.querySelector('.btn-like').addEventListener('click', function() {
      var threadId = this.dataset.threadId;
      var likeButton = this;
      $.ajax({
          url: '<?= base_url("forum/{$course_code}/thread") ?>/' + threadId + '/like',
          type: 'POST',
          dataType: 'json',
          success: function(response) {
              // console.log(response);
              if (response.success) {
                  document.querySelector('.likes-count').textContent = response.likes;

                  if (likeButton.textContent === 'Like') {
                      likeButton.textContent = 'Unlike';
                  } else {
                      likeButton.textContent = 'Like';
                  }
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log('An error occurred: ' + textStatus + ' ' + errorThrown);
          }
      });
    });
  </script>

  <script>
  $(document).ready(function() {
    $('#add-comment-form').submit(function(e) {
      e.preventDefault(); 
      var formData = $(this).serialize();
      // console.log(formData);

      $.ajax({
        url: '<?= base_url("forum/{$course_code}/thread/{$thread['thread_id']}/add_comment") ?>',
        type: 'POST',
        data: formData,
        // contentType: 'application/json',
        dataType: 'json', 
        success: function(response) {
          if (response.success) {
          var comment = response.comment;
          var commentElement = '<div class="card mb-3 bg-light shadow-sm"><div class="card-body"><p>' + comment.content + '</p><p><small class="text-muted">' + comment.created_at + ' by ' + comment.username + '</small></p></div></div>';
          $('#add-comment-form').before(commentElement);
          $('#add-comment-form')[0].reset();
            } else {
              
              var error = response.error;
            
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('An error occurred: ' + textStatus + ' ' + errorThrown);
          }
        });
      });
    });
  </script>

  <script>
      document.getElementById("back-button").addEventListener("click", function() {
          window.history.back();
      });
  </script>
</body>