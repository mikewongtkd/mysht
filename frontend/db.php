<?php

$db      = new SQLite3( '/usr/local/mysht/db.sqlite' );
$results = query( $_POST );

echo $results;

function query( $request ) {
  global $db;

  // Default query
  $query = [ 
    "select" => "uuid, data, created, modified, seen from document",
    "where" => [ 
    ],
    "limit" => 10,
    "error" => []
  ];
  # ===== HANDLE PAGINATION
  if( $request[ 'limit' ]) {
    $query[ 'limit' ] = $request[ 'limit' ];
  }
  if( $request[ 'last-seen' ]) {
    $query[ 'where' ] []= "seen > '{$request[ 'last-seen' ]}'";
  }

  # ===== HANDLE FREE TEXT SEARCH
  if( $request[ 'search' ]) {
    $search = SQLite3::escapeString( $request[ 'search' ]);
    $query[ 'where' ] []= "data like '%{$search}%'";
  }

  # ===== HANDLE CLASS SEARCH
  $classes = [];
  if( $request[ 'class-place' ]) {
    $classes []= "class='place'";
  }
  if( $request[ 'class-thing' ]) {
    $classes []= "class='thing'";
  }
  if( count( $classes ) == 0 ) { 
    $query[ 'what' ] []= "class is null";
    $query[ 'error' ] []= "No class selected";
  } else {
    $query[ 'what' ] []= join( ' or ', $classes );
  }

  # ===== HANDLE DATE SEARCH
  if( $request[ 'date' ] != 'none' ) {
    $col = $request[ 'date' ];

    if( $request[ 'start-date' ]) {
      $start = "{$request[ 'start-date' ]} 00:00:00";
      $query[ 'where' ] []= "{$col} >= '{$start}'";
    }
    if( $request[ 'end-date' ]) {
      $end   = "{$request[ 'end-date' ]} 23:59:59";
      $query[ 'where' ] []= "{$col} <= '{$end}'";
    }
    if(( $start && $end ) && ( $start > $end )) {
      $query[ 'error' ] []= "Selected start date exceeds end date";
    }
  }

  # ===== ALWAYS FILTER DELETED DOCUMENTS
  $query[ 'where' ] []= "deleted is null";

  # ===== GET COUNT
  $count = $db->querySingle( "select count(*) as rows from document where " . join( ' and ', $query[ 'where' ]) . " order by seen desc;" );
  $count = $count ? int( $count ) : 0;

  # ===== GET ROWS
  $rows  = [];
  $sth   = $db->query( "select {$query[ 'select' ]} from document where " . join( ' and ', $query[ 'where' ]) . " order by seen desc limit {$query[ 'limit' ]};" );
  while( $row = $sth->fetchArray()) {
    $row[ 'data' ] = json_decode( $row[ 'data' ], true );
    $row[ 'tags' ] = get_tags( $row[ 'uuid' ]);
    $rows []= $row;
  }
  $last = count( $rows ) > 0 ? $rows[ -1 ][ 'seen' ] : '';

  $response = [ 'count' => $count, 'rows' => $rows, 'last' => $last, 'page_size' => $query[ 'limit' ]];

  if( count( $query[ 'error' ]) > 0 ) {
    $response[ 'error' ] = $query[ 'error' ];
  }

  return json_encode( $response );
}

# ============================================================
function get_tags( $uuid ) {
# ============================================================
  global $db;
  $tags  = [];
  $sth   = $db->query( "select uuid, data from document, document_group where document_group.class='tag' and (a='{$uuid}' and b=uuid) or (a=uuid and b='{$uuid}')" );
  while( $row = $sth->fetchArray()) {
    $tag = json_decode( $row[ 'data' ], true );
    $tag[ 'uuid' ] = $row[ 'uuid' ];
    $tags []= $tag;
  }
  return $tags;
}

/* vim: set ts=2 sw=2 expandtab nowrap: */ ?>
