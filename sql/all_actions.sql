-- TD1 : requête à utiliser ci-dessous:
select action_log.id as action_id, action_date, action_name, u.username as username from action_log join `users` u on user_id = u.id order by action_date desc;

-- TD2 : requête à utiliser ci-dessous:
select u.username as username, action_date, action_name, action_log.id as action_id  from action_log join `users` u on user_id = u.id order by action_date desc;

-- TD3 : requête à utiliser ci-dessous:
select action_date, u.username as username, action_name, action_log.id as action_id  from action_log join `users` u on user_id = u.id order by action_date desc;