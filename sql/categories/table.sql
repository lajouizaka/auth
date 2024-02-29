CREATE TABLE categories (
    id BIGINT(19) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    user_id BIGINT(19) NULL DEFAULT NULL,

    PRIMARY KEY (id) USING BTREE,

    UNIQUE INDEX name (name) USING BTREE,
    UNIQUE INDEX slug (slug) USING BTREE,

    INDEX FK_USERS_CATEGORIES (user_id) USING BTREE,
    
    CONSTRAINT FK_USERS_CATEGORIES FOREIGN KEY (user_id)
    REFERENCES users (id) 
    ON UPDATE NO ACTION 
    ON DELETE CASCADE
);