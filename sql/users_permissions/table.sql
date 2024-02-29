CREATE TABLE users_permissions (
    id BIGINT(19) AUTO_INCREMENT,
    user_id BIGINT(19) NULL DEFAULT NULL,
    permission_id BIGINT(19) NULL DEFAULT NULL,
    PRIMARY KEY (id) USING BTREE,

    INDEX FK_USERS_USERS_PERMISSIONS (user_id) USING BTREE,
    INDEX FK_PERMISSIONS_USERS_PERMISSIONS (permission_id) USING BTREE,
    
    CONSTRAINT FK_USERS_USERS_PERMISSIONS 
        FOREIGN KEY (user_id) 
        REFERENCES users (id) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE,
        
    CONSTRAINT FK_PERMISSIONS_USERS_PERMISSIONS
        FOREIGN KEY (permission_id)
        REFERENCES permissions (id)
        ON UPDATE CASCADE 
        ON DELETE CASCADE
    
);