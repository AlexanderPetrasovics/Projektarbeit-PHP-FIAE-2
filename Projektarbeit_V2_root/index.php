<?php


/**
 * @file index.php
 * 
 * @author  Alexander Petrasovics
 * 
 * @brief   Start der Verarbeitung mit jedem Seitenaufruf.\n
 *          Inkludiert die HTML-Templates basierend auf den Server-Anfragen.\n
 * 
 * @var     Funktion $db
 *          Diese Funktion beinhaltet das Datenbankobjekt\n
 *          und nimmt 'Query'-Funktionen, Rueckgabe-Erwartung und einen optionalen Array als Parameter auf. 
 */


require_once './configs/config.inc.php';
require_once FUNCTIONS . 'helpers.func.php';
require_once FUNCTIONS . 'SQL.func.php';

$db = database();    // $db ist eine Funktion und haelt das Datenbankobjekt inne!


if( !$db && !DEBUG ) {    // Konnte keine Datenbankfunktion erstellt werden, gib das error template aus.
    require_once TEMPLATES . 'error/error.tpl.php'; 
} else {                  // Hat wohl alles geklappt - RequestHandler, Kopfteil, Hauptseite und footer laden     
    require_once './requestHandler.inc.php';
    require_once TEMPLATES . 'header/header.tpl.php';       // HTML Kopfteil einbinden        
    
    $query_entries  =  "select entry.id, text, entry.time_created as timestamp, name as subjectName, users.username as username " . 
                        "from entry inner join subject on subject.id = subjectID left join users on entry.userID = users.id order by timestamp desc";
    $query_subjects =   "select id, name from subject";
   
    /* Faecher und alle Eintraege werden zu Beginn in die Session geladen und in dem template der "news"-Seite genutzt genutzt */
    $_SESSION["database"]["subjects"]       = $db( 'sql_query', $query_subjects, true, null );
    $_SESSION["database"]["entries_all"]    = $db( 'sql_query', $query_entries, true, null );
    
    require_once TEMPLATES . 'landing/landing.tpl.php';  // HTML Hauptseite einbinden    
    require_once TEMPLATES . '/footer/footer.tpl.php';   // HTML Fussbereich einbinden
    
    $db( 'sql_close', null, null, null );               // Explizit die Datenbankverbindung schliessen
}


?>
