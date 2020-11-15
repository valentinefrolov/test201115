/* 10.4.14-MariaDB */

CREATE TABLE `users` (
     `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
     `name` VARCHAR(255) NOT NULL,
     `gender` INT(11) UNSIGNED NOT NULL COMMENT '0 - не указан, 1 - мужчина, 2 - женщина.',
     `birth_date` INT(11) UNSIGNED NOT NULL COMMENT 'Дата в unixtime.',
     PRIMARY KEY (`id`)
);

CREATE TABLE `phone_numbers` (
     `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
     `user_id` INT(11) UNSIGNED NOT NULL,
     `phone` VARCHAR(255) DEFAULT NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY (`user_id`)  REFERENCES `users` (`id`)
);

SELECT u.`name`, (
    SELECT COUNT(*) FROM phone_numbers pn
    WHERE pn.user_id = u.id
      AND NULLIF(pn.phone, '') IS NOT NULL
) AS  `phone_numbers`
FROM `users` u
WHERE u.`gender` = 2
  AND u.birth_date >= UNIX_TIMESTAMP(CURDATE() - INTERVAL 22 YEAR)
  AND u.birth_date <= UNIX_TIMESTAMP(CURDATE() - INTERVAL 18 YEAR)



