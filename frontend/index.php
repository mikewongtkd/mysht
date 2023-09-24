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
          <p>
            <a href="things/add.php" class="btn btn-primary my-2">Add Things</a>
            <a href="things/return.php" class="btn btn-secondary my-2">Return Things</a>
            <form method="post" action="things/search.php">
              <input type="search" class="form-control ds-input" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">
            </form>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
<?php

$results = $db->query( "select uuid, data from document where class='thing' and json_extract( data, '$.status.label' ) = 'taken' order by json_extract( data, '$.status.timestamp' ) asc" );
$rows    = [];
while( $row = $results->fetchArray()) {
  $rows []= $row;
}

if( count( $rows ) > 0 ) { echo( '<h2>Please Return These Things</h2>' ); }

foreach( $rows as $row ):
  $thing = json_decode( $row[ 'data' ], true );
  $uuid  = $thing[ 'uuid' ] = $row[ 'uuid' ];
?>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="assets/images/things/<?= $uuid ?>" alt="<?= $thing[ 'name' ] ?>">
                <div class="card-body">
                  <p class="card-text"><?= $thing[ 'name' ] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary btn-return"  data-uuid="<?= $uuid ?>">Return</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary btn-lost"    data-uuid="<?= $uuid ?>">Lost</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary btn-discard" data-uuid="<?= $uuid ?>">Discard</button>
                    </div>
                    <small class="text-muted"><?= $thing[ 'status' ][ 'timestamp' ] ?></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
  endforeach;
?>
        </div>
      </div>

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
<!-- vim: set ts=2 sw=2 expandtab -->
