CREATE PROCEDURE find_course_room (
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(32)
)

BEGIN

    SELECT course_room.room_id AS room_id
      FROM course_room
      JOIN course_in_semester
        ON course_in_semester.id = course_room.course_in_semester_id
      JOIN semester
        ON semester.id = course_in_semester.semester_id
       AND semester.semester_code = in_semester_code
      JOIN course
        ON course.id = course_in_semester.course_id
       AND course.course_code = in_course_code;

END 
