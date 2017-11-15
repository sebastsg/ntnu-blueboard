CREATE PROCEDURE create_assignment_evaluation (
    IN in_assignment_submission_id INT UNSIGNED,
    IN in_username                 VARCHAR(32),
    IN in_score                    INT UNSIGNED,
    IN in_message                  TEXT
)

BEGIN

    INSERT INTO assignment_evaluation
                (id,
                 assignment_submission_id,
                 participant_id,
                 score,
                 message
                )
         VALUES (0,
                 in_assignment_submission_id,
                 (SELECT participant.id
                    FROM assignment_submission
                    JOIN assignment
                      ON assignment.id = assignment_submission.assignment_id
                    JOIN room
                      ON room.id = assignment.room_id
                    JOIN participant
                      ON participant.room_id = room.id
                    JOIN person
                      ON person.id = participant.person_id
                     AND person.username = in_username
                   WHERE assignment_submission.id = in_assignment_submission_id
                 ),
                 in_score,
                 in_message
                );

END