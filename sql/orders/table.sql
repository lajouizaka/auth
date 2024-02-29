CREATE TABLE orders (
    id BIGINT(19) NOT NULL AUTO_INCREMENT,
    status VARCHAR(20) NOT NULL DEFAULT 'under-review' ,
    order_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    full_name VARCHAR(255) NOT NULL ,
    phone_number VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL ,
    street_address VARCHAR(255) NOT NULL,
    street_address_two VARCHAR(255) NULL DEFAULT NULL,
    ZIP_CODE VARCHAR(6) NOT NULL ,
    city VARCHAR(20) NOT NULL ,
    state VARCHAR(20) NOT NULL ,
    country VARCHAR(20) NOT NULL ,
    
    PRIMARY KEY (id) USING BTREE
);