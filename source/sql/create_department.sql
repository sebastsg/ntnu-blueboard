CREATE PROCEDURE create_department (
    IN in_faculty_code    VARCHAR(32),
    IN in_department_code VARCHAR(32),
    IN in_department_name VARCHAR(128)
)

  BEGIN

    INSERT INTO department (id, faculty_id, department_code, department_name)
         VALUES (0,
                 (SELECT id
                    FROM faculty
                   WHERE faculty_code = in_faculty_code
                 ),
                 in_department_code,
                 in_department_name
                );

  END
