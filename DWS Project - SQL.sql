CREATE DATABASE grandlineuni;
USE grandlineuni; 

CREATE TABLE members
(
mID int primary key,
mName varchar(30) NOT NULL
);

CREATE TABLE professors
(
pID int primary key,
pName varchar(30) NOT NULL,
dob date,
department varchar(50),
salary int
);

CREATE TABLE 1st_2nd_yr_students
(
sID int primary key,
sName varchar(30) NOT NULL,
sYear varchar(20),
dob date,
gpa decimal(3,2),
course varchar(30),
elective varchar(30)
);

CREATE TABLE 3rd_yr_students
(
sID int primary key,
sName varchar(30) NOT NULL,
sYear varchar(20),
dob date,
gpa decimal(3,2),
course varchar(30),
internship_status varchar(30)
);

CREATE TABLE 4th_yr_students
(
sID int primary key,
sName varchar(30) NOT NULL,
sYear varchar(20),
dob date,
gpa decimal(3,2),
course varchar(30),
thesis_advisor varchar(30),
thesis_status varchar(30)
);

-- filling members table 
INSERT INTO members VALUE(0001, 'Trafalgar Law');
INSERT INTO members VALUE(0002, 'Portgas D. Ace');
INSERT INTO members VALUE(0003, 'Sabo');
INSERT INTO members VALUE(0004, 'Monkey D. Luffy');
INSERT INTO members VALUE(0005, 'Nami');
INSERT INTO members VALUE(0006, 'Vinsmoke Sanji');
INSERT INTO members VALUE(0007, 'Roronoa Zoro');
INSERT INTO members VALUE(0008, 'Bedivere Bedrydant');
INSERT INTO members VALUE(0009, 'Wen Junhui');
INSERT INTO members VALUE(00010, 'Romani Archaman');
INSERT INTO members VALUE(00011, 'Sakasaki Natsume');
INSERT INTO members VALUE(00012, 'Harukawa Sora');
INSERT INTO members VALUE(00013, 'Aoba Tsumugi');
INSERT INTO members VALUE(00014, 'Nito Nazuna');

-- filling professors table 
INSERT INTO professors VALUES(0001, 'Trafalgar Law', DATE '1990-07-06' , 'Department of Medicine', 10000);
INSERT INTO professors VALUES(0002, 'Portgas D. Ace', DATE '1994-01-01', 'Department of Physical Education', 9000);
INSERT INTO professors VALUES(0003, 'Sabo', DATE '1994-03-03', 'Department of Psychology', 8000);
INSERT INTO professors VALUES(0008, 'Bedivere Bedrydant', DATE '1983-06-08', 'Department of Computer Science', 22000);
INSERT INTO professors VALUES(0009, 'Wen Junhui', DATE '1996-06-10', 'Department of Physics', 9000);
INSERT INTO professors VALUES(0010, 'Romani Archaman', DATE '1974-09-12', 'Department of Chemistry', 8000);

-- filling student tables 
INSERT INTO 1st_2nd_yr_students VALUES(0004, 'Monkey D. Luffy', 'freshman', DATE '2004-05-05', 1.5, 'Communication', 'Physical Education');
INSERT INTO 1st_2nd_yr_students VALUES(0005, 'Nami', 'freshman', DATE '2003-07-07', 4.0, 'Meteorology', 'Psychology');
INSERT INTO 1st_2nd_yr_students VALUES(0006, 'Vinsmoke Sanji', 'sophomore', DATE '2002-03-03', 3.8, 'Culinary Arts', 'Physical Education');
INSERT INTO 1st_2nd_yr_students VALUES(0007, 'Roronoa Zoro', 'sophomore', DATE '2002-11-11', 3.0, 'Physics', 'Physical Education');

INSERT INTO 3rd_yr_students VALUES(0011, 'Sakasaki Natsume', 'junior', DATE '2001-02-04', 3.9, 'Chemistry', 'Completed');
INSERT INTO 3rd_yr_students VALUES(0012, 'Harukawa Sora', 'junior', DATE '2002-07-01', 3.0, 'Physics', 'Pending');

INSERT INTO 4th_yr_students VALUES(0013, 'Aoba Tsumugi', 'senior', DATE '2000-08-07', 3.7, 'Computer Science', 'Bedivere Bedrydant', 'Completed');
INSERT INTO 4th_yr_students VALUES(0014, 'Nito Nazuna', 'senior', DATE '2000-04-27', 2.8, 'Psychology', 'Sabo', 'Ongoing');

-- Queries (Natural language phrasing + SQL equivalent)

-- 1. displays all information of the professor whose ID is 0002 (from the professor table)
SELECT * FROM professors WHERE pID = 0002;

-- 2. displays the names of students in the specified elective (from the 1st and 2nd yr students table)
SELECT sName FROM 1st_2nd_yr_students WHERE elective = 'Physical Education';

-- 3. displays name and gpa of 3rd yr students from the two specified tables, joined based on the common ID column 
SELECT members.mName, 3rd_yr_students.gpa FROM members JOIN 3rd_yr_students ON members.mID = 3rd_yr_students.sID;

-- 4. displays ID, name and course of the freshman students, ordering them by their names in descending alphabetical order 
SELECT sID, sName, course FROM 1st_2nd_yr_students WHERE sYear = 'freshman' ORDER BY sName DESC;

-- 5. displays ID, name and salary of professors with salaries greater than 9k from professors table
SELECT pID, pName, salary FROM professors GROUP BY pID HAVING max(salary) > 9000;

-- 6. displays name and salary of the professors from the two specified tables, joined based on the common ID column 
SELECT members.mName, professors.salary FROM members JOIN professors ON members.mID = professors.pID ORDER BY mName;
