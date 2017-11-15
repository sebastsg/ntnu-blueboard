CREATE PROCEDURE get_recent_posts_for_room (
    IN in_room_id INT UNSIGNED
)

BEGIN

    SELECT post.title        AS title,
           post.body         AS body,
           post.created_at   AS created_at,
           post.updated_at   AS updated_at,
           person.username   AS username,
           person.first_name AS first_name,
           person.last_name  AS last_name
      FROM room
      JOIN post
        ON post.room_id = room.id
      JOIN participant
        ON participant.id = post.participant_id
      JOIN person
        ON person.id = participant.person_id
     WHERE room.id = in_room_id
     ORDER BY post.created_at DESC
     LIMIT 3;

END
