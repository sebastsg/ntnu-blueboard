CREATE PROCEDURE get_participants_for_room (
	IN in_room_id   INT,
	IN in_role_name VARCHAR(64)
)

BEGIN

	SELECT person.id          AS person_id,
	       person.first_name  AS first_name,
	       person.last_name   AS last_name,
	       person.email       AS email,
	       person.username	  AS username,
	       participant.id 	  AS participant_id
	  FROM participant
	  JOIN room
	    ON room.id = participant.room_id
	  JOIN person
	    ON person.id = participant.person_id
	  JOIN role
	    ON participant.role_id = role.id
	   AND role.role_name = in_role_name
	 WHERE participant.room_id = in_room_id;

END 
