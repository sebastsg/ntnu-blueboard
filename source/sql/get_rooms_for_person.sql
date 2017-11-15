CREATE PROCEDURE get_rooms_for_person (
    IN in_username VARCHAR(32)
)

BEGIN

       SELECT room.id               AS room_id,
              room.name             AS room_name,
              participant.id        AS participant_id,
              participant.role_name AS role_name,
              semester.name         AS semester_name
         FROM person
         JOIN participant
           ON participant.person_id = person.id
         JOIN room
           ON room.id = participant.room_id
    LEFT JOIN course_room
           ON course_room.room_id = room.id
    LEFT JOIN course_in_semester
           ON course_in_semester.id = course_room.course_in_semester_id
    LEFT JOIN semester
           ON semester.code = course_in_semester.semester_code
        WHERE person.username = in_username
        ORDER BY semester.started_at DESC,
                 room.name           ASC;

END
