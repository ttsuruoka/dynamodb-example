<h2><?php eh($thread->title) ?></h2>

<?php if ($post->hasError()): ?>
<p class="alert">
  validation error: 
  <?php if (!empty($post->validation_errors['name']['length'])): ?>invalid name<?php endif ?>
  <?php if (!empty($post->validation_errors['comment']['length'])): ?>invalid comment<?php endif ?>
</p>
<?php endif ?>

<form class="well" method="post" action="<?php eh(url('thread/write')) ?>">
  <label>Your name</label>
  <input type="text" class="span2" name="name"  value="<?php eh(Param::get('name')) ?>">
  <label>Comment</label>
  <textarea name="comment"<?php eh(Param::get('comment')) ?>></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
