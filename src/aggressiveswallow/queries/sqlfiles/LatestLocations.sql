SELECT `l`.`id`            AS `location_id` 
       , `l`.`price`       AS `location_price` 
       , `l`.`description` AS `location_description` 
       , `a`.`id`          AS `address_id` 
       , `a`.`street`      AS `address_street` 
       , `a`.`housenumber` AS `address_housenumber` 
       , `a`.`zipcode`     AS `address_zipcode` 
       , `a`.`city`        AS `address_city` 
       , `c`.`id`          AS `menuitem_id` 
       , `c`.`name`        AS `menuitem_name` 
       , `c`.`uri`         AS `menuitem_uri` 
FROM   `location` AS `l` 
       JOIN `address` AS `a` 
         ON ( `l`.`address_id` = `a`.`id` ) 
       JOIN `menuitem` AS `c` 
         ON ( `l`.`menuitem_id` = `c`.`id` ) 
LIMIT  10; 