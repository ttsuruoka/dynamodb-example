<h2>Create a thread</h2>

<?php if ($thread->hasError() || $post->hasError()): ?>
<p class="alert">
  validation error: 
  <?php if (!empty($thread->validation_errors['title']['length'])): ?>invalid title<?php endif ?>
  <?php if (!empty($post->validation_errors['name']['length'])): ?>invalid name<?php endif ?>
  <?php if (!empty($post->validation_errors['comment']['length'])): ?>invalid comment<?php endif ?>
</p>
<?php endif ?>

<form class="well" method="post" action="<?php url('thread/create') ?>">
  <label>Thread title</label>
  <input type="text" class="span3" name="title" value="<?php eh(Param::get('title')) ?>" placeholder="Type something…">
  <label>Your name</label>
  <input type="text" class="span2" name="name"  value="<?php eh(Param::get('name')) ?>">
  <label>Comment</label>
  <textarea name="comment"><?php eh(Param::get('comment')) ?></textarea>
  <br />
  <input type="hidden" name="page_next" value="create_end">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
