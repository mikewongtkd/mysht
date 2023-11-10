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
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/album.css" rel="stylesheet">
  </head>

  <body>

<?php include_once( '../components/header.php' ); ?>

    <main role="main">
      <div class="album py-5 bg-light">
        <div class="container">
          <form>
            <input type="search" class="form-control ds-input" id="filter-input" placeholder="Filter..." aria-label="Filter for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">
          </form>

          <div class="row">
<?php

$results = $db->query( "select uuid, data from document where class='thing' and json_extract( data, '$.status.label' ) = 'available' order by json_extract( data, '$.added.timestamp' ) asc" );
$rows    = [];
while( $row = $results->fetchArray()) {
  $rows []= $row;
}

if( count( $rows ) > 0 ) { echo( '<h1>Things</h1>' ); }

foreach( $rows as $row ):
  $thing = json_decode( $row[ 'data' ], true );
  $uuid  = $thing[ 'uuid' ] = $row[ 'uuid' ];
  $image = "/var/www/html/assets/images/things/$uuid.png";
  $image = file_exists( $image ) ? $image : '/var/www/html/assets/images/no-image-placeholder.png';
?>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?= $image ?>" alt="<?= $thing[ 'name' ] ?>">
                <div class="card-body">
                  <p class="card-text"><?= $thing[ 'name' ] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary btn-update"  data-uuid="<?= $uuid ?>">Update</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary btn-take"    data-uuid="<?= $uuid ?>">Take</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary btn-discard" data-uuid="<?= $uuid ?>">Discard</button>
                    </div>
                    <small class="text-muted"><?= $thing[ 'added' ][ 'timestamp' ] ?></small>
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

    <script src="vendor/axllent/jquery/jquery.slim.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<!-- vim:set ts=2 sw=2 expandtab -->
