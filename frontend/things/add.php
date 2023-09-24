<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/images/favicon/favicon.ico">

    <title>Mysh&rsquo;t - A Simple Home Inventory System</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/album.css" rel="stylesheet">

    <script src="../vendor/axllent/jquery/jquery.slim.min.js"></script>
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>

<?php include_once( '../dialogs/toast.php' ); ?>
<?php include_once( '../components/header.php' ); ?>

    <main role="main">
      <div class="container">
        <form action="post" method="add.php">
          <center>
            <img id="preview" src="../assets/images/no-image-placeholder.png" alt="image preview" style="height: 200px; margin: 2em 0 1em 0; border-radius: 0.5em;">
            <input class="form-control" type="file" accept="image/*" name="photo" id="photo" style="width: 260px;">
          </center>
        </form>
      </div>
    </main>

  <script>
    function preview( input ) {
        if( ! input.files || ! input.files[ 0 ]) { return; }
        let reader = new FileReader();
        reader.onload = e => {
          $( '#preview' ).attr( 'src', e.target.result );
        };

        reader.readAsDataURL( input.files[ 0 ]);
    }

    $( '#photo' ).change( ev => { let image = $( ev.target )[ 0 ]; preview( image ); });
  </script>

  </body>
</html>
<!-- vim: set ts=2 sw=2 expandtab -->
