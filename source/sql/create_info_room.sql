CREATE PROCEDURE create_info_room (
    IN in_info_room_code VARCHAR(32),
    IN in_info_room_name VARCHAR(128)
)

BEGIN

    START TRANSACTION;

    INSERT INTO room (id, name)
         VALUES (0, in_info_room_name);

    INSERT INTO info_room (room_id, code)
         VALUES (LAST_INSERT_ID(), in_info_room_code);

    COMMIT;

END