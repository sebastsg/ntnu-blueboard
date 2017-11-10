CREATE PROCEDURE get_course_room (
    IN in_room_id INT
)

BEGIN

    SELECT course.course_code AS course_code
      FROM course_room
      JOIN course_in_semester
        ON course_in_semester.id = course_room.course_in_semester_id
      JOIN course
        ON course.id = course_in_semester.course_id
     WHERE course_room.room_id = in_room_id;

END 
