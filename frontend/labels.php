<?php

$db = new SQLite3( '/usr/local/mysht/db.sqlite' );

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon/favicon.ico">

    <title>Mysh!t - A Simple Home Inventory System</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">

    <!-- CSS for Photo capture -->
    <link href="update/ssl.css" rel="stylesheet">

  </head>

  <body>

<?php include_once( 'components/header.php' ); ?>

    <main role="main">
<?php 
  for( $x = 0; $x < 3; $x++ ):
?>
      <div class="row">
<?php
    for( $y = 0; $y < 4; $y++ ):
?>

<?php
endfor;
?>
      </div>
<?php
endfor;
?>


    </main>

    <footer class="text-muted">
      <div class="container">
        <p><a href="https://github.com/mikewongtkd/mysht">Mysh!t</a> is <a href="https://opensource.org/">Open Source software</a> available under the <a href="https://opensource.org/license/mit/">MIT license</a>.</p>
      </div>
    </footer>

    <script src="vendor/axllent/jquery/jquery.slim.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<!-- vim: set ts=2 sw=2 expandtab nowrap: -->
