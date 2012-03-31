<h2><?php eh($thread->title) ?></h2>

<p class="alert alert-success">
    You successfully wrote this post.
</p>

<a href="<?php eh(url('thread/view', array('thread_id' => $thread->id))) ?>">&rarr; Back to thread</a>
