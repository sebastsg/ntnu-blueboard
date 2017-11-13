CREATE PROCEDURE get_course_coordinators (
    IN in_course_code VARCHAR(32)
)

BEGIN

    SELECT person.first_name AS first_name,
           person.last_name  AS last_name,
           person.username   AS username,
           person.email      AS email
      FROM course
      JOIN course_coordinator
        ON course_coordinator.course_id = course.id
      JOIN employment
        ON employment.id = course_coordinator.employment_id
      JOIN person
        ON person.id = employment.person_id
     WHERE course.course_code = in_course_code;

END