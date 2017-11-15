CREATE PROCEDURE get_groups_for_person (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT participant_group.id         AS group_id,
           participant_group.name       AS group_name,
           participant_group.created_at AS created_at
      FROM person
      JOIN participant
        ON participant.person_id = person.id
      JOIN participant_group_member
        ON participant_group_member.participant_id = participant.id
      JOIN participant_group
        ON participant_group.id = participant_group_member.participant_group_id
     WHERE person.username = in_username
     ORDER BY participant_group.created_at;

END 
