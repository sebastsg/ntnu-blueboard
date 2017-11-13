CREATE PROCEDURE create_course_requirement (
    IN in_course_code          VARCHAR(32),
    IN in_requires_course_code VARCHAR(32)
)

BEGIN

    INSERT INTO course_requirement (course_id, requires_course_id)
         VALUES ((SELECT id
                    FROM course
                   WHERE course_code = in_course_code
                 ),
                 (SELECT id
                    FROM course
                   WHERE course_code = in_requires_course_code
                 )
                );

END