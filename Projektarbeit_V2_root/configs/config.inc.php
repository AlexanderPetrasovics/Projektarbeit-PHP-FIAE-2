<?php
/**
 * @file    config.inc.php
 * @author  Alexander Petrasovics
 * @brief   Hier wird die Session gestartet und ist der ganze Konfigurationskram definiert.
 * @todo    Die PHP-Konstante "E_ALL" ist veraltet.
 */

session_start();

/**Alle Fehler anzeigen wenn DEBUG auf 'true' gesetzt ist. */
define( 'DEBUG', false ); 

if( DEBUG ) {
    error_reporting( E_ALL );
    ini_set('display_errors', 1 );
    ini_set('display_startup_errors', 1);
    mysqli_report( MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT );    
}

/*  Pfade  */

/** Der relative Pfad zum Template-Verzeichnis. */
define( 'TEMPLATES', './public/templates/' );

/** Der relative Pfad zum Funktions-Verzeichnis. */
define( 'FUNCTIONS', './functions/' );

/** Der relative Pfad zum Config-Verzeichnis. */
define( 'CONFIGS', './configs/' );

/* Datenbankkram */

/** Die Host-Adresse. alternative: 127.0.0.1 .*/
define( 'HOST', 'localhost' );

/** Der Datenbankname */
define( 'DB', 'Projektarbeit' );

/** Der Login-Name fuer die Datenbank. */
define( 'USER', 'root' );     

/** Das Passwort fuer die Datenbank */
define( 'PWD', '' );            

/** Der Standardport des MySQL/-MariaDB-Servers. Bei Abweichung einfach hier aendern. */
define( 'PORT', 3306 );           // MariabDB-/MySQL - Standardport - Hier aendern falls abwegig!

/** Platzhalter-Symbol fuer die Datenbankfunktion. */
define ( 'PLACEHOLDER', '?' );

?>