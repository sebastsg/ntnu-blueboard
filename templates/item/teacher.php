<?php

$teachers = $args['teachers'];

print_right_plurality('h2', 'Teacher', count($teachers));

foreach ($teachers as $teacher) {
    $name = $teacher['first_name'] . ' ' . $teacher['last_name'];
    $email = $teacher['email'];
    $username = $teacher['username'];
    echo "
    <div>
        <h3><a href=\"/person/$username\">$name</a></h3>
        <p>
            <a href=\"mailto:$email\">$email</a>
        </p>
    </div>";
}
