DROP DATABASE IF EXISTS questioner;
CREATE DATABASE questioner;
use questioner;
GRANT ALL ON questioner.*TO'php'@'localhost'IDENTIFIED BY 'phpdb';


-- ************************************** `student`

-- ************************************** `subjects`

CREATE TABLE `subjects`
(
 `subject_id`  int NOT NULL AUTO_INCREMENT ,
 `name`        varchar(255) NOT NULL ,
 `description` varchar(255) NOT NULL ,

PRIMARY KEY (`subject_id`)
) AUTO_INCREMENT=5001;


CREATE TABLE `student`
(
 `student_id` int NOT NULL AUTO_INCREMENT ,
 `name`       varchar(45) NOT NULL ,
 `subject_id` int NOT NULL ,
 `password`   varchar(45) NOT NULL ,
 `mail`       varchar(45) NOT NULL ,

PRIMARY KEY (`student_id`),
KEY `FK_2` (`subject_id`),
CONSTRAINT `FK_2` FOREIGN KEY `FK_2` (`subject_id`) REFERENCES `subjects` (`subject_id`)
) AUTO_INCREMENT=90000;


-- ************************************** `teacher`

CREATE TABLE `teacher`
(
 `teacher_id` int NOT NULL AUTO_INCREMENT ,
 `name`       varchar(45) NOT NULL ,
 `subject_id` int NOT NULL ,
 `mail`       varchar(45) NOT NULL ,
 `password`   varchar(45) NOT NULL ,

PRIMARY KEY (`teacher_id`),
KEY `FK_2` (`subject_id`),
CONSTRAINT `FK_1` FOREIGN KEY `FK_2` (`subject_id`) REFERENCES `subjects` (`subject_id`)
) AUTO_INCREMENT=80001;



-- ************************************** `questions`

CREATE TABLE `questions`
(
 `id`         int NOT NULL AUTO_INCREMENT ,
 `question`   varchar(500) NOT NULL ,
 `teacher_id` int NOT NULL ,
 `student_id` int NOT NULL ,
 `answer`     varchar(1024) NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`student_id`),
CONSTRAINT `FK_3` FOREIGN KEY `FK_2` (`student_id`) REFERENCES `student` (`student_id`),
KEY `FK_3` (`teacher_id`),
CONSTRAINT `FK_4` FOREIGN KEY `FK_3` (`teacher_id`) REFERENCES `teacher` (`teacher_id`)
) AUTO_INCREMENT=2001;



-- insert subject data

INSERT INTO `subjects` ( `name`, `description`) VALUES
( 'Advanced Algorithms', 'Techniques needed to analyze algorithms, divide-and-conquer approach, matrix manipulation, dynamic programming, greedy approach, backtracking, branch-and-bound, and NPcompleteness.'),
( 'Advanced Operating Systems', 'An in-depth study of advanced topics in the field of operating systems such as protection and security, distributed system structures, distributed file systems.'),
( 'Advanced Web Applications and Services Development', ' graduate level course which covers the advanced topics in web programming, including client and server side scripting, HTML, JavaScript, jQuery, PHP, other popular web programming techniques.');


-- student data

INSERT INTO `student`(
   
    `name`,
    `subject_id`,
    `password`,
    `mail`
)
VALUES(
    'Student I',
    '5001',
    'qwerty1',
    'student1@ucmo.edu'
);
INSERT INTO `student`(
   
    `name`,
    `subject_id`,
    `password`,
    `mail`
)
VALUES(
    'Student II',
    '5003',
    'qwerty1',
    'student2@ucmo.edu'
);
INSERT INTO `student`(
   
    `name`,
    `subject_id`,
    `password`,
    `mail`
)
VALUES(
    'Student III',
    '5002',
    'qwerty1',
    'student3@ucmo.edu'
);

-- professor data
INSERT INTO `teacher`(
    
    `name`,
    `subject_id`,
    `mail`,
    `password`
)
VALUES(
  
    'Professor I',
    '5001',
    'professor1@ucmo.edu',
    'QWERTY'
);
INSERT INTO `teacher`(
    
    `name`,
    `subject_id`,
    `mail`,
    `password`
)
VALUES(
  
    'Professor II',
    '5003',
    'professor2@ucmo.edu',
    'QWERTY'
);
INSERT INTO `teacher`(
    
    `name`,
    `subject_id`,
    `mail`,
    `password`
)
VALUES(
  
    'Professor III',
    '5002',
    'professor3@ucmo.edu',
    'QWERTY'
);


