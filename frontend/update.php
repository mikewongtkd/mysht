<?php
include_once( 'config.php' );
global $config;

$ssl  = $config[ 'protocol' ] == 'https://';
$uuid = isset( $_GET[ 'uuid' ]) ? $_GET[ 'uuid' ] : NULL;

?>
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

    <!-- FontAwesome CSS -->
    <link href="vendor/fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">
    <link href="update/update.css" rel="stylesheet">

<?php if( $ssl ): ?>
    <!-- Custom styles for video capture -->
    <link href="update/ssl.css" rel="stylesheet">
<?php endif; ?>

    <script src="vendor/axllent/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>

<?php include_once( 'components/header.php' ); ?>

    <main role="main">
<?php
if( $ssl ) {
  include_once( 'update/ssl.php' );
  echo( "<script>" );
  include_once( 'update/ssl.js' );
  echo( "</script>" );

} else {
  include_once( 'update/firewall.php' );
}

?>
      <div class="interface" id="update-information-interface"> 
        <img id="picture"></img> 
        <form action="view.php" method="post"> 
          <div class="mb-3"> 
            <label for="name">Name</label> 
            <input type="text" class="form-control" id="name"></input> 
          </div> 
          <div class="mb-3"> 
            <label for="description">Description</label> 
            <textarea class="form-control" id="description" rows="3"></textarea> 
          </div> 
          <div class="mb-3"> 
            <label for="quantity">Quantity</label> 
            <input type="number" class="form-control" id="quantity" placeholder="1"></input> 
          </div> 
          <div class="mb-3">
            <div class="row">
              <div class="col-4 col-left"><button class="btn btn-primary" id="btn-cancel"><span class="fa-solid fa-circle-xmark"></span> Cancel</button></div>
              <div class="col-4 col-middle"><button class="btn btn-danger" id="btn-remove"><span class="fa-solid fa-trash"></span> Remove</button></div>
              <div class="col-4 col-right"><button class="btn btn-success" id="btn-update"><span class="fa-solid fa-circle-check"></span> Update</button></div>
            </div>
          </div>
        </form> 
      </div>
    </main>
  </body>
</html>
<!-- vim: set ts=2 sw=2 expandtab nowrap: -->
