CREATE TABLE settings
(
    id   INT          NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
) ENGINE = InnoDB DEFAULT CHARSET = utf8;