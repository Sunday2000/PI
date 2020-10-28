CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_id INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    profession VARCHAR(150) NULL,
    country VARCHAR(150) NULL,
    city VARCHAR(150) NULL,
    sex VARCHAR(255) NOT NULL,
    salary BIGINT UNSIGNED NULL,
    tel VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    balance INT UNSIGNED DEFAULT 0,
    password VARCHAR(255) NOT NULL,
    terms BOOLEAN NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY(id),
    UNIQUE uni_mail(email),
    CONSTRAINT fk_role
        FOREIGN KEY(role_id)
        REFERENCES role(id)
        ON UPDATE RESTRICT
)

CREATE TABLE transaction (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    type VARCHAR(100) NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    trans_way VARCHAR(150) NOT NULL,
    amount INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT trans_user__id
        FOREIGN KEY(user_id)
        REFERENCES user(id)
        ON UPDATE RESTRICT,
    CONSTRAINT trans_service__id
        FOREIGN KEY(service_id)
        REFERENCES service(id)
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

CREATE TABLE operation(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    amount INT UNSIGNED NOT NULL,
    bank VARCHAR(255) NULL,
    bank_number VARCHAR(255) NULL,
    date DATETIME NOT NULL,
    validate BOOLEAN NULL,
    withdrawal_way VARCHAR(255) NULL,
    hash_code VARCHAR(500) NULL,
    receiver VARCHAR(500) NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY(id),
    UNIQUE uni_hash(hash_code),
    CONSTRAINT fk_users
        FOREIGN KEY(user_id)
        REFERENCES user(id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT fk_services
        FOREIGN KEY (service_id)
        REFERENCES service(id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
)
