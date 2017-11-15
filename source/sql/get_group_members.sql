CREATE PROCEDURE get_group_members (
    IN in_participant_group_id INT UNSIGNED
)

BEGIN

    SELECT person.first_name                   AS first_name,
           person.last_name                    AS last_name,
           person.email                        AS email,
           person.username                     AS username,
           participant.id                      AS participant_id,
           participant.role_name               AS role_name,
           participant_group_member.created_at AS joined_at
      FROM participant_group
      JOIN participant_group_member
        ON participant_group_member.participant_group_id = participant_group.id
      JOIN participant
        ON participant.id = participant_group_member.participant_id
      JOIN person
        ON person.id = participant.person_id
     WHERE participant_group.id = in_participant_group_id;

END 
