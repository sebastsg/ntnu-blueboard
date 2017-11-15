CREATE PROCEDURE get_assignments_for_room (
    IN in_room_id INT UNSIGNED
)

BEGIN

    SELECT assignment.title      AS title,
           assignment.body       AS body,
           assignment.started_at AS started_at,
           assignment.ended_at   AS ended_at,
           person.username       AS username,
           person.first_name     AS first_name,
           person.last_name      AS last_name
      FROM room
      JOIN assignment
        ON assignment.room_id = room.id
       AND assignment.ended_at >= CURDATE()
      JOIN participant
        ON participant.id = assignment.participant_id
      JOIN person
        ON person.id = participant.person_id
     WHERE room.id = in_room_id
     ORDER BY assignment.ended_at DESC;

END
