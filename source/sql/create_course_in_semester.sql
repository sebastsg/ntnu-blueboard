CREATE PROCEDURE create_course_in_semester (
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(32)
)

BEGIN

    INSERT INTO course_in_semester (id, semester_id, course_id)
         VALUES (0,
                 (SELECT id
                    FROM semester
                   WHERE semester_code = in_semester_code
                 ),
                 (SELECT id
                    FROM course
                   WHERE course_code = in_course_code
                 )
                );

    INSERT INTO room (id, room_name)
         VALUES (0,
                 (SELECT CONCAT('<b>', CONCAT(course_code, CONCAT('</b> ', course_name)))
                    FROM course
                   WHERE course_code = in_course_code
                 )
                );

    INSERT INTO course_room (room_id, course_in_semester_id)
         VALUES (LAST_INSERT_ID(),
                 (SELECT course_in_semester.id
                    FROM course_in_semester
                    JOIN semester
                      ON semester.id = course_in_semester.semester_id
                     AND semester.semester_code = in_semester_code
                    JOIN course
                      ON course.id = course_in_semester.course_id
                     AND course.course_code = in_course_code
                 )
               );

END