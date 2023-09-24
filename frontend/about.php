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

    <title>Mysh&rsquo;t - A Simple Home Inventory System</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">
  </head>

  <body>
<?php include_once( 'components/header.php' ); ?>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <img src="assets/images/favicon/favicon.png" width="120pt" />
          <h1 class="jumbotron-heading">Mysh&rsquo;t</h1>
          <p class="lead text-muted">Simple Home Inventory System</p>
        </div>
      </section>
      <section>
        <div class="container">
          <ol>
            <li>Create a bunch of QR code <a href="https://www.avery.com/blank/labels/94107">labels</a> using a printer.</li>
            <li>Slap the labels on the storage bins and shelves.</li>
            <li>Use your phone to take pictures of your sh&rsquo;t and scan the QR codes of the bins and the shelf.</li>
            <li>Annotate the pictures in Mysh&rsquo;t.</li>
            <li>Boom! You know where your sh&rsquo;t is stored!</li>
          </ol>
        </div>
      </section>
    </main>

    <footer class="text-muted">
      <div class="container">
        <p><a href="https://github.com/mikewongtkd/mysht">Mysh't</a> is <a href="https://opensource.org/">Open Source software</a> available under the <a href="https://opensource.org/license/mit/">MIT license</a>.</p>
      </div>
    </footer>

    <script src="vendor/axllent/jquery/jquery.slim.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<!-- vim:set ts=2 sw=2 expandtab -->
