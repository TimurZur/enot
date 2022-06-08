CREATE TABLE user_settings
(
    user_id           INT UNSIGNED NOT NULL,
    setting_id        INT          NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (setting_id) REFERENCES settings (id),
    value             VARCHAR(255)                        DEFAULT NULL,
    confirmation_type ENUM ('none', 'sms', 'tg', 'email') DEFAULT 'none'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;