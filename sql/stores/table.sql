CREATE TABLE stores (
    id BIGINT(19) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
    slug VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
    user_id BIGINT(19) NULL DEFAULT NULL,
    
    PRIMARY KEY (id) USING BTREE,

    UNIQUE INDEX name (name) USING BTREE,
    UNIQUE INDEX slug (slug) USING BTREE,

    INDEX FK_USERS_STORES (user_id) USING BTREE,

    CONSTRAINT FK_USERS_STORES
    FOREIGN KEY (user_id)
    REFERENCES users (id) 
    ON UPDATE NO ACTION ON DELETE CASCADE
);
   