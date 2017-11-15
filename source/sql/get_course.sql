CREATE PROCEDURE get_course (
    IN in_course_code VARCHAR(16)
)

BEGIN

    SELECT course.name           AS course_name,
           course.description    AS description,
           course.credits        AS credits,
           department.code       AS department_code,
           department.name       AS department_name,
           examination_type.name AS examination
	  FROM course
	  JOIN department
	    ON department.code = course.department_code
	  JOIN examination_type
	    ON examination_type.code = course.examination_type_code
	 WHERE course.code = in_course_code;

END 
