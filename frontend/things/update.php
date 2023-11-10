<?php
include_once( '../config.php' );
global $config;

$ssl = $config[ 'protocol' ] == 'https://';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../assets/images/favicon/favicon.ico">

    <title>Mysh&rsquo;t - A Simple Home Inventory System</title>

    <!-- Bootstrap core CSS -->
    <link href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link href="../../vendor/fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/album.css" rel="stylesheet">

<?php if( $ssl ): ?>
    <!-- Custom styles for video capture -->
    <link href="update/ssl.css" rel="stylesheet">
<?php endif; ?>

    <script src="../../vendor/axllent/jquery/jquery.slim.min.js"></script>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>

<?php 

include_once( '../components/header.php' ); 

if( $ssl ) {
  include_once( 'update/ssl.php' );
  echo( "<script>" );
  include_once( 'update/ssl.js' );
  echo( "</script>" );

} else {
  include_once( 'update/firewall.php' );
}

?>

  </body>
</html>
<!-- vim: set ts=2 sw=2 expandtab -->
