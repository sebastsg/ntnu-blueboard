CREATE PROCEDURE get_teachers_for_course (
    IN in_course_code VARCHAR(32)
)

BEGIN

    SELECT person.first_name AS first_name,
           person.last_name  AS last_name,
           person.email      AS email,
           person.username   AS username
      FROM course
      JOIN course_in_semester
        ON course_in_semester.course_id = course.id
      JOIN teaching_course
        ON teaching_course.course_in_semester_id = course_in_semester.id
      JOIN employment
        ON employment.id = teaching_course.employment_id
      JOIN person
        ON person.id = employment.person_id
      JOIN semester
        ON semester.id = course_in_semester.semester_id
       AND semester.ended_at =
           (SELECT MAX(other_semester.ended_at)
              FROM semester AS other_semester
              JOIN course_in_semester AS other_course_in_semester
                ON other_course_in_semester.semester_id = other_semester.id
             WHERE other_semester.program_id = semester.program_id
               AND other_course_in_semester.course_id = course_in_semester.course_id
           )
     WHERE course.course_code = in_course_code;

END 
