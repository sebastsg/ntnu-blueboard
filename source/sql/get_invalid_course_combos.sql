CREATE PROCEDURE get_invalid_course_combos (
    IN in_course_code VARCHAR(16)
)

BEGIN

    SELECT invalid_course.code AS course_code,
           invalid_course.name AS course_name
      FROM course AS for_course
      JOIN invalid_course_combo
        ON invalid_course_combo.course_code_1 = for_course.code
      JOIN course AS invalid_course
        ON invalid_course.code = invalid_course_combo.course_code_2
     WHERE for_course.code = in_course_code

     UNION

    SELECT invalid_course.code AS course_code,
           invalid_course.name AS course_name
      FROM course AS for_course
      JOIN invalid_course_combo
        ON invalid_course_combo.course_code_2 = for_course.code
      JOIN course AS invalid_course
        ON invalid_course.code = invalid_course_combo.course_code_1
     WHERE for_course.code = in_course_code;

END