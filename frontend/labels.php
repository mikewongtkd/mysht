<?php
include_once( 'lib/uuid.php' );

$db = new SQLite3( '/usr/local/mysht/db.sqlite' );

function abbreviate_uuid( $uuid ) {
  $first4 = substr( $uuid, 0, 4 );
  $last4  = substr( $uuid, -4, 4 );

  return "{$first4}...{$last4}";
}

$cols = isset( $_GET[ 'cols' ]) ? $_GET[ 'cols' ] : 3;
$rows = isset( $_GET[ 'rows' ]) ? $_GET[ 'rows' ] : 4;
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

  </head>

  <body>
    <style>
      .label { text-align: center; }
      @media print {
        .label { margin-top: 0.3in; margin-bottom: 0.3in; }
        .label-row-4 .label { margin-bottom: 0; }
      }

      .col-left   { text-align: left; }
      .col-middle { text-align: center; }
      .col-right  { text-align: right; }

      @media print {
        form {
          display: none;
        }
      }
    </style>

<?php include_once( 'components/header.php' ); ?>

    <main role="main">
      <form method="get" action="labels.php">
        <div class="mb-3"> 
          <label for="labels-per-page">Labels per Page</label> 
          <select class="form-control" id="labels-per-page">
            <option value="1x1">1 Label</option>
            <option value="3x4">12 Labels (3 cols, 4 rows)</option>
          </select> 
        </div> 
        <input type="hidden" name="cols" value="<?= $cols ?>"></input>
        <input type="hidden" name="rows" value="<?= $rows ?>"></input>
        <div class="mb-3"> 
          <div class="row">
            <div class="col-4 col-left">&nbsp;</div>
            <div class="col-4 col-middle">&nbsp;</div>
            <div class="col-4 col-right"><button class="btn btn-success" id="btn-update"><span class="fa-solid fa-circle-check"></span> Update</button></div>
          </div>
        </div> 
      </form>
      <div class="labels">
<?php 
  for( $y = 0; $y < $rows; $y++ ):
?>
        <div class="row label-row-<?= $y + 1 ?>">
<?php
    for( $x = 0; $x < $cols; $x++ ):
    $uuid  = MyshtUUID::new();
?>
          <div class="col-4 label label-col-<?= $x + 1 ?>">
            <img src="label.php?uuid=<?= $uuid ?>"><br>
            <?= abbreviate_uuid( $uuid ) ?>
          </div>
<?php
endfor;
?>
        </div>
<?php
endfor;
?>
      </div>
    </main>

    <footer class="text-muted">
      <div class="container">
        <p><a href="https://github.com/mikewongtkd/mysht">Mysh!t</a> is <a href="https://opensource.org/">Open Source software</a> available under the <a href="https://opensource.org/license/mit/">MIT license</a>.</p>
      </div>
    </footer>

    <script src="vendor/axllent/jquery/jquery.slim.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      $( '#labels-per-page' ).val( '<?= $cols ?>x<?= $rows ?>' );
      $( '#labels-per-page' ).change( ev => {
        let target = $( ev.target );
        let value  = target.val();
        let [cols, rows] = value.split( /x/ );
        $( 'form input[name="cols"]' ).val( cols );
        $( 'form input[name="rows"]' ).val( rows );
      });
    </script>
  </body>
</html>
<!-- vim: set ts=2 sw=2 expandtab nowrap: -->
