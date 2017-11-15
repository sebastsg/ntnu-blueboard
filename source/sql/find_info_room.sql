CREATE PROCEDURE find_info_room (
    IN in_info_room_code VARCHAR(32)
)

BEGIN

    SELECT room_id
      FROM info_room
     WHERE code = in_info_room_code;

END 
