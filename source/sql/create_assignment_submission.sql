CREATE PROCEDURE create_assignment_submission (
    IN in_assignment_id INT UNSIGNED,
    IN in_username      VARCHAR(32),
    IN in_message       TEXT
)

BEGIN

    START TRANSACTION;

    INSERT INTO assignment_submission (id, participant_id, assignment_id, message)
         VALUES (0,
                 (SELECT participant.id
                    FROM assignment
                    JOIN room
                      ON room.id = assignment.room_id
                    JOIN participant
                      ON participant.room_id = room.id
                    JOIN person
                      ON person.id = participant.person_id
                     AND person.username = in_username
                   WHERE assignment.id = in_assignment_id
                 ),
                 in_assignment_id,
                 in_message
                );

    SELECT LAST_INSERT_ID() AS id;

    COMMIT;

END