CREATE PROCEDURE get_info_room (
    IN in_room_id INT UNSIGNED
)

BEGIN

    SELECT info_room.room_id AS room_id,
           room.name         AS room_name
      FROM info_room
     WHERE info_room.room_id = in_room_id;

END 
