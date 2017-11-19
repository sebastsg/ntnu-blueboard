CREATE PROCEDURE get_credits_for_person (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT SUM(course.credits) AS total_credits
      FROM person
      JOIN enrollment
        ON enrollment.person_id = person.id
      JOIN enrollment_semester
        ON enrollment_semester.enrollment_id = enrollment.id
      JOIN enrollment_course
        ON enrollment_course.enrollment_semester_id = enrollment_semester.id
      JOIN grade
        ON grade.enrollment_course_id = enrollment_course.id
      JOIN grade_type
        ON grade_type.id = grade.grade_type_id
       AND grade_type.is_pass <> 0
      JOIN course_in_program
        ON course_in_program.id = enrollment_course.course_in_program_id
      JOIN course
        ON course.code = course_in_program.course_code
     WHERE person.username = in_username
       AND grade.created_at =
     	     (SELECT DISTINCT MAX(grade.created_at)
     	        FROM grade
     	       WHERE grade.enrollment_course_id = enrollment_course.id
     	     );

END 
