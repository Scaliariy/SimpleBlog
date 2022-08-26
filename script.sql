create table comments
(
    id            int auto_increment
        primary key,
    post_id       int          not null,
    comment       varchar(500) not null,
    visitore_name varchar(50)  not null,
    created_at    date         null
);

INSERT INTO blog.comments (id, post_id, comment, visitore_name, created_at) VALUES (1, 1, 'Excellent', 'Nikol', '2022-08-21');
INSERT INTO blog.comments (id, post_id, comment, visitore_name, created_at) VALUES (2, 2, 'Super!', 'Anton', '2022-08-21');
INSERT INTO blog.comments (id, post_id, comment, visitore_name, created_at) VALUES (3, 2, 'Very bad:(', 'Armen', '2022-08-20');

create table grades
(
    id      int auto_increment
        primary key,
    post_id int null,
    grade   int null
);

INSERT INTO blog.grades (id, post_id, grade) VALUES (127, 1, 1);
INSERT INTO blog.grades (id, post_id, grade) VALUES (128, 2, 1);
INSERT INTO blog.grades (id, post_id, grade) VALUES (129, 3, 2);
INSERT INTO blog.grades (id, post_id, grade) VALUES (132, 3, 1);
INSERT INTO blog.grades (id, post_id, grade) VALUES (136, 4, 5);
INSERT INTO blog.grades (id, post_id, grade) VALUES (137, 4, 1);

create table posts
(
    id            int auto_increment
        primary key,
    post          text                      not null,
    visitore_name varchar(50)               not null,
    created_at    date default '2000-01-01' not null
)
    engine = MyISAM
    charset = latin1;

INSERT INTO blog.posts (id, post, visitore_name, created_at) VALUES (1, 'This is my first post on my new simple blog!', 'Ann', '2018-10-17');
INSERT INTO blog.posts (id, post, visitore_name, created_at) VALUES (2, 'This post is all about web design! I love web design!', 'Rob', '2021-10-17');
INSERT INTO blog.posts (id, post, visitore_name, created_at) VALUES (3, 'This post is all about user experience and how important it is while designing for the web.', 'Pin', '2021-10-18');
INSERT INTO blog.posts (id, post, visitore_name, created_at) VALUES (4, 'Hello World!!!', 'Bob', '2022-08-22');

