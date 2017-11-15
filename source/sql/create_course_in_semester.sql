CREATE PROCEDURE create_course_in_semester (
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(16)
)

BEGIN

    START TRANSACTION;

    INSERT INTO course_in_semester (id, semester_code, course_code)
         VALUES (0, in_semester_code, in_course_code);

    INSERT INTO room (id, name)
         VALUES (0,
                 (SELECT CONCAT('<b>', CONCAT(code, CONCAT('</b> ', name)))
                    FROM course
                   WHERE code = in_course_code
                 )
                );

    INSERT INTO course_room (room_id, course_in_semester_id)
         VALUES (LAST_INSERT_ID(),
                 (SELECT course_in_semester.id
                    FROM course_in_semester
                    JOIN semester
                      ON semester.code = course_in_semester.semester_code
                    JOIN course
                      ON course.code = course_in_semester.course_code
                   WHERE course_in_semester.semester_code = in_semester_code
                     AND course_in_semester.course_code = in_course_code
                 )
               );

    COMMIT;

END