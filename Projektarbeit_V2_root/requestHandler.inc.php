<?php 
/**
 * @file requestHandler.inc.php
 * 
 * @author  Alexander Petrasovics
 * 
 * @brief   Wertet alle Serveranfragen aus $_REQUEST aus und steuert passende Funktionen an.
 * 
 * @details Jedes HTML-Namensattribut, welches mit 'action_' beginnt und mit einem Namen aufhoert,\n
 *        fuehrt hier eine Funktion mit entsprechendem Namen aus. Dadurch wird es auch ein wenig leichter mit der Namensgebung in HTML.\n
 *        Rein numerische Werte bekommen einen cast auf Integer.\n\n
 *    
 *        action_name\n 
 *        action        = Es soll eine Funktion aufgerufen werden.\n
 *        name          = Der Name der Funktion in PHP.\n\n
 *
 *        action_actionname_var-name_value\n
 *        action        = Es soll eine Funktion aufgerufen werden.\n
 *        actionname    = Der Name der Funktion in PHP.\n
 *        var-name      = Frei waehlbarer Variablenname zur Verwendung im Array.\n
 *        value         = Wert kommt aus dem Attribut "value".\n\n
 *
 *        data_actionname_value_var-name\n
 *        data          = Das soll ein Datentraeger sein.\n
 *        actionname    = Der Name der Funktion in PHP.\n
 *        value         = Wert kommt aus dem Attribut "value".\n
 *        var-name      = Frei waehlbarer Variablenname zur Verwendung im Array.\n\n
 *    
 *        data_actionname_name_var\n
 *        data          = Das soll ein Datentraeger sein.\n
 *        actionname    = Der Name der Funktion in PHP.\n
 *        name          = Frei waehlbarer Schluesselname zur Verwendung im Array.\n
 *        var           = Das ist das Datenfeld.\n\n
 *          
 */

require_once FUNCTIONS . 'requests.func.php';   // Die aufzurufenden Funktionen

if( !empty( $_REQUEST ) ) {    
    $actions        = [];   
    $funcsToCall    = [];
    
    foreach( $_REQUEST as $key => $val ) {

        // Feldpruefung auf Funktionsaufruf action_'Funktionsname'
        if( preg_match("/^action_[a-zA-Z]+$/", $key ) ) {
            $act = str_replace( 'action_', '', $key );
            
            if( function_exists( $act ) ) {
                array_push( $funcsToCall, $act );
                $actions[ $act ][] = $val;
            } else {
                out( "Diese Funktion existiert nicht!" );
            }
        }

        // Feldpruefung auf Funktionsaufruf action_'Funktionsname' UND Datenmitgabe
        if( preg_match("/^action_[a-zA-Z]+_[a-zA-Z]+_[a-zA-Z0-9]+$/", $key ) ) {
            $act = str_replace( 'action_', '', $key );
            $tmp = preg_split("/_/",  $key );
            
            if( function_exists( $tmp[1] ) ) {
                array_push( $actions, $tmp[1] );
                array_push( $funcsToCall, $tmp[1] );

                if( is_numeric( $tmp[3] ) ) {                
                $actions[ $tmp[1] ][$tmp[2]] = intval( $tmp[3] );
                } else {
                $actions[ $tmp[1] ][$tmp[2]] = $tmp[3];
                } 

            } else {
                out( "Diese Funktion existiert nicht!" );
            }
        }

        // Feldpruefung auf 'data' _ 'function' _ 'value' _ 'variablenname'
        if( preg_match("/data_[A-Za-z]+_value_[A-Za-z0-9]+$/", $key ) ) {
            $tmp = preg_split("/_/",  $key );
            if( is_numeric( $val ) ) {
                $actions[ $tmp[1] ][$tmp[3]] = intval($val);
            } else {
                $actions[ $tmp[1] ][$tmp[3]] = $val;
            }            
        }
        
        // Feldpruefung auf 'data' _ 'function' _ 'name' _ 'variablenname'
        if( preg_match("/data_[A-Za-z]+_(?!value)[A-Za-z]+_[A-Za-z0-9]+$/", $key ) ) {
            $tmp = preg_split("/_/",  $key );
            
            if( is_numeric( $tmp[3] ) ) {                
                $actions[ $tmp[1] ][$tmp[2]] = intval( $tmp[3] );
            } else {
                $actions[ $tmp[1] ][$tmp[2]] = $tmp[3];
            }            
        }        
    }

    // Feldpruefung auf Datenfeld mit Wert in Array
    if( preg_match("/^data_[A-Za-z]+_arr\[\w+\]+\[+\w+\]$/", $key ) ) {
        $act = str_replace( 'action_', '', $key );
        $tmp = preg_split("/_/",  $key );
        
        if( function_exists( $tmp[1] ) ) {
            array_push( $actions, $tmp[1] );
            array_push( $funcsToCall, $tmp[1] );
            $actions[ $tmp[1] ][] = $val;
        } else {
            out( "Du Depp! Diese Funktion existiert nicht!" );
        }
    }
    
    // herausfiltern moeglicher leerer Arrayelemente
    $act = array_filter( $actions, function( $val ){
        return !empty( $val );
    }, ARRAY_FILTER_USE_KEY );

    // Jede Funktion aufrufen und die Daten mitgeben
    foreach( $act as $action => $data ) {
        array_map( function( $fn ) use( $data ) {
            call_user_func( $fn, $data );
        }, $funcsToCall );       
    }
}

?>