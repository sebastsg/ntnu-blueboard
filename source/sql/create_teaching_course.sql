CREATE PROCEDURE create_teaching_course (
    IN in_username      VARCHAR(32),
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(16)
)

BEGIN

    START TRANSACTION;

    INSERT INTO teaching_course (id, course_in_semester_id, employment_id)
         VALUES (0,
                 (SELECT course_in_semester.id
                    FROM semester
                   	JOIN course_in_semester
                   	  ON course_in_semester.semester_code = semester.code
                   	JOIN course
                   	  ON course.code = course_in_semester.course_code
                   	 AND course.code = in_course_code
                   WHERE semester.code = in_semester_code
                 ),
                 (SELECT employment.id
                    FROM person
                    JOIN employment
                      ON employment.person_id = person.id
                   WHERE person.username = in_username
                 )
                );

    INSERT INTO participant (id, role_name, person_id, room_id)
         VALUES (0,
                 'teacher',
                 (SELECT id
                    FROM person
                   WHERE username = in_username
                 ),
                 (SELECT course_room.room_id
                    FROM course_room
                    JOIN teaching_course
                      ON teaching_course.id = LAST_INSERT_ID()
                     AND teaching_course.course_in_semester_id = course_room.course_in_semester_id
                 )
                );

    COMMIT;
	
END
