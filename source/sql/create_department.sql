CREATE PROCEDURE create_department (
    IN in_faculty_code    VARCHAR(16),
    IN in_department_code VARCHAR(16),
    IN in_department_name VARCHAR(128)
)

  BEGIN

    INSERT INTO department (code, faculty_code, name)
         VALUES (in_department_code, in_faculty_code, in_department_name);

  END
