CREATE PROCEDURE get_course_requirements (
    IN in_course_code VARCHAR(16)
)

BEGIN

    SELECT requirement_course.code AS course_code,
           requirement_course.name AS course_name
      FROM course AS for_course
      JOIN course_requirement
        ON course_requirement.course_code = for_course.code
      JOIN course AS requirement_course
        ON requirement_course.code = course_requirement.requires_course_code
     WHERE for_course.code = in_course_code;

END