<?php

class MyshtUuid {
  public static function new() {
    $db     = new SQLite3( '/usr/local/mysht/db.sqlite' );
    $uuid   = null;
    $exists = FALSE;

    do {
			$uuid    = file_get_contents( '/proc/sys/kernel/random/uuid' ); 
			$uuid    = trim( $uuid );
      $results = $db->query( "select count(*) as found from document where uuid='$uuid'" );
      if( $results == FALSE ) {
        $exists = 0;
        break;
      }
      $row     = $results->fetchArray();
      $exists  = $row[ 'found' ];
    } while( $exists );

    return $uuid;
  }

  public static function isValid( $uuid ) {
    return preg_match( '/^\[0-9A-Za-z]{8}\:\[0-9A-Za-z]{4}\:\[0-9A-Za-z]{4}\:\[0-9A-Za-z]{4}\:\[0-9A-Za-z]{12}$/', $uuid );
  }
}
?>
