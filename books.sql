drop table if exists Book;
create table if not exists Book(id integer primary key autoincrement, title varchar(255), isbn10 varchar(255), isbn13 varchar(255));

drop table if exists Person;
create table if not exists Person(id integer primary key autoincrement, first_name varchar(255), last_name varchar(255));

drop table if exists Author;
create table if not exists Author(id integer primary key autoincrement, book_id integer, person_id integer);

insert into Book(id, title, isbn10, isbn13) values (1, "Digital Control of Dynamic Systems", "0-9791226-0-0", "978-0-9791226-0-6");
insert into Book(id, title, isbn10, isbn13) values (2, "Blender for Dummies", NULL, NULL);
insert into Book(id, title, isbn10, isbn13) values (3, "Discrete Algorithmic Mathematics", NULL, NULL);

insert into Person(id, first_name, last_name) values (1, "Gene", "Franklin");
insert into Person(id, first_name, last_name) values (2, "J.", "Powell");
insert into Person(id, first_name, last_name) values (3, "Michael", "Workman");
insert into Person(id, first_name, last_name) values (4, "Jason", "Van Gumster");
insert into Person(id, first_name, last_name) values (5, "Stephen", "Maurer");

insert into Author(book_id, person_id) values(1, 1);
insert into Author(book_id, person_id) values(1, 2);
insert into Author(book_id, person_id) values(1, 3);
insert into Author(book_id, person_id) values(2, 4);
insert into Author(book_id, person_id) values(3, 5);
