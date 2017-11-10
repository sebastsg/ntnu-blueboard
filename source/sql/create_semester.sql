CREATE PROCEDURE create_semester (
    IN in_program_code  VARCHAR(32),
    IN in_semester_code VARCHAR(32),
    IN in_semester_name VARCHAR(128),
    IN in_started_at    DATETIME,
    IN in_ended_at      DATETIME
)

  BEGIN

    INSERT INTO semester (id, program_id, semester_code, semester_name, started_at, ended_at)
         VALUES (0,
                 (SELECT id
                    FROM program
                   WHERE program_code = in_program_code
                 ),
                 in_semester_code,
                 in_semester_name,
                 in_started_at,
                 in_ended_at
                );

  END
