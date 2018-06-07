/**
 * Author:  olegiv
 * Created: Jun 7, 2018
 */

CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT
);

INSERT INTO user (username, password) VALUES
    ('opossum', 'mypass'), ('possum', '123'), ('fox', 'fox');
