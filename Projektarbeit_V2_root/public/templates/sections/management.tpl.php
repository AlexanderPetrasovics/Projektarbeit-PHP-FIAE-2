<!-- FAECHER MANAGEMENT -->
<article id = "subject-management" class = "box-center-article">
<form method = "post" action = "index.php">
    <section class = "box-center-section-subjects-edit">
        <div class ="box-center-table-subjects">
            <?php if ( !empty( $_SESSION["database"]["subjects"] ) ) { foreach( $_SESSION["database"]["subjects"] as $subject ) : ?>            
            <span><input type="text" value = "<?= $subject['name'] ?>"></span>	
            <span><input type="submit" name = "action_deleteSubject_id_<?= $subject['id'] ?>" value = "l&ouml;schen"></span>       
						
        <?php endforeach; } ?>
        </div>
</form>
    </section>
</article>
		