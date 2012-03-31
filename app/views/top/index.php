<h2>Thread list</h2>

<ul>
<?php foreach ($threads as $v): ?>
  <li><a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>"><?php eh($v->title) ?></a></li>
<?php endforeach ?>
</ul>

