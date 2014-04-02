SELECT `u`.`id`         AS `user_id`
    , `u`.`name`        AS `user_name`
    , `u`.`passhash`    AS `user_passhash`
    , `u`.`salt`        AS `user_salt`
    , `u`.`admin`       AS `user_isadmin`
FROM `user` AS `u`
WHERE `u`.`name` = :name
