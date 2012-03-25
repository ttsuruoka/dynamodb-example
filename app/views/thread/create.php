<h2>Create a thread</h2>

<form class="well" method="post" action="<?php url('thread/create') ?>">
  <label>Thread title</label>
  <input type="text" class="span3" name="title" placeholder="Type something…">
  <label>Your name</label>
  <input type="text" class="span2" name="name"  placeholder="">
  <label>Comment</label>
  <textarea name="comment"></textarea>
  <br />
  <input type="hidden" name="page_next" value="create_end">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
