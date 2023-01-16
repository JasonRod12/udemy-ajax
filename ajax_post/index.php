<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ajax Php Blog</title>
  <link rel="stylesheet" type="text/css" href="assets/css/foundation.min.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>

<div class="grid-container">

  <div class="callout secondary">

    <h2>Blog with Ajax</h2>

    <div id="output">
      This is the orignal text when the page loads up first.
    </div>

    <hr />

    <!-- Form Create Post -->
    <form id="create_post_form" method = "post" action="api/posts/create_post.php" onsubmit="return create_post(this)">
      <div class="grid-container">
        <h4>Create Post</h4>
        <div class="grid-x grid-padding-x">
          <div class="medium-9 cell">
            <label>Post Title
            <input type="text" id="post_title" name="post_title" placeholder="Enter Post Title" required>
            </label>
          </div>

          <div class="medium-9 cell">
            <label>Post body
          <textarea id="post_body" name="post_body" placeholder="Enter Post Body" cols="30" rows="5" required></textarea>
            </label>
          </div>

            <div class="medium-9 cell">
              <input type="submit" class="button" value="Create Post">
            </div>


        </div>
      </div>
    </form>
    <!-- Form Create Post Ends -->


  <!-- Form Edit Post starts -->
  <form id="edit_post_form" method = "post" action="api/posts/update_post.php" onsubmit="return updateData(this)">
    <div class="grid-container">
      <h4>Edit Post</h4>
      <div class="grid-x grid-padding-x">
        <div class="medium-9 cell">
          <label>Post Title
          <input type="text" id="edit_post_title" name="edit_post_title" placeholder="Enter Post Title" required>
          </label>
        </div>

        <div class="medium-9 cell">
          <label>Post body
        <textarea id="edit_post_body" name="edit_post_body" placeholder="Enter Post Body" cols="30" rows="5" required></textarea>
          </label>
        </div>

          <!-- Hidden form field -->
          <input type="hidden" id="edit_post_id" name="edit_post_id" />
          <!-- Hidden form field -->

          <div class="medium-9 cell">
            <input type="submit" class="button" value="Update Post">
          </div>


      </div>
    </div>
  </form>

  <!-- Form Edit Post ends -->

  </div>


<div id="display_post">
</div>
<br /> <br />

</div>
<!-- GRID CONTAINER ENDS -->
<script src="assets/scripts/ajax_post.js"></script>
</body>
</html>
