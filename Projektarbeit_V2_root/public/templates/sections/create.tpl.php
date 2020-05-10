<!-- Eintrag erstellen -->
<article id = "subject-management" class = "box-center-article">
    <form method = "post" action = "index.php">
    <section class = "box-center-section-entry-create">
        <div class ="box-content-entry">			
            <div class = "entry-header">
                <span>
                    <div class = "entry-header-caption">Fach</div>				
                    <select name = "data_createEntry_value_id">
                        <?php if ( !empty( $_SESSION["database"]["subjects"] ) ) { foreach( $_SESSION["database"]["subjects"] as $subject ) : ?>  
                        <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                        <?php endforeach; } ?>
                    </select>
                    <div class = "entry-header-caption">Datum</div>
                    <input type="date" value = "<?= date("Y-m-d", time() ) ?>" name = "data_createEntry_value_timestamp"/>
                </span>
                <span>
                    <input type="submit" name = "action_createEntry" value = "Eintrag erstellen">
                </span>
                
            </div>
            <textarea name = "data_createEntry_value_text" class = "editable" placeholder = "Text einfuegen"></textarea>
        </div>
    </section>
    </form>
</article>