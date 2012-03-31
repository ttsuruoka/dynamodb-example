<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DynamoDB example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>

  </head>
  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php eh(url()) ?>">DynamoDB example</a>
          <div class="nav-collapse">
            <ul class="nav">
            <li><a href="<?php eh(url()) ?>">Home</a></li>
            <li><a href="<?php eh(url('thread/create')) ?>">Create thread</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <?php echo $content ?>
      <hr>
      <footer>
        <div id="dynamo-log">
          <h5>DynamoDB queries:</h5>
          <?php foreach (Dynamo::conn()->operations as $v): ?>
          <div title="<?php eh($v['response']) ?>">
            <?php eh($v['time']) ?>s:
            <a href="http://docs.amazonwebservices.com/amazondynamodb/latest/developerguide/API_<?php eh($v['operation']) ?>.html" target="_blank"><?php eh($v['operation']) ?></a>:
            <?php eh($v['params']) ?>
          </div>
          <?php endforeach ?>
          <?php if (empty(Dynamo::conn()->operations)): ?>
          No queries.
          <?php endif ?>
        </div>
        <?php if (!ENV_PRODUCTION): ?>
        <p><?php eh(round(microtime(true) - TIME_START, 3)) ?>s</p>
        <?php endif ?>
      </footer>
    </div>

    <script>
    $(function() {
      $('#dynamo-log div').tooltip();
    });
    </script>

  </body>
</html>

