CREATE PROCEDURE create_post (
    IN in_room_id  INT,
    IN in_username VARCHAR(32),
    IN in_title    VARCHAR(160),
    IN in_body     TEXT
)

BEGIN

    INSERT INTO post
                (id,
                 room_id,
                 participant_id,
                 title,
                 body
                )
         VALUES (0,
                 in_room_id,
                 (SELECT participant.id
                    FROM person
                    JOIN participant
                      ON participant.person_id = person.id
                     AND participant.room_id = in_room_id
                   WHERE person.username = in_username
                 ),
                 in_title,
                 in_body
                );

END