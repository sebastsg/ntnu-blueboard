CREATE PROCEDURE get_rooms_for_person (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT room.id        AS room_id,
           room.room_name AS room_name,
           participant.id AS participant_id,
           role.role_name AS role_name
      FROM person
      JOIN participant
        ON participant.person_id = person.id
      JOIN role
        ON role.id = participant.role_id
      JOIN room
        ON room.id = participant.room_id
     WHERE person.username = in_username
     ORDER BY room.created_at DESC;

END
