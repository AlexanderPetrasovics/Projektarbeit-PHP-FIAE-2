<?php
/**
 * @file    requests.func.php
 * @author  Alexander Petrasovics
 * @brief   Alle Funktionen, welche durch die Serveranfragen gestarted werden, befinden sich hier.
 */

/**
 * @fn          loadPage( $data )
 * @param[in]   $data   Ein Array mit Schluessel 'page' und als Wert die gewuenschte Seite.
 * @param[out]  $_SESSION["page"]   Schreibt den Pfad der Seite in die globale $_SESSION-Variable.
 * @brief       Generiert einen Template-Pfad, welcher von der Hauptseite aus inkludiert werden soll\n
 *              und speichert diesen in der globalen $_SESSION-Variable.
 * @return      Keine Rueckgabe.
 */
function loadPage( $data ) {
    if( file_exists( TEMPLATES . "sections/${data['page']}.tpl.php" ) ) {
        $_SESSION["page"] = TEMPLATES . "sections/${data['page']}.tpl.php";
    } else {
        unset( $_SESSION["page"] );
    }    
}

/**
 * @fn          login( $data )
 * @param[in]   $data   Einen Daten-Array mit den Nutzerdatei aus der Login-Form.
 * @param[out]  $_SESSION["user"]['id']     Speichert die Nutzer-ID in der globalen $_SESSION-Variable.
 * @param[out]  $_SESSION["user"]['name']   Speichert den Nutzernamen in der globalen $_SESSION-Variable.
 * @param[out]  $_SESSION["user"]['logged_in'] Speichert den Bool-Wert ob der Nutzer eingeloggt ist in der globalen $_SESSION-Variable.
 * @brief       Laesst den Benutzer anmelden, sofern die Angaben aus der uebermittelten Form mit einem passenden Datenbankeintrag uebereinstimmen.
 * @return      Keine Rueckgabe.
 */
function login( $data ) {
    /* KEIN MD5 oder SHA-Hash sondern Rohwerte */
    global $db;
    $query   = "select id, username, password from users where username = ? and password = ?";                
    $res = $db( 'sql_query', $query, true, array( $data['username'], $data['pwd'] ) );
    
    if( !is_null( $res ) ) {        
        $_SESSION["user"]['id']         = $res[0]['id'];
        $_SESSION["user"]['name']       = $res[0]['username'];
        $_SESSION["user"]['logged_in']  = true;  
    } else {
        $_SESSION["user"]['logged_in']  = false;  
    }    
}

/**
 * @fn          createAccount( $data )
 * @param[in]   $data   Einen Daten-Array mit den Nutzerdatei aus der Anmelde-Form.
 * @brief       Erstellt einen Benutzer in der Datenbank.
 * @todo        Keine Fehlerpruefung oder Check auf doppelte Eintraege implementiert.
 * @return      Keine Rueckgabe.
 */
function createAccount( $data ) {
    global $db;
    $query   = "insert into users( username, password, time_created ) values( ? , ? , ? )";
    /* KEIN MD5 oder SHA-Hash sondern Rohwerte */                
    $res = $db( 'sql_query', $query, false, array( $data['username'], $data['password'], time() ) );
}

/**
 * @fn          logout( $data )
 * @param[in]   $data   Ein ungenutzer Datenarray als Platzhalter fuer moegliche Erweiterungen.
 * @brief       Leert die globalen Session-Variablen und beendet die Session.
 * @return      Keine Rueckgabe.
 */
function logout( $data ) {
    unset( $_SESSION["user"]['id'] ); 
    unset( $_SESSION["user"]['name'] );
    unset( $_SESSION["user"]['logged_in'] );
    session_unset();
    session_destroy();
}

/**
 * @fn          createSubject( $data )
 * @param[in]   $data   Daten-Array mit Werten aus der uebermittelten HTML-Form.
 * @brief       Fuegt ein neues Fach in die Datenbank ein.
 * @todo        Keine Fehlerpruefung oder Checks implementiert.
 * @return      Keine Rueckgabe.
 */
function createSubject( $data ) {
    global $db;
    $query   = "insert into subject( name ) values( ? )";                
    $db( 'sql_query', $query, false, array( $data['name'] ) );
}

/**
 * @fn          loadSubject( $data )
 * @param[in]   $data   Daten-Array mit Werten aus der uebermittelten HTML-Form.
 * @param[out]  $_SESSION["database"]["entries_current_subject"] Das aktuell gewaehlte Fach wird hier gespeichert.
 * @param[out]  $_SESSION["page"] Setzt Die zu ladende Seite auf die "Eintragsseite".
 * @brief       Die Seitennavigation wird basierend auf dem gewaehlten Fach auf die Eintragsliste gesetzt.
 * @todo        Keine Fehlerpruefung oder Checks implementiert.
 * @return      Keine Rueckgabe.
 */
function loadSubject( $data ) {
    global $db;
    $query = "select entry.id, text, entry.time_created as timestamp, name as subjectName, users.username as username " . 
             "from entry inner join subject on subject.id = subjectID " .
             "left join users on entry.userID = users.id where subject.id = ? order by timestamp desc";

    $_SESSION["database"]["entries_current_subject"] = $db( 'sql_query', $query, true, array( $data['id']) );
    $_SESSION["page"] = TEMPLATES . "sections/entries.tpl.php";
}

/**
 * @fn          deleteSubject( $data )
 * @param[in]   $data   Daten-Array mit Werten aus der uebermittelten HTML-Form.
 * @brief       Loescht ein Fach aus der Datenbank und alle damit verbundenen Eintraege.
 * @todo        Keine Fehlerpruefung oder Checks implementiert.
 * @return      Keine Rueckgabe.
 */
function deleteSubject( $data ) {
    global $db;
    $query   = "delete from entry where subjectID = ?";                
    $db( 'sql_query', $query, false, array( $data['id'] ) );    
    $query   = "delete from subject where id = ?";                
    $db( 'sql_query', $query, false, array( $data['id'] ) );    
}

/**
 * @fn          createEntry( $data )
 * @param[in]   $data   Daten-Array mit Werten aus der uebermittelten HTML-Form.
 * @brief       Erstellt einen neuen Eintrag in der Datenbank basierend auf den Feldern in der HTML-Form.\n
  * @todo       Keine Fehlerpruefung oder Checks implementiert.
 * @return      Keine Rueckgabe.
 */
function createEntry( $data ) {
    global $db;
    $query  = "insert into entry( text, time_created, subjectID, userID ) values( ? , ? , ? , ? )";
    $db( 'sql_query', $query, false, array( $data['text'], strtotime( $data['timestamp'] ), $data['id'], $_SESSION["user"]['id'] ) );
       
    
}

?>