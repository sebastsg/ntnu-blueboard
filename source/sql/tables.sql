SET default_storage_engine = InnoDB;

CREATE TABLE faculty (

    code VARCHAR(16)  NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL

);

CREATE TABLE department (

    code         VARCHAR(16)  NOT NULL PRIMARY KEY,
    faculty_code VARCHAR(16)  NOT NULL,
    name         VARCHAR(128) NOT NULL,

    CONSTRAINT  fk_department_faculty_code
    FOREIGN KEY (faculty_code) REFERENCES faculty (code)

);

CREATE TABLE program (

    code             VARCHAR(16)  NOT NULL PRIMARY KEY,
    department_code  VARCHAR(16)  NOT NULL,
    name             VARCHAR(128) NOT NULL,
    required_credits INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_program_department_code
    FOREIGN KEY (department_code) REFERENCES department (code)

);

CREATE TABLE examination_type (

    code VARCHAR(16)  NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL

);

CREATE TABLE course (

    code                  VARCHAR(16)  NOT NULL PRIMARY KEY,
    department_code       VARCHAR(16)  NOT NULL,
    name                  VARCHAR(128) NOT NULL,
    description           TEXT         NOT NULL,
    examination_type_code VARCHAR(16)  NOT NULL,
    credits               INT UNSIGNED NOT NULL,
    created_at            DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at            DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_course_department_code
    FOREIGN KEY (department_code) REFERENCES department (code),

    CONSTRAINT  fk_course_examination_type_code
    FOREIGN KEY (examination_type_code) REFERENCES examination_type (code)

);

CREATE TABLE course_requirement (

    course_code          VARCHAR(16) NOT NULL,
    requires_course_code VARCHAR(16) NOT NULL,

    CONSTRAINT  fk_course_requirement_course_code
    FOREIGN KEY (course_code) REFERENCES course (code),

    CONSTRAINT  fk_course_requirement_requires_course_code
    FOREIGN KEY (requires_course_code) REFERENCES course (code),

    CONSTRAINT  pk_course_requirement
    PRIMARY KEY (course_code, requires_course_code)

);

CREATE TABLE invalid_course_combo (

    course_code_1 VARCHAR(16) NOT NULL,
    course_code_2 VARCHAR(16) NOT NULL,

    CONSTRAINT  fk_invalid_course_combo_course_code_1
    FOREIGN KEY (course_code_1) REFERENCES course (code),

    CONSTRAINT  fk_invalid_course_combo_course_code_2
    FOREIGN KEY (course_code_2) REFERENCES course (code),

    CONSTRAINT  pk_invalid_course_combo
    PRIMARY KEY (course_code_1, course_code_2)

);

CREATE TABLE course_in_program (

    id           INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    program_code VARCHAR(16)  NOT NULL,
    course_code  VARCHAR(16)  NOT NULL,
    is_mandatory BOOLEAN      NOT NULL,

    CONSTRAINT  fk_course_in_program_program_code
    FOREIGN KEY (program_code) REFERENCES program (code),

    CONSTRAINT  fk_course_in_program_course_code
    FOREIGN KEY (course_code) REFERENCES course (code),

    CONSTRAINT  uq_course_in_program
    UNIQUE KEY  (program_code, course_code)

);

CREATE TABLE semester (

    code         VARCHAR(32)  NOT NULL PRIMARY KEY,
    program_code VARCHAR(16)  NOT NULL,
    name         VARCHAR(128) NOT NULL,
    started_at   DATETIME     NOT NULL,
    ended_at     DATETIME     NOT NULL,

    CONSTRAINT fk_semester_program_code
    FOREIGN KEY (program_code) REFERENCES program (code)

);

CREATE TABLE course_in_semester (

    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    semester_code VARCHAR(32) NOT NULL,
    course_code   VARCHAR(16) NOT NULL,

    CONSTRAINT  fk_course_in_semester_semester_code
    FOREIGN KEY (semester_code) REFERENCES semester (code),

    CONSTRAINT  fk_course_in_semester_course_code
    FOREIGN KEY (course_code) REFERENCES course (code),

    CONSTRAINT  uq_course_in_semester
    UNIQUE KEY  (semester_code, course_code)

);

CREATE TABLE role (

    name VARCHAR(16) NOT NULL PRIMARY KEY

);

CREATE TABLE person (

    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(32)  NOT NULL UNIQUE,
    first_name    VARCHAR(128) NOT NULL,
    last_name     VARCHAR(128) NOT NULL,
    email         VARCHAR(128) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);

CREATE TABLE room (

    id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    room_name  VARCHAR(128) NOT NULL,
    created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);

CREATE TABLE course_room (

    room_id               INT UNSIGNED NOT NULL PRIMARY KEY,
    course_in_semester_id INT UNSIGNED NOT NULL UNIQUE,

    CONSTRAINT  fk_course_room_room_id
    FOREIGN KEY (room_id) REFERENCES room (id),

    CONSTRAINT  fk_course_room_course_in_semester_id
    FOREIGN KEY (course_in_semester_id) REFERENCES course_in_semester (id)

);

