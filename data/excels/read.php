<?php
function readCsv($filename) {
    $filename = "data/excels/$filename.csv";
    $file = fopen( $filename, "r" );
    
    if( $file == false ) {
       echo ( "Error in opening file" );
       exit();
    }
    
    $filesize = filesize( $filename );
    $filetext = fread( $file, $filesize );

    $lines = explode("\n",$filetext);
    $lines = array_slice($lines,1);
    $values = array();

    foreach ($lines as $line) {
        $elements = explode(";", $line);
        if (count($elements) < 2) continue;

        array_push($values, $elements);
    }

    fclose( $file );

    return $values;
}
?>