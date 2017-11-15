<?php

$groups = get_groups_for_person(session_username());

?>
<h1>Groups</h1>
<section>
    <?php

    foreach ($groups as $group) {
        echo '<div>';
        echo '<h2>' . $group['group_name'] . '</h2>';

        $members = get_group_members($group['group_id']);

        echo '
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
            </tr>';

        foreach ($members as $member) {
            $full_name = $member['first_name'] . ' ' . $member['last_name'];
            $username = $member['username'];
            $email = $member['email'];
            $joined = format_datetime($member['joined_at']);
            echo '<tr>';
            echo "<td><a href=\"/person/$username\">$full_name</a></td>";
            echo "<td><a href=\"mailto:$email\">$email</a></td>";
            echo "<td>$joined</td>";
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';

    }

    ?>
</section>
