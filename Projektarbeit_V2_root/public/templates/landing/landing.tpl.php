
			<div class = "box-left">
				<form id = "form-subject-create" action = "index.php" method = "post">
					<?php if ( !isset( $_SESSION["user"]['logged_in'] ) || $_SESSION["user"]['logged_in'] != true ) { ?>
    				<input class = "input_subject" type = "text" name = "data_createSubject_value_name" placeholder = "Themenname eingeben" value = "" readonly>
    				<input class = "btn_create" type = "submit" name = "action_createSubject" value = "Thema Erstellen" disabled/> 
					<?php } else { ?>
					<input class = "input_subject" type = "text" name = "data_createSubject_value_name" placeholder = "Themenname eingeben" value = "" >
    				<input class = "btn_create" type = "submit" name = "action_createSubject" value = "Thema Erstellen"/> 
						<?php } ?>
				</form>
				<form id = "form-subject-select" action = "index.php" method = "post">
    				<ul>
						<?php foreach( $_SESSION["database"]["subjects"] as $subject ) : ?>
						<li class = "box-left-list-select">
							<input class = "box-left-btn-select" type = "submit" name = "action_loadSubject_id_<?= $subject['id']; ?>" value = "<?= $subject['name']; ?>"/>
    					</li>    				
    					<?php endforeach; ?>								
    				</ul>
				</form>				
			</div>			
			<div class = "box-center">
				<?php if( isset( $_SESSION["page"] ) ) {
					require_once $_SESSION["page"];
				} else {
					require_once TEMPLATES . "sections/news.tpl.php";
				} ?>
			</div>	

			
			
			