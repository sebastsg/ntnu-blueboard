CREATE PROCEDURE get_recent_posts (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT post.title        AS title,
           post.body         AS body,
           post.created_at   AS created_at,
           post.updated_at   AS updated_at,
           poster.username   AS username,
           poster.first_name AS first_name,
           poster.last_name  AS last_name,
           room.id           AS room_id,
           room.name         AS room_name
      FROM person AS requester
      JOIN participant AS requester_participant
        ON requester_participant.person_id = requester.id
      JOIN room
        ON room.id = requester_participant.room_id
      JOIN post
        ON post.room_id = requester_participant.room_id
      JOIN participant AS poster_participant
        ON poster_participant.id = post.participant_id
      JOIN person AS poster
        ON poster.id = poster_participant.person_id
     WHERE requester.username = in_username
     ORDER BY post.created_at DESC
     LIMIT 2;

END
