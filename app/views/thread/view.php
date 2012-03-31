<h2><?php eh($thread->title) ?></h2>

<?php foreach ($posts as $k => $v): ?>
<div class="post">
  <div class="meta">
    <?php eh($k + 1) ?>: <?php eh($v->name) ?> <?php eh(date('Y-m-d H:i:s', $v->getCreatedTime())) ?>
  </div>
  <div>
    <?php echo readable_comment($v->comment) ?>
  </div>
</div>
<?php endforeach ?>

<hr>

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
