<?php

$evaluations = get_evaluations(session_username());

?>
<h1>Evaluations</h1>
<section>
    <?php

    foreach ($evaluations as $evaluation) {
        echo template_execute('item/evaluation', $evaluation);
    }

    ?>
</section>
