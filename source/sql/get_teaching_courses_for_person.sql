CREATE PROCEDURE get_teaching_courses_for_person (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT course.course_code     AS course_code,
           course.course_name     AS course_name,
           semester.semester_code AS semester_code,
           semester.semester_name AS semester_name
      FROM course
      JOIN course_in_semester
        ON course_in_semester.course_id = course.id
      JOIN semester
        ON semester.id = course_in_semester.semester_id
      JOIN teaching_course
        ON teaching_course.course_in_semester_id = course_in_semester.id
      JOIN employment
        ON employment.id = teaching_course.employment_id
      JOIN person
        ON person.id = employment.person_id
       AND person.username = in_username
     GROUP BY semester.semester_code DESC, course.course_code;


END 
