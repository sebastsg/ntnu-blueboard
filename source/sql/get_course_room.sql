CREATE PROCEDURE get_course_room (
    IN in_room_id INT UNSIGNED
)

BEGIN

    SELECT course.code   AS course_code,
           course.name   AS course_name,
           semester.code AS semester_code,
           semester.name AS semester_name
      FROM course_room
      JOIN course_in_semester
        ON course_in_semester.id = course_room.course_in_semester_id
      JOIN semester
        ON semester.code = course_in_semester.semester_code
      JOIN course
        ON course.code = course_in_semester.course_code
     WHERE course_room.room_id = in_room_id;

END 
