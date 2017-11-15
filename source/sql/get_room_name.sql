CREATE PROCEDURE get_room_name (
    IN in_room_id INT UNSIGNED
)

BEGIN

    SELECT name AS room_name
      FROM room
     WHERE id = in_room_id;

END 
