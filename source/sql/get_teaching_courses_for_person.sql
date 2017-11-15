CREATE PROCEDURE get_teaching_courses_for_person (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT course.code   AS course_code,
           course.name   AS course_name,
           semester.code AS semester_code,
           semester.name AS semester_name
      FROM course
      JOIN course_in_semester
        ON course_in_semester.course_code = course.code
      JOIN semester
        ON semester.code = course_in_semester.semester_code
      JOIN teaching_course
        ON teaching_course.course_in_semester_id = course_in_semester.id
      JOIN employment
        ON employment.id = teaching_course.employment_id
      JOIN person
        ON person.id = employment.person_id
       AND person.username = in_username
     GROUP BY semester.code DESC,
              course.code   ASC;


END 
