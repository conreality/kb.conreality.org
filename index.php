<?php
require_once '.php/EasyRdf.php';

$graph = new EasyRdf_Graph();
foreach (new DirectoryIterator(dirname(__FILE__)) as $dir_entry) {
  if ($dir_entry->getExtension() == 'ttl') {
    $graph->parseFile($dir_entry->getPathname());
  }
}

$sidebar = ''; // TODO: construct TOC

if (preg_match('|^/([0-9A-Za-z&-]+)$|', $_SERVER['REQUEST_URI'], $matches) &&
    file_exists($matches[1] . '.ttl')) {
  // TODO
  $link = $matches[1];
  $content = '';
  $title = '';
}
else {
  http_response_code(404);
  $content = '<h1>404 Not Found</h1>';
  $title = '404 Not Found';
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo $title ? "$title &mdash; " : '' ?>Conreality KB</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cosmo/bootstrap.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/index.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body role="document">
    <nav id="navbar" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Conreality KB</a>
          <span class="navbar-text navbar-version pull-left"><b><?php echo gmdate('Y-m-d') ?></b></span>
        </div>
        <div class="collapse navbar-collapse nav-collapse">
          <ul class="nav navbar-nav">
          </ul>
          <form class="navbar-form navbar-right">
<!--
            <button id="edit" type="button" class="btn btn-primary">Edit</button>
-->
          </form>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-9 content">
          <div class="section">
            <?php echo $content ?>
          </div>
        </div>
        <div class="col-md-3 sidebar">
          <div class="panel panel-default">
            <div class="panel-body">
               <?php echo $sidebar ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <p class="pull-right">
          <a href="#">Back to top</a><br/>
        </p>
        <p>
          All materials herein are released into the
          <a href="https://creativecommons.org/publicdomain/zero/1.0/">public domain</a>.
        </p>
      </div>
    </footer>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/index.js"></script>
  </body>
</html>
