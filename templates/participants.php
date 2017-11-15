<?php

$room_id = $args['room_id'];

if (!is_person_in_room(session_username(), $room_id)) {
    return;
}

$room_name = get_room_name($room_id);
$students = get_participants_for_room($room_id, 'student');
$teachers = get_participants_for_room($room_id, 'teacher');

?>
<h1><?php echo $room_name; ?></h1>
<section class="room participants">

    <aside>
        <div>
            <?php
            echo '<div>';
            echo template_execute('item/teacher', [
                'teachers' => $teachers
            ]);
            echo '</div>';
            ?>
            <div>
                <h2>Links</h2>
                <a href="/room/<?php echo $room_id; ?>">Go back to room</a>
            </div>
        </div>
    </aside>

    <article>
        <h2>Students</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php
            foreach ($students as $student) {
                $name = $student['first_name'] . ' ' . $student['last_name'];
                $email = $student['email'];
                $username = $student['username'];
                echo "
                <tr>
                    <td>
                        <a href=\"/person/$username\">$name</a>
                    </td>
                    <td>
                        <a href=\"mailto:$email\">$email</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </article>

</section>
