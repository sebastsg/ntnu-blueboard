CREATE PROCEDURE get_course_requirements (
    IN in_course_code VARCHAR(32)
)

BEGIN

    SELECT requirement_course.course_code AS course_code,
           requirement_course.course_name AS course_name
      FROM course
      JOIN course_requirement
        ON course_requirement.course_id = course.id
      JOIN course AS requirement_course
        ON requirement_course.id = course_requirement.requires_course_id
     WHERE course.course_code = in_course_code;

END