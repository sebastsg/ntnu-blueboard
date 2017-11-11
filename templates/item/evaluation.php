<?php

$evaluation = $args;

$started_at = format_datetime($evaluation['started_at']);
$evaluated_at = format_datetime($evaluation['evaluated_at']);
$assigner_name = $evaluation['assigner_first_name'] . ' ' . $evaluation['assigner_last_name'];
$assigner_link = '/person/' . $evaluation['assigner_username'];
$evaluator_name = $evaluation['evaluator_first_name'] . ' ' . $evaluation['evaluator_last_name'];
$evaluator_link = '/person/' . $evaluation['evaluator_username'];

?>
<div class="assignment">
    <header>
        <?php
        echo '<a href="/room/' . $evaluation['room_id'] . '">' . $evaluation['room_name'] . '</a><br>';
        ?>
        <i>Assignment given by
            <a href="<?php echo $assigner_link; ?>">
                <?php echo $assigner_name; ?>
            </a>
            at <?php echo $started_at; ?>
        </i>
    </header>
    <h3><?php echo $evaluation['title']; ?></h3>
    <br>
    <hr>
    <br>
    <p>
        <?php echo $evaluation['message']; ?>
        <br>
        <b>Score: <?php echo $evaluation['score']; ?></b>
    </p>
    <footer>
        <i>Evaluated by
            <a href="<?php echo $evaluator_link; ?>">
                <?php echo $evaluator_name; ?>
            </a>
            at <?php echo $evaluated_at; ?>
        </i>
    </footer>
</div>
