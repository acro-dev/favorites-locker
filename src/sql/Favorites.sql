CREATE TABLE favorites (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    url VARCHAR(255) NOT NULL,
    icon VARCHAR(255),
    fav BOOLEAN,
    creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    category_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (category_id) REFERENCES catergories (id)
) ENGINE = INNODB;