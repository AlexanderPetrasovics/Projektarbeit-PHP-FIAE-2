</article>
<!-- EINTRAEGE -->
<article id = "entries" class = "box-center-article">
	<section class = "box-center-section-entries-all">		
            <?php if ( !empty( $_SESSION["database"]["entries_current_subject"] ) ) { foreach( $_SESSION["database"]["entries_current_subject"] as $entry ) : ?>
			<div class ="box-content-entry">			
				<div class = "entry-header">
				<span>
					<div class = "entry-header-caption">Fach</div>				
					<input type="text" value = "<?= $entry['subjectName'] ?>" readonly>
				</span>
				<span>
					<div class = "entry-header-caption">Datum</div>
					<input type="date" value = "<?= date( "Y-m-d", $entry['timestamp'] ) ?>" readonly>
				</span>
				<span>
					<div class = "entry-header-caption">erstellt von</div>
					<input type="text" value = "<?= $entry['username'] ?>" readonly>
				</span>
				</div>
				<textarea spellcheck="false" readonly><?= $entry['text'] ?></textarea>
			
			</div>
            <?php endforeach; } ?>
		
	</section>								
</article>

