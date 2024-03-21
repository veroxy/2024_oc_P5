DROP DATABASE if exists 2024_oc_p5_cli;
CREATE DATABASE 2024_oc_p5_cli;
USE `2024_oc_p5_cli`;
CREATE TABLE contact
(
    id           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name`       varchar(255),
    email        VARCHAR(255),
    phone_number VARCHAR(255)
) AUTO_INCREMENT = 1;
INSERT INTO contact(name, email, phone_number)
VALUES ("Kelly Daniels", "dis@hotmail.ca", "(571) 685-8323"),
       ("Guy Jackson", "donec@outlook.com", "(449) 148-5027"),
       ("Lucas Case", "elit.sed@aol.com", "1-924-294-3715"),
       ("Kasimir Abbott", "integer.urna@outlook.net", "(+33) 435-9348"),
       ("Elton Sharp", "adipiscing.enim@google.com", "(752) 881-7826"),
       ("Brenna Valentine", "integer.in@outlook.ca", "1-354-456-3182"),
       ("Fleur Le", "nullam.feugiat.placerat@aol.net", "(763) 657-2608"),
       ("May Norman", "aliquam.vulputate.ullamcorper@aol.com", "1-575-634-2880"),
       ("Erin Walls", "congue.a@aol.edu", "1-831-665-4290"),
       ("Uriah Randall", "aptent@protonmail.com", "(849) 840-3496"),
       ("Wallace Conley", "nec@google.edu", "(+33) 638-1373"),
       ("Velma Walls", "pellentesque.habitant@yahoo.couk", "1-848-377-2976"),
       ("Carlos Evans", "augue@yahoo.couk", "1-207-488-8614"),
       ("Gloria Britt", "enim.consequat@outlook.edu", "(+33) 125-5410"),
       ("Cathleen Schwartz", "aliquet@yahoo.net", "(641) 830-5361"),
       ("Lara Keller", "arcu@yahoo.edu", "(596) 281-7164");