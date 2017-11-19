CREATE PROCEDURE create_assignment_submission_file (
    IN in_assignment_submission_id INT UNSIGNED,
    IN in_username                 VARCHAR(32),
    IN in_file_name                VARCHAR(160),
    IN in_file_path                VARCHAR(160)
)

BEGIN

    START TRANSACTION;

    INSERT INTO uploaded_file (id, participant_id, room_id, file_name, file_path)
         VALUES (0,
                 (SELECT participant.id
                    FROM assignment_submission
                    JOIN participant
                      ON participant.id = assignment_submission.participant_id
                    JOIN person
                      ON person.id = participant.person_id
                     AND person.username = in_username
                   WHERE assignment_submission.id = in_assignment_submission_id
                 ),
                 (SELECT room.id
                    FROM assignment_submission
                    JOIN assignment
                      ON assignment.id = assignment_submission.assignment_id
                    JOIN room
                      ON room.id = assignment.room_id
                   WHERE assignment_submission.id = in_assignment_submission_id
                 ),
                 in_file_name,
                 in_file_path
                );

    INSERT INTO assignment_submission_file (id, assignment_submission_id, uploaded_file_id)
         VALUES (0,
                 in_assignment_submission_id,
                 LAST_INSERT_ID()
                );

    COMMIT;

END