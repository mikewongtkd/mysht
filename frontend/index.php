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

    <!-- FontAwesome CSS -->
    <link href="vendor/fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">

    <!-- CSS for Photo capture -->
    <link href="update/ssl.css" rel="stylesheet">

    <style>
      #advanced-search, #btn-advanced-search { margin-top: 1.5em; }
      #advanced-search { text-align: left; }
      .btn-class {
        width: calc( 50% - 22.5px );
        margin-left: 20px;
        margin-right: 0;
      }
    </style>
  </head>
  <body>

<?php include_once( 'components/header.php' ); ?>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <img src="assets/images/favicon/favicon.png" width="120pt" />
          <h1 class="jumbotron-heading">Mysh!t</h1>
          <p class="lead text-muted">Simple Home Inventory System</p>
          <p>
            <a href="update.php" class="btn btn-primary my-2"  >Add Things</a>
            <a href="return.php" class="btn btn-secondary my-2">Return Things</a>
            <form>
              <div class="row">
                <div class="col-10">
                  <input type="search" class="form-control ds-input" name="search" id="search" placeholder="Search..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0">
                </div>
                <div class="col-2 d-grid">
                  <button class="btn btn-success" id="btn-search"><span class="fa-solid fa-magnifying-glass"></span></button>
                </div>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#advanced-search" id="btn-advanced-search">Advanced Search</button>
              </div>
              <div class="collapse" id="advanced-search">
                <div class="card card-body">
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-2">
                        <label for="classes">Classes</label>
                      </div>
                      <div class="col-10">
                        <div class="classes">
                          <button class="btn btn-toggle btn-class btn-primary active" name="class-thing" id="btn-class-thing">Things</button>
                          <button class="btn btn-toggle btn-class btn-primary active" name="class-place" id="btn-class-place">Places</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="date">Search over Date Range</label>
                    <select class="form-control" name="date">
                      <option value="none">Select one...</option>
                      <option value="created">Created</option>
                      <option value="modified">Modified</option>
                      <option value="seen">Last Seen</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="start-date">Start Date</label>
                    <input class="form-control" type="date" name="start-date"></input>
                  </div>
                  <div class="mb-3">
                    <label for="end-date">End Date</label>
                    <input class="form-control" type="date" name="end-date"></input>
                  </div>
                  <div class="mb-3">
                  </div>
                </div>
              </div>
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
  $image = "/var/www/html/data/images/$uuid.png";
  $image = file_exists( $image ) ? $image : '/var/www/html/assets/images/no-image-placeholder.png';
?>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?= $image ?>" alt="<?= $thing[ 'name' ] ?>">
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
        <p><a href="https://github.com/mikewongtkd/mysht">Mysh!t</a> is <a href="https://opensource.org/">Open Source software</a> available under the <a href="https://opensource.org/license/mit/">MIT license</a>.</p>
      </div>
    </footer>

    <script src="vendor/axllent/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      $( '.btn-toggle' ).click( ev => {
        ev.preventDefault();
        let target = $( ev.target );
        if( target.parent().hasClass( 'btn-toggle' )) { target = target.parent(); }

        if( target.hasClass( 'active' )) {
          target.addClass( 'btn-secondary' );
          target.removeClass( 'btn-primary' );
          target.removeClass( 'active' );

        } else {
          target.addClass( 'btn-primary' );
          target.addClass( 'active' );
          target.removeClass( 'btn-secondary' );
        }
      });
      $( '#btn-advanced-search' ).click( ev => { ev.preventDefault(); });
      $( '#btn-search' ).click( ev => { 
        ev.preventDefault(); 
        let message = {};
        $( 'form .form-control' ).each(( i, el ) => {
          let input = $( el );
          message[ input.attr( 'name' )] = input.val();
        });

        $( 'form .btn-toggle' ).each(( i, el ) => {
          let input = $( el );
          message[ input.attr( 'name' )] = input.hasClass( 'active' );
        });

        console.log( message ); // MW
        $.post( 'db.php', message )
        .then( response => {
          console.log( response ); // MW
        });
      });
    </script>
  </body>
</html>
<!-- vim: set ts=2 sw=2 expandtab nowrap: -->
