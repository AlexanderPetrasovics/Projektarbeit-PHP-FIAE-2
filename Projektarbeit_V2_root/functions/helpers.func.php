<?php
/**
 * @file    helpers.func.php
 * @author  Alexander Petrasovics
 * @brief   Hilfsfunktionen welche Schreibarbeit waehrend der Entwicklung verkuerzen.
 */

/**
 * @fn          out( $str )
 * @param[in]   $str Der auszugebende String.
 * @brief       Gibt eine Zeichenkette als Einzeiler aus.
 * @return      Keine Rueckgabe.
 */
function out( $str ) {
    echo "<pre>" . $str . "</pre>";
}

/**
 * @fn          out_array( $arr )
 * @param[in]   $arr Ein eindimensionaler Array.
 * @brief       Gibt die Arraywerte mit Zeilenumbruechen aus.
 * @return      Keine Rueckgabe.
 */
function out_array( $arr ) {
    if( is_array( $arr ) ) {
        foreach( $arr as $tmp ) {
            out( $tmp );
        }
    } 
}

/**
 * @fn          createElement( $tag, $attribs = array(), $value = null )
 * @param[in]   $tag        das HTML-Tag.
 * @param[in]   $attribs    HTML-Attributsliste als Array.
 * @param[in]   $value      Optionaler Wert fuer nicht selbst schliessende HTML-Elemente.
 * @brief       Generiert eine HTML-Zeichenkette, welche ein HTML-Element darstellt.
 * @return      Eine HTML-Zeichenkette - Basierend darauf, ob Selbstschliessend oder nicht.
 */ 
function createElement( $tag, $attribs = array(), $value = null ) {    
    $attributes = "";
    
    array_walk( $attribs, function( $value, $key ) use ( &$attributes ) {
        if( is_string( $value ) ) {
            $attributes .= " ${key} = \"${value}\"";
        } else {
            $attributes .= " ${key} = ${value}";
        }        
    } );
    $val = "";
    if( is_array( $value ) ) {
        foreach( $value as $v ) {
            $val .= $v;
        }
    } else {
        $val = $value;
    }
    return ( $val )
        ? "<${tag}{$attributes}>${val}</${tag}>"
        : "<${tag}{$attributes}/>";
}

?>