CREATE TABLE participant (

    id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role_name  VARCHAR(16)  NOT NULL,
    person_id  INT UNSIGNED NOT NULL,
    room_id    INT UNSIGNED NOT NULL,
    created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_participant_role_name
    FOREIGN KEY (role_name) REFERENCES role (name),

    CONSTRAINT  fk_participant_person_id
    FOREIGN KEY (person_id) REFERENCES person (id),

    CONSTRAINT  fk_participant_room_id
    FOREIGN KEY (room_id) REFERENCES room (id),

    CONSTRAINT  uq_participant
    UNIQUE KEY  (role_name, person_id, room_id)

);

CREATE TABLE participant_group (

    id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(128) NOT NULL,
    created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);

CREATE TABLE participant_group_member (

    id                   INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    participant_group_id INT UNSIGNED NOT NULL,
    participant_id       INT UNSIGNED NOT NULL,
    created_at           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_participant_group_member_participant_group_id
    FOREIGN KEY (participant_group_id) REFERENCES participant_group (id),

    CONSTRAINT  fk_participant_group_member_participant_id
    FOREIGN KEY (participant_id) REFERENCES participant (id),

    CONSTRAINT  uq_participant_group_member
    UNIQUE KEY  (participant_group_id, participant_id)

);

CREATE TABLE post (

    id             INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    room_id        INT UNSIGNED NOT NULL,
    participant_id INT UNSIGNED NOT NULL,
    title          VARCHAR(160) NOT NULL,
    body           TEXT         NOT NULL,
    created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_post_room_id
    FOREIGN KEY (room_id) REFERENCES room (id),

    CONSTRAINT  fk_post_participant_id
    FOREIGN KEY (participant_id) REFERENCES participant (id)

);

CREATE TABLE assignment (

    id               INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    room_id          INT UNSIGNED NOT NULL,
    participant_id   INT UNSIGNED NOT NULL,
    title            VARCHAR(160) NOT NULL,
    body             TEXT         NOT NULL,
    started_at       DATETIME     NOT NULL,
    ended_at         DATETIME     NOT NULL,
    allow_groups     BOOLEAN      NOT NULL,
    allow_individual BOOLEAN      NOT NULL,
    created_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_assignment_room_id
    FOREIGN KEY (room_id) REFERENCES room (id),

    CONSTRAINT  fk_assignment_participant_id
    FOREIGN KEY (participant_id) REFERENCES participant (id)

);

CREATE TABLE assignment_submission (

    id             INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    participant_id INT UNSIGNED NOT NULL,
    assignment_id  INT UNSIGNED NOT NULL,
    message        TEXT         NOT NULL,
    created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_assignment_submission_participant_id
    FOREIGN KEY (participant_id) REFERENCES participant (id),

    CONSTRAINT  fk_assignment_submission_assignment_id
    FOREIGN KEY (assignment_id) REFERENCES assignment (id)

);

CREATE TABLE assignment_group_submission (

    id                       INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assignment_submission_id INT UNSIGNED NOT NULL,
    participant_group_id     INT UNSIGNED NOT NUll,

    CONSTRAINT  fk_assignment_group_submission_assignment_submission_id
    FOREIGN KEY (assignment_submission_id) REFERENCES assignment_submission (id),

    CONSTRAINT  fk_assignment_group_submission_participant_group_id
    FOREIGN KEY (participant_group_id) REFERENCES participant_group (id),

    CONSTRAINT  uq_assignment_group
    UNIQUE KEY  (assignment_submission_id, participant_group_id)

);

CREATE TABLE uploaded_file (

    id             INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    participant_id INT UNSIGNED NOT NULL,
    room_id        INT UNSIGNED NOT NULL,
    file_name      VARCHAR(160) NOT NULL,
    file_path      VARCHAR(160) NOT NULL UNIQUE,
    created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_uploaded_file_participant_id
    FOREIGN KEY (participant_id) REFERENCES participant (id),

    CONSTRAINT  fk_uploaded_file_room_id
    FOREIGN KEY (room_id) REFERENCES room (id)

);

CREATE TABLE post_file (

    id               INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_id          INT UNSIGNED NOT NULL,
    uploaded_file_id INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_post_file_post_id
    FOREIGN KEY (post_id) REFERENCES post (id),

    CONSTRAINT  fk_post_file_uploaded_file_id
    FOREIGN KEY (uploaded_file_id) REFERENCES uploaded_file (id),

    CONSTRAINT  uq_post_file
    UNIQUE KEY  (post_id, uploaded_file_id)

);

CREATE TABLE assignment_file (

    id               INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assignment_id    INT UNSIGNED NOT NULL,
    uploaded_file_id INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_assignment_file_assignment_id
    FOREIGN KEY (assignment_id) REFERENCES assignment (id),

    CONSTRAINT  fk_assignment_file_uploaded_file_id
    FOREIGN KEY (uploaded_file_id) REFERENCES uploaded_file (id),

    CONSTRAINT  uq_assignment_file
    UNIQUE KEY  (assignment_id, uploaded_file_id)

);

CREATE TABLE assignment_submission_file (

    id                       INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assignment_submission_id INT UNSIGNED NOT NULL,
    uploaded_file_id         INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_assignment_submission_file_post_id
    FOREIGN KEY (assignment_submission_id) REFERENCES assignment_submission (id),

    CONSTRAINT  fk_assignment_submission_file_uploaded_file_id
    FOREIGN KEY (uploaded_file_id) REFERENCES uploaded_file (id),

    CONSTRAINT  uq_assignment_submission_file
    UNIQUE KEY  (assignment_submission_id, uploaded_file_id)

);

CREATE TABLE assignment_evaluation (

    id                       INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    assignment_submission_id INT UNSIGNED NOT NULL,
    participant_id           INT UNSIGNED NOT NULL,
    score                    INT          NOT NULL,
    message                  TEXT         NOT NULL,
    created_at               DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at               DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_assignment_evaluation_assignment_submission_id
    FOREIGN KEY (assignment_submission_id) REFERENCES assignment_submission (id),

    CONSTRAINT  fk_assignment_evaluation_participant_id
    FOREIGN KEY (participant_id) REFERENCES participant (id)

);

CREATE TABLE employment (

    id              INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    department_code VARCHAR(16)  NOT NULL,
    person_id       INT UNSIGNED NOT NULL,
    created_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_employment_department_code
    FOREIGN KEY (department_code) REFERENCES department (code),

    CONSTRAINT  fk_employment_person_id
    FOREIGN KEY (person_id) REFERENCES person (id),

    CONSTRAINT  uq_employment
    UNIQUE KEY  (department_code, person_id)

);

CREATE TABLE course_coordinator (

    course_code   VARCHAR(16)  NOT NULL,
    employment_id INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_course_coordinator_course_code
    FOREIGN KEY (course_code) REFERENCES course (code),

    CONSTRAINT  fk_course_coordinator_employment_id
    FOREIGN KEY (employment_id) REFERENCES employment (id),

    CONSTRAINT  pk_course_coordinator
    PRIMARY KEY (course_code, employment_id)

);

CREATE TABLE teaching_course (

    id                    INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_in_semester_id INT UNSIGNED NOT NULL,
    employment_id         INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_teaching_course_course_in_semester_id
    FOREIGN KEY (course_in_semester_id) REFERENCES course_in_semester (id),

    CONSTRAINT  fk_teaching_course_employment_id
    FOREIGN KEY (employment_id) REFERENCES employment (id),

    CONSTRAINT  uq_teaching_course
    UNIQUE KEY  (course_in_semester_id, employment_id)

);

CREATE TABLE enrollment (

    id             INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    person_id      INT UNSIGNED NOT NULL,
    program_code   VARCHAR(16)  NOT NULL,
    student_number VARCHAR(32)  NOT NULL UNIQUE,
    created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_enrollment_person_id
    FOREIGN KEY (person_id)	REFERENCES person (id),

    CONSTRAINT  fk_enrollment_program_code
    FOREIGN KEY (program_code) REFERENCES program (code)

);

CREATE TABLE enrollment_semester (

    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    semester_code VARCHAR(32)  NOT NULL,
    enrollment_id INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_enrollment_semester_semester_code
    FOREIGN KEY (semester_code) REFERENCES semester (code),

    CONSTRAINT  fk_enrollment_semester_enrollment_id
    FOREIGN KEY (enrollment_id) REFERENCES enrollment (id),

    CONSTRAINT  uq_enrollment_semester
    UNIQUE KEY  (semester_code, enrollment_id)

);

CREATE TABLE enrollment_course (

    id                     INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_in_program_id   INT UNSIGNED NOT NULL,
    enrollment_semester_id INT UNSIGNED NOT NULL,

    CONSTRAINT  fk_enrollment_course_course_in_program_id
    FOREIGN KEY (course_in_program_id) REFERENCES course_in_program (id),

    CONSTRAINT  fk_enrollment_course_enrollment_semester_id
    FOREIGN KEY (enrollment_semester_id) REFERENCES enrollment_semester (id),

    CONSTRAINT  uq_enrollment_course
    UNIQUE KEY  (course_in_program_id, enrollment_semester_id)

);

CREATE TABLE grade (

    id                   INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    enrollment_course_id INT UNSIGNED NOT NULL,
    teaching_course_id   INT UNSIGNED NOT NULL,
    grade                CHAR         NOT NULL,
    created_at           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT  fk_grade_enrollment_course_id
    FOREIGN KEY (enrollment_course_id) REFERENCES enrollment_course (id),

    CONSTRAINT  fk_grade_teaching_course_id
    FOREIGN KEY (teaching_course_id) REFERENCES teaching_course (id)

);
