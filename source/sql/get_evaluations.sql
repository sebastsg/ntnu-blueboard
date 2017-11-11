CREATE PROCEDURE get_evaluations (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT assignment_evaluation.score      AS score,
           assignment_evaluation.message    AS message,
           assignment_evaluation.created_at AS evaluated_at,
           assignment.title                 AS title,
           assignment.body                  AS body,
           assignment.started_at            AS started_at,
           assignment.ended_at              AS ended_at,
           room.id                          AS room_id,
           room.room_name                   AS room_name,
           assigner_person.username         AS assigner_username,
           assigner_person.first_name       AS assigner_first_name,
           assigner_person.last_name        AS assigner_last_name,
           evaluator_person.username        AS evaluator_username,
           evaluator_person.first_name      AS evaluator_first_name,
           evaluator_person.last_name       AS evaluator_last_name
      FROM person AS requester_person
      JOIN participant AS requester_participant
        ON requester_participant.person_id = requester_person.id
      JOIN assignment_submission
        ON assignment_submission.participant_id = requester_participant.id
      JOIN assignment_evaluation
        ON assignment_evaluation.assignment_submission_id = assignment_submission.id
      JOIN assignment
        ON assignment.id = assignment_submission.assignment_id
      JOIN room
        ON room.id = assignment.room_id
      JOIN participant AS assigner_participant
        ON assigner_participant.id = assignment.participant_id
      JOIN person AS assigner_person
        ON assigner_person.id = assigner_participant.person_id
      JOIN participant AS evaluator_participant
        ON evaluator_participant.id = assignment_evaluation.participant_id
      JOIN person AS evaluator_person
        ON evaluator_person.id = evaluator_participant.person_id
     WHERE requester_person.username = in_username;

END 
