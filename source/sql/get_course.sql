CREATE PROCEDURE get_course (
    IN in_course_code VARCHAR(32)
)

BEGIN

    SELECT course.course_name         AS course_name,
           course.description         AS description,
           course.credits             AS credits,
           department.department_code AS department_code,
           department.department_name AS department_name,
           examination_type.type_name AS examination
	  FROM course
	  JOIN department
	    ON department.id = course.department_id
	  JOIN examination_type
	    ON examination_type.id = course.examination_type_id
	 WHERE course.course_code = in_course_code;

END 
