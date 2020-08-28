CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    tel VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    balance INT UNSIGNED DEFAULT 0,
    password VARCHAR(255) NOT NULL,
    terms BOOLEAN NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY(id),
    INDEX ind_ser_em (email, service_id),
    CONSTRAINT fk_role
        FOREIGN KEY(role_id)
        REFERENCES role(id)
        ON UPDATE RESTRICT
)

CREATE TABLE service (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY(id)
)

CREATE TABLE role (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    PRIMARY KEY(id)
)
