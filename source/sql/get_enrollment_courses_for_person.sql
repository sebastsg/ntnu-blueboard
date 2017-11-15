CREATE PROCEDURE get_enrollment_courses_for_person (
	IN in_username VARCHAR(32)
)

BEGIN

	SELECT enrollment_course.id AS enrollment_course_id,
	       course.code          AS course_code,
	       grade.grade          AS grade,
	       semester.name        AS semester_name
	  FROM person
	  JOIN enrollment
	    ON enrollment.person_id = person.id
	  JOIN enrollment_semester
	    ON enrollment_semester.enrollment_id = enrollment.id
      JOIN semester
        ON semester.code = enrollment_semester.semester_code
	  JOIN enrollment_course
	    ON enrollment_course.enrollment_semester_id = enrollment_semester.id
	  JOIN course_in_program
	    ON course_in_program.id = enrollment_course.course_in_program_id
	  JOIN course
	    ON course.code = course_in_program.course_code
 LEFT JOIN grade
	    ON grade.enrollment_course_id = enrollment_course.id
	 WHERE person.username = in_username
     ORDER BY semester.started_at DESC,
              course.name         ASC;

END 
