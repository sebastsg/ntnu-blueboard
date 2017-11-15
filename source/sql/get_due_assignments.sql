CREATE PROCEDURE get_due_assignments (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT assignment.title           AS title,
           assignment.body            AS body,
           assignment.started_at      AS started_at,
           assignment.ended_at        AS ended_at,
           room.id                    AS room_id,
           room.name                  AS room_name,
           given_by_person.username   AS username,
           given_by_person.first_name AS first_name,
           given_by_person.last_name  AS last_name
      FROM person AS requester_person
      JOIN participant AS requester
        ON requester.person_id = requester_person.id
      JOIN room
        ON room.id = requester.room_id
      JOIN assignment
        ON assignment.room_id = room.id
       AND assignment.ended_at >= CURDATE()
      JOIN participant AS given_by
        ON given_by.id = assignment.participant_id
      JOIN person AS given_by_person
        ON given_by_person.id = given_by.person_id
     WHERE requester_person.username = in_username
     ORDER BY assignment.ended_at DESC;

END
