<div class="container mt-5">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">

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
        
        <h5 class="mt-4"> <a href="<?= base_url("forum/$course_name/$course_code") ?>"> Back to <?= $course_name ?> </a></h5>
          <h3 class="panel-title">Add New Thread</h3>
        </div>

        <div class="panel-body">
          <?php echo form_open_multipart(base_url().'forum/'.$course_code.'/thread/add_thread'); ?>
           
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
              <label for="content">Content:</label>
              <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="form-group">
              <label for="tag">Tag:</label>
              <select class="form-control" id="tag" name="tag" required>
                <option value="General">General</option>
                <option value="Lecture">Lecture</option>
                <option value="Assignment">Assignment</option>
                <option value="Practical">Practical</option>
              </select>
            </div>

            <div class="form-group">
              <label for="attachments">Attachments:</label>
              <div id="attachment-inputs">
                <input type="file" id="attachments" name="attachments[]" multiple>
              </div>
            <button type="button" id="add-more-attachments" class="btn btn-secondary mt-2">Add More Attachments</button>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .dropzone {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
  }

  .dropzone-placeholder {
    margin-bottom: 10px;
  }

  .dropzone-placeholder i {
    font-size: 50px;
  }
  
  .thumbnail-image {
    width: 100px;
    height: auto;
    display: inline-block;
    margin-right: 10px;
  }
</style>
<script>
 document.getElementById('add-more-attachments').addEventListener('click', function() {
 var attachmentInputs = document.getElementById('attachment-inputs');
 var newInput = document.createElement('input');
 
 newInput.type = 'file';
 newInput.name = 'attachments[]';
 attachmentInputs.appendChild(newInput);
 });
</script>


<!-- <script>
  // Handle file drop event
  function handleFileDrop(e) {
    e.preventDefault();
    e.stopPropagation();

    // Remove the default dropzone placeholder
    var dropzone = document.getElementById('dropzone');
    dropzone.classList.remove('dropzone');

    // Append the dropped files to the file input element
    var fileInput = document.getElementById('attachments');
    fileInput.files = e.dataTransfer.files;

    // Display thumbnails for dropped files
    displayThumbnails(fileInput.files);
  }

  // Display thumbnails for selected files
  function displayThumbnails(files) {
    var thumbnailContainer = document.getElementById('thumbnail-container');
    thumbnailContainer.innerHTML = '';

    Array.from(files).forEach(function(file) {
      var thumbnail = document.createElement('img');
      thumbnail.classList.add('thumbnail-image');
      thumbnail.src = URL.createObjectURL(file);
      thumbnailContainer.appendChild(thumbnail);
    });
  }

  // Prevent default behavior for dragover and dragenter events
  function handleDragOver(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  // Set up event listeners
  var dropzone = document.getElementById('dropzone');
  dropzone.addEventListener('drop', handleFileDrop);
  dropzone.addEventListener('dragover', handleDragOver);
  dropzone.addEventListener('dragenter', handleDragOver);

  document.getElementById('add-more-attachments').addEventListener('click', function() {
    var attachmentInputs = document.getElementById('attachment-inputs');
    var newInput = document.createElement('input');

    newInput.type = 'file';
    newInput.name = 'attachments[]';
    attachmentInputs.appendChild(newInput);
  });

</script> -->
