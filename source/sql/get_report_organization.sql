CREATE PROCEDURE get_report_organization ()

BEGIN

       SELECT faculty.code                   AS faculty_code,
              faculty.name                   AS faculty_name,
              department.code                AS department_code,
              department.name                AS department_name,
              program.code                   AS program_code,
              program.name                   AS program_name,
              course.code                    AS course_code,
              course.name                    AS course_name,
              course_in_program.is_mandatory AS course_is_mandatory
         FROM faculty
    LEFT JOIN department
           ON department.faculty_code = faculty.code
    LEFT JOIN program
           ON program.department_code = department.code
    LEFT JOIN course_in_program
           ON course_in_program.program_code = program.code
    LEFT JOIN course
           ON course.code = course_in_program.course_code
        GROUP BY faculty.code,
                 department.code,
                 program.code,
                 course.code,
                 course_in_program.is_mandatory;

END