CREATE PROCEDURE get_course_coordinators (
    IN in_course_code VARCHAR(16)
)

BEGIN

    SELECT person.first_name AS first_name,
           person.last_name  AS last_name,
           person.username   AS username,
           person.email      AS email
      FROM course
      JOIN course_coordinator
        ON course_coordinator.course_code = course.code
      JOIN employment
        ON employment.id = course_coordinator.employment_id
      JOIN person
        ON person.id = employment.person_id
     WHERE course.code = in_course_code;

END