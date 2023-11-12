<?php
require __DIR__ . "/../vendor/autoload.php";
use Zxing\QrReader;
include_once( '../lib/uuid.php' );

if( ! isset( $_POST[ 'png' ])) {
  echo( "{\"error\":\"No PNG data received\"}\n" );
  exit();
}

save_png_and_exit( $_POST[ 'png' ]);

# ============================================================
function save_png_and_exit( $png ) {
# ============================================================
  $uuid = isset( $_POST[ 'uuid' ]) ? $_POST[ 'uuid' ] : null;
  if( is_null( $uuid )) { $uuid = MyshtUUID::new(); }
  error_log( "UUID: $uuid\n" ); # MW
  $file   = "images/$uuid.png";
  $png    = preg_replace( '/^data\:image\/png;base64,/', '', $png );
  $data   = base64_decode( $png );
  $qrcode = new QrReader( $data, QrReader::SOURCE_TYPE_BLOB );

  # ===== IF QR CODE CONTAINS VALID UUID, RETURN UUID AND EXIT
  if( $qrcode->getResult()) {
    $uuid = $qrcode->text();
    if( MyshtUUID::validate( $uuid )) {
      echo( "{\"uuid\":\"$uuid\"}\n" );
      exit();
    }
  }

  # ===== OTHERWISE STORE THE PICTURE, UPDATE THE DATABASE, AND RETURN THE ASSIGNED UUID
  $fp = fopen( $file, 'wb' );
  if( $fp ) {
    fwrite( $fp, $data );
    echo( "{\"uuid\":\"$uuid\"}\n" );

  } else {
    echo( "{\"error\":\"Cannot write to 'images/$uuid.png'\"}\n" );
  }
  fclose( $fp );
  exit();

}

?>

<!-- vim: set ts=2 sw=2 expandtab -->
