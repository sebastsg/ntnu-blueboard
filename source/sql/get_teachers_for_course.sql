CREATE PROCEDURE get_teachers_for_course (
    IN in_course_code VARCHAR(16)
)

BEGIN

    SELECT person.first_name AS first_name,
           person.last_name  AS last_name,
           person.email      AS email,
           person.username   AS username
      FROM course
      JOIN course_in_semester
        ON course_in_semester.course_code = course.code
      JOIN teaching_course
        ON teaching_course.course_in_semester_id = course_in_semester.id
      JOIN employment
        ON employment.id = teaching_course.employment_id
      JOIN person
        ON person.id = employment.person_id
      JOIN semester
        ON semester.code = course_in_semester.semester_code
       AND semester.ended_at =
           (SELECT MAX(other_semester.ended_at)
              FROM semester AS other_semester
              JOIN course_in_semester AS other_course_in_semester
                ON other_course_in_semester.semester_code = other_semester.code
             WHERE other_semester.program_code = semester.program_code
               AND other_course_in_semester.course_code = course_in_semester.course_code
           )
     WHERE course.code = in_course_code;

END 
