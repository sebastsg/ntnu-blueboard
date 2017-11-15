CREATE PROCEDURE find_course_room (
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(16)
)

BEGIN

    SELECT course_room.room_id AS room_id
      FROM course_room
      JOIN course_in_semester
        ON course_in_semester.id = course_room.course_in_semester_id
      JOIN semester
        ON semester.code = course_in_semester.semester_code
       AND semester.code = in_semester_code
      JOIN course
        ON course.code = course_in_semester.course_code
       AND course.code = in_course_code;

END 
