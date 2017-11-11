CREATE PROCEDURE create_teaching_course (
    IN in_username      VARCHAR(64),
    IN in_semester_code VARCHAR(64),
    IN in_course_code   VARCHAR(64)
)

BEGIN

    START TRANSACTION;

    INSERT INTO teaching_course (id, course_in_semester_id, employment_id)
         VALUES (0,
                 (SELECT course_in_semester.id
                    FROM semester
                   	JOIN course_in_semester
                   	  ON course_in_semester.semester_id = semester.id
                   	JOIN course
                   	  ON course.id = course_in_semester.course_id
                   	 AND course.course_code = in_course_code
                   WHERE semester.semester_code = in_semester_code
                 ),
                 (SELECT employment.id
                    FROM person
                    JOIN employment
                      ON employment.person_id = person.id
                   WHERE person.username = in_username
                 )
                );

    INSERT INTO participant (id, role_id, person_id, room_id)
         VALUES (0,
                 2,
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
