CREATE PROCEDURE get_report_organization ()

BEGIN

       SELECT faculty.faculty_code       AS faculty_code,
              faculty.faculty_name       AS faculty_name,
              department.department_code AS department_code,
              department.department_name AS department_name,
              program.program_code       AS program_code,
              program.program_name       AS program_name,
              course.course_code         AS course_code,
              course.course_name         AS course_name
         FROM faculty
    LEFT JOIN department
           ON department.faculty_id = faculty.id
    LEFT JOIN program
           ON program.department_id = department.id
    LEFT JOIN course_in_program
           ON course_in_program.program_id = program.id
    LEFT JOIN course
           ON course.id = course_in_program.course_id
        GROUP BY faculty_code, department_code, program_code, course_code;

END