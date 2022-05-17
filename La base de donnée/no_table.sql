
CREATE DATABASE IF NOT EXISTS `NO` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `NO`;

CREATE TABLE `commentary` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `post_id` int(10) unsigned NOT NULL,
    `user_id` int(10) unsigned NOT NULL,
    `text` text not null,
    `reaction` ENUM("0", "1") not null,
    PRIMARY KEY (`id`),
    KEY `post_id_foreign` (`post_id`),
    KEY `user_id_foreign` (`user_id`),
    CONSTRAINT `post_id_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
    CONSTRAINT `user_id_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `lastname` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `mail` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `birthday` date NOT NULL,
    `phone` char(10) NOT NULL,
    `account_state` TINYINT(1) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE `profil`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `banner` VARCHAR(255) NOT NULL,
    `profil_picture` VARCHAR(255) NOT NULL,
    `description` JSON NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`), 
    CONSTRAINT `profil_id_foreign_key` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
);
CREATE TABLE `post`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `text` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `commentary` JSON NOT NULL,
    CONSTRAINT `profil_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
);
CREATE TABLE `friendlist`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `friend_id` INT NOT NULL,
    `friend_username` VARCHAR(255) NOT NULL,
    `friend_image` VARCHAR(255) NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `friendlist_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
);
CREATE TABLE `group`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `banner` VARCHAR(255) NOT NULL,
    `post` INT NOT NULL
);
CREATE TABLE `page`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `admin` JSON NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `page_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
);
CREATE TABLE `message`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `send` TEXT NOT NULL,
    `who_send` INT UNSIGNED NOT NULL,
    `who_receive` INT NOT NULL,
    CONSTRAINT `message_who_send_foreign` FOREIGN KEY(`who_send`) REFERENCES `users`(`id`)
);
CREATE TABLE `user_membership`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `user_group` INT UNSIGNED NOT NULL,
    `is_admin` TINYINT(1) NOT NULL,
    `is_candidate` TINYINT(1) NOT NULL,
    `is_member` TINYINT(1) NOT NULL,
    `is_exclude` TINYINT(1) NOT NULL,
    CONSTRAINT `user_membership_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`),
    CONSTRAINT `user_membership_user_group_foreign` FOREIGN KEY(`user_group`) REFERENCES `group`(`id`)
);
CREATE TABLE `group_post`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `group_id` INT UNSIGNED NOT NULL,
    `who_post` INT UNSIGNED NOT NULL,
    `texte` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `commentary` JSON NOT NULL,
    CONSTRAINT `group_post_group_id_foreign` FOREIGN KEY(`group_id`) REFERENCES `group`(`id`),
    CONSTRAINT `group_post_who_post_foreign` FOREIGN KEY(`who_post`) REFERENCES `users`(`id`)
);
