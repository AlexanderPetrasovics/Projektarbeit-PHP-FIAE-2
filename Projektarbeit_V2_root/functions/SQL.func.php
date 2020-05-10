<?php
/**
 * @file    SQL.func.php
 * @author  Alexander Petrasovics
 * @brief   Hier befinden sich alle Datenbankfunktionen.
 */

/**
 * @fn          database()
 * @brief       Erstellt eine Datenbankfunktion, welche bei erfolgreicher Datenbankobjekt-erstellung\n
 *              als Parameter eine Query-Funktion, ein Boolwert zur Rueckgabe und einen Daten-Array aufnimmt.
 * @return      Funktion mit Datenbankobjekt, aufzurufende Funktion, Boolwert zur Rueckgabe und einem Datenarray.
 */
function database() {
    // Die Parameter sind zentralisiert in der config.inc.php definiert!
    return ( $db = mysqli_connect( HOST, USER, PWD, DB, PORT ) )
    ? function( $fn, $stmt = null, $doReturn = null, $data = null ) use ( $db ) {
        return $fn( $db, $stmt, $doReturn, $data );        
    }
    : false;
}

/**
 * @fn          sql_query( $db, $stmt, $doReturn, $data = null ).
 * @param[in]   $db       Das Datenbankobjekt.
 * @param[in]   $stmt     Das auf der Datenbank auszufuehrende Statement.
 * @param[in]   $doReturn   Rueckgabe eines Resultats aus der Datenbankabfrage.
 * @param[in]   $data   (optional) Array mit Daten, welche in der Abfrage eingepflegt werden.
 * @brief       Fuehrt die Datenbankabfrage mit optionalen Daten zusammen\n
 *              und gibt einen Array mit den Ergebnissen der Abfrage zurueck sofern $doReturn auf true gesetzt ist.\n
 *              Das ist eine schnelle und unsaubere Loesung aber immernoch kompakter als individuelle Query-Funktionen zu erstellen.
 *              
 * @return      Assoziativer Datenarray oder nichts.
 */
function sql_query( $db, $stmt, $doReturn, $data = null ) {    
    // Werte pruefen
    if( $data ) {
        if( is_array( $data ) ) {
            $sanitized = array_map( function( $var ) {
                return ( is_string( $var ) )
                    ? "'" . trim( htmlspecialchars( stripslashes( $var ) ) ) . "'"
                    : $var;                                    
            }, $data );
        }    
        // Platzhalter( PLACEHOLDER-Define! )  mit den Werten aus $data fuellen
        $tmp = explode(" ", $stmt );
        $count = 0;
        for( $i = 0; $i < sizeof( $tmp ); ++$i ) {
            if( $tmp[ $i ] === PLACEHOLDER ) {
                $tmp[ $i ] = $sanitized[ $count ];
                $count++;
            }
        }
        // Finalen Query-String erstellen und abfeuern
        $stmt = implode( ' ',$tmp );
    }        
    $result = array();
    $qry = mysqli_query( $db, $stmt );
    if( $doReturn ) {
        if( mysqli_num_rows( $qry ) > 0 ) {
            while( $tmp = mysqli_fetch_assoc( $qry ) ) {
                $result[] = $tmp;
            }
        } else {
            return null;
        }
        return $result;
    }    
}

/**
 * @fn          sql_close( $db, $stmt = null, $doReturn = null, $data = null ).
 * @param[in]   $db         Das Datenbankobjekt.
 * @param[in]   $stmt       Platzhalter.
 * @param[in]   $doReturn   Platzhalter.
 * @param[in]   $data       Platzhalter.
 * @brief       Beendet die Mysqli-Verbindung mit dem uebergebenen Datenbankobjekt.
 * @todo        Die leeren Parameter loswerden oder alle DB-Funktionen neu schreiben.             
 * @return      Keine Rueckgabe.
 */
function sql_close( $db, $stmt = null, $doReturn = null, $data = null ) {
    if( isset( $db ) )
        mysqli_close( $db );
}

?>