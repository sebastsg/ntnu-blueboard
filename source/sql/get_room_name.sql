CREATE PROCEDURE get_room_name (
    IN in_room_id INT
)

BEGIN

    SELECT room_name
      FROM room
     WHERE id = in_room_id;

END 
