<!DOCTYPE html>
<html>
	<head>
		<title>PHP Projektarbeit</title>
		<meta charset = "utf-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0, maximum-scale=1">
		<link rel="stylesheet" href="./public/styles/projektarbeit.css">
	</head>	
	<body>
	<?php 
	/* Wenn DEBUG definiert wurde, wird ein HTML-BLOCK inkludiert, welcher eine Warnung beinhaltet! */
	if( DEBUG ) {
	    require_once './public/templates/warning.tpl.php';
	}
	?>
		<header>
			
			<!--<h1>Projektarbeit FIAE Gruppe 2</h1> -->
			<form method = "post" action = "index.php">
			<div class = "header-cap"><h1>Projektarbeit PHP</h1></div>
			<?php if ( !isset( $_SESSION["user"]['logged_in'] ) || $_SESSION["user"]['logged_in'] != true ) { ?>
			<!-- LOGIN BOX -->			
			<div class = "box-header-login">
				<span><div><input type="submit" name = "action_login" value = "Anmelden"/></div></span>
				<span><div><input type="password" name = "data_login_value_pwd" value = "" placeholder = "Passwort"/></div></span>
				<span><div><input type="text" value = "" name = "data_login_value_username" placeholder = "Benutzername"/></div></span>
			</div>
			</form>	
			<!-- LOGIN BOX  ENDE-->
			<?php } else { ?>			
			<!-- USER BOX -->
			<form method = "post" action = "index.php">
			<div class = "box-header-user">
				<span><div><input type="submit" name = "action_logout" value = "<?= $_SESSION["user"]['name']; ?> abmelden"/></div></span>
			</form>	
			</div>
			<?php } ?>
			<!-- USER BOX ENDE-->
			<form id = "form-navigation-top" method = "get" action = "index.php">
				<nav class = "box-header-nav">
					<span>
						<span><input type = "submit" name = "action_loadPage_page_news" value = "Startseite"/></span>
						<span><input type = "submit" name = "action_loadPage_page_entries" value = "Eintr&auml;ge anzeigen"/></span>
						
						
						<?php if ( !isset( $_SESSION["user"]['logged_in'] ) || $_SESSION["user"]['logged_in'] != true ) { ?>
						<span><div><input type="submit" name = "action_loadPage_page_account" value = "Konto erstellen"/></div></span>

						<?php } else { ?>			
						<span><input type = "submit" name = "action_loadPage_page_create" value = "Eintrag erstellen"/></span>
						<span><input type = "submit" name = "action_loadPage_page_management" value = "Fach Management"/></span>

						<?php } ?>
					</span>
				</nav>			 
			</form>
		</header>
		<main>		
