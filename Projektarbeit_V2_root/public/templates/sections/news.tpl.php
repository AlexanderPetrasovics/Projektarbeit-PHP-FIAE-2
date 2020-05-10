<article id = "news" class = "box-center-article">
<section class = "box-center-section-entries-top_three">
		<?php if ( !empty( $_SESSION["database"]["entries_all"] ) ) { for( $i = 0; $i < 3; $i++ ) : ?>
		<div class ="box-content-entry">			
			<div class = "entry-header">
			<span>
				<div class = "entry-header-caption">Fach</div>				
				<input type="text" value = "<?= $_SESSION["database"]["entries_all"][$i]['subjectName'] ?>" readonly>
			</span>
			<span>
				<div class = "entry-header-caption">Datum</div>
				<input type="date" value = "<?= date( "Y-m-d", $_SESSION["database"]["entries_all"][$i]['timestamp'] ) ?>" readonly>
			</span>
			<span>
				<div class = "entry-header-caption">erstellt von</div>
				<input type="text" value = "<?= $_SESSION["database"]["entries_all"][$i]['username'] ?>" readonly>
			</span>
			</div>
			<textarea spellcheck="false" readonly><?= $_SESSION["database"]["entries_all"][$i]['text'] ?></textarea>
			
		</div>
		<?php endfor; } ?>
	</section>

		<section class = "box-center-section-entries-dropdown">
			<a href = "#expand-section-table">weitere Eintr&auml;ge aufklappen</a>
		</section>
		<section id = "expand-section-table" class = "box-center-section-entries-expand">			
			<?php if ( !empty( $_SESSION["database"]["entries_all"] ) ) { for( $i = 3; $i < sizeof( $_SESSION["database"]["entries_all"] ); $i++ ) : ?>
			<div class ="box-content-entry">			
				<div class = "entry-header">
				<span>
					<div class = "entry-header-caption">Fach</div>				
					<input type="text" value = "<?= $_SESSION["database"]["entries_all"][$i]['subjectName'] ?>" readonly>
				</span>
				<span>
					<div class = "entry-header-caption">Datum</div>
					<input type="date" value = "<?= date( "Y-m-d", $_SESSION["database"]["entries_all"][$i]['timestamp'] ) ?>" readonly>
				</span>
				<span>
					<div class = "entry-header-caption">erstellt von</div>
					<input type="text" value = "<?= $_SESSION["database"]["entries_all"][$i]['username'] ?>" readonly>
				</span>
			</div>
			<textarea spellcheck="false" readonly><?= $_SESSION["database"]["entries_all"][$i]['text'] ?></textarea>			
		</div>	
		<?php endfor; } ?>			
	</section>				
</article>