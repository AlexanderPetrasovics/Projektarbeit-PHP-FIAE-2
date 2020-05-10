\mainpage

## Inhalt
* [Über diese Dokumentation](#Dokumentation)
* [Projektbeschreibung](#Beschreibung)
* [Implementation](#Implementation)
* [Fehlerprüfung, Anfälligkeit und Optimierung](#Opt)


## <a name="Dokumentation">Über diese Dokumentation</a>
Diese Dokumentation habe ich mir der Software "Doxygen" generiert, welches ein bevorzugtes Werkzeug in der Software-Entwicklung ist.\n
Sie können hier alle erfassten Quellcode-Dateien, individuelle Variablen sowie Funktionen, inklusiver Beschreibung einsehen.\n
Wenn Sie sich den Quellcode ausserhalb dieses Dokuments anschauen, werden sie einen der Kommentar-Stile sehen,
welcher für diese Dokument-Generierung benötigt wurde.\n

## <a name="Beschreibung">Projektbeschreibung</a>
Dieses Projekt bildet einen Umschulungsfach-Manager, indem dort angemeldete Benutzer individuelle Fächer und dazu passende Einträge erstellen können.\n
Nach mindestens 4 Projektanläufen habe Ich entschieden, das ich solch ein Projekt umsetzen möchte,
welches die gewünschten Vorgaben etwas unkonventionell erfüllt.\n
Wenn der Benutzer das erste mal die Seite aufruft, sieht er auf der rechten Seite die bislang angelegten Fächer und
daneben die letzten drei Einträge, welche getätigt wurden.\n
Optional kann Er alle anderen Einträge, durch das Feld darunter, einblenden lassen.\n
Desweiteren hat der Benutzer hat die Möglichkeit ein Konto anzulegen und selbst Fächer, sowie Einträge zu erstellen.\n\n

Ich weiß diese Projektarbeit übertrieben groß ist, doch ich wollte nach 1 1/2 Jahren wieder meine PHP-Kenntnisse mit einem\n 
\"Pseudo-Richtigen\" Projekt auffrischen und wieweit ich ein flexibles, dynamisches Gerüst auf die Schnelle erstellen kann, ohne auf andere Technologien\n ausser einfachem PHP, HTML und CSS setzen zu können.\n\n
*Alexander Petrasovics*

## <a name="Implementation">Implementation</a>
Die Webseite wird nicht über einfache Links, sondern direkt über Serveranfragen gesteuert.
Der gesamte Inhalt der Webseite ist modular aufgebaut.
* Kopfteil einbinden
* Datei basierend auf der Anfrage einbinden
* Fussteil einbinden
\n\n
Grundsätzlich wird bei jeder Anfrage die "index.php" und die Datei "requestHandler.inc.php" eingebunden und eine Datenbankfunktion erstellt.\n
Der _Request Handler_ entscheidet über die auszuführende Aktion, basierend auf den übermittelten Daten der HTML-Formen und ruft die nötigen\n
Funktionen in der Datei "request.func.php" auf, welche jede nötige Funktion beinhaltet.\n\n

## <a name="Opt">Fehlerprüfung, Anfälligkeit und Optimierung</a>
In der Datei "config.inc.php" befindet sich eine Konstante names 'DEBUG', welche Zur Fehlerausgabe genutzt wurde\
und fuer die Release-Version deaktiviert wurde.\n
Fehler habe ich minimiert und auch die Eingabefelder sind in HTML bei fehlenden Angaben deaktiviert.\n
Allerdings habe ich nach zig Projektanläufen und dem Lernen anderer Umschulungsfächer keinen *Bock* mehr gehabt!\n
Sorry Fr. Becker :\( \n 