BEGIN TRANSACTION;

-- Creating tables

CREATE TABLE 'users' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'username' TEXT NOT NULL UNIQUE,
    'password' TEXT NOT NULL,
    'admin' TEXT NOT NULL
);

CREATE TABLE 'sessions' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'user_id' TEXT NOT NULL,
    'session' TEXT NOT NULL UNIQUE
);

CREATE TABLE 'concerts' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'file_name' TEXT NOT NULL,
    'file_ext' TEXT NOT NULL,
    'description' TEXT
 );




-- Initial seed data


--users data
INSERT INTO 'users' (id, username, password, admin) VALUES (5,'andrew', '$2y$10$qwoHiAIhEPQsk3XrW2ovnuEt0Iu9e5fVLG.x.8KExqKZScyCC9vb6', 1);--password is melodies
INSERT INTO 'users' (id, username, password, admin) VALUES (23,'karlye', '$2y$10$qwoHiAIhEPQsk3XrW2ovnuEt0Iu9e5fVLG.x.8KExqKZScyCC9vb6', 1); --password is melodies
INSERT INTO 'users' (id, username, password, admin) VALUES (32,'seonah', '$2y$10$qwoHiAIhEPQsk3XrW2ovnuEt0Iu9e5fVLG.x.8KExqKZScyCC9vb6', 1); --password is melodies
INSERT INTO 'users' (id, username, password, admin) VALUES (7,'anna', '$2y$10$qwoHiAIhEPQsk3XrW2ovnuEt0Iu9e5fVLG.x.8KExqKZScyCC9vb6', 1); --password is melodies

--concerts data
INSERT INTO 'concerts' (id, file_name,file_ext,description) VALUES (3, '3','jpg', 'Spring 2019');
INSERT INTO 'concerts' (id, file_name,file_ext,description) VALUES (2, '2', 'png', 'Fall 2019');


-- FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!

--each member's password is 'melodies'

COMMIT;
