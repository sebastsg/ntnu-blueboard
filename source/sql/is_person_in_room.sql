CREATE PROCEDURE is_person_in_room (
    IN in_username VARCHAR(32),
    IN in_room_id  INT
)

BEGIN

    SELECT person.id
      FROM person
      JOIN participant
        ON participant.person_id = person.id
       AND participant.room_id = in_room_id
      JOIN room
        ON room.id = participant.room_id
     WHERE person.username = in_username;

END
