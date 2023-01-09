DROP DATABASE univ_trial_n_error;

CREATE DATABASE univ_trial_n_error;

USE univ_trial_n_error;

-- password to allow the hod to view the dept data - data of students, courses, faculty and to update certain fields
create table u_dept(
    dept_id varchar(5) PRIMARY KEY,
    password varchar(20),
    dept_name varchar(100) NOT null
);

create table u_prgm(
    prgm_id float(2, 0) PRIMARY key,
    dept_id varchar(5),
    constraint fk_dept_id foreign key(dept_id) references u_dept(dept_id),
    prgm_name varchar(100)
);

-- a prgm cannot be continued when the dept is closed, so cascade delete
alter table u_prgm
drop constraint fk_dept_id;

alter table u_prgm
add constraint fk_dept_id foreign key(dept_id) 
references u_dept(dept_id) on delete CASCADE;


create table u_course(
    course_code varchar(10) PRIMARY KEY,
    course_name VARCHAR(200),
    course_catg varchar(5),
    -- prereq varchar(10),
    -- constraint fk_prereq foreign key(prereq) references u_course(course_code),
    credits float(3, 2),
    dept_id varchar(5),
    foreign key(dept_id) references u_dept(dept_id)
);



alter table u_course
add course_type varchar(20);


-- compulsory courses part of each programme
create table u_prgm_comp_course(    
    prgm_id float(2, 0),
    constraint fk_prgm_id foreign key(prgm_id) references u_prgm(prgm_id),
    course_code varchar(10),
    constraint fk_course_code foreign key(course_code) references u_course(course_code),
    sem int
);

-- elective courses part of each programme

-- includes open elective for other dept students + prgm elective offered within the dept
create table u_prgm_elective_course(
    prgm_id float(2, 0),
    constraint fk_prgm_id2 foreign key(prgm_id) references u_prgm(prgm_id),
    course_code varchar(10),
    constraint fk_course_code2 foreign key(course_code) references u_course(course_code),
    sem int, 
    academic_yr_start float(4, 0),
    academic_yr_end float(4, 0)
);

alter table u_prgm_elective_course
add offered varchar(5),
add being_run varchar(5),
add no_of_students float;


create table u_faculty(
    faculty_id varchar(10) PRIMARY key,
    password varchar(10),
    fname varchar(40),
    dept_id varchar(5),
    constraint fk_dept_id2 foreign key(dept_id) references u_dept(dept_id),
    designation varchar(50)
);



alter table u_faculty
add email varchar(100);


create table u_student(
    regno varchar(10) PRIMARY key,
    password varchar(10),
    sname VARCHAR(100),
    gender char,
    dob VARCHAR(15),
    yoj float(4, 0),
    credits_earned float(5, 2),
    prgm_id float(2, 0),
    constraint fk_prgm_id3 foreign key(prgm_id) references u_prgm(prgm_id)
    -- guide_id varchar(10),  -- for a PhD student 
    -- constraint fk_guide_id foreign key(guide_id) references u_faculty(faculty_id)
);


alter table U_STUDENT
add curr_sem INT;


alter table u_student
add history_of_arrear int check (history_of_arrear IN (0, 1));	-- 0- no arrear, 1- yes(had an arrear)

-- current backlogs which haven't been cleared yet
ALTER TABLE u_student
add backlogs int check (backlogs IN (0, 1));

alter table u_student
add email varchar(100) unique;

alter table u_student
add active float;


create table u_gpa_cgpa(
    regno varchar(10),
    constraint fk_regno2 foreign key(regno) references u_student(regno),
    sem float,
    gpa float(4, 2),
    cgpa float(4, 2)
);

alter table u_gpa_cgpa
add num_of_credits_earned float(4, 1); -- to store the float of credits earned in that semester alone


create table u_course_regn(
    regno varchar(10),
    constraint fk_regno foreign key(regno) references u_student(regno),
    course_code varchar(10),
    constraint fk_course_code3 foreign key(course_code) references u_course(course_code),
    sem float,
    internal_marks float(3, 1),
    constraint check_int_marks check(internal_marks <= 40),
    attendance float(4, 1),
    constraint check_attendance check(attendance <= 100),
    faculty_id varchar(10),
    constraint fk_faculty_id foreign key(faculty_id) references u_faculty(faculty_id),
    session VARCHAR(5),
    primary KEY (regno, course_code, sem, session)
);


-- create table course_offering(
--     course_code varchar(10),
--     constraint fk_course_code4 foreign key(course_code) references u_course(course_code),
--     dept_id varchar(5),
--     constraint fk_dept_id1 foreign key(dept_id) references u_dept(dept_id),
--     faculty_id varchar(10),
--     constraint fk_faculty_id1 foreign key(faculty_id) references u_faculty(faculty_id)
-- );


-- alter table course_offering
-- ADD primary key (course_code, dept_id, faculty_id);




create table u_external_marks(
    regno varchar(10),
    constraint fk_regno1 foreign key(regno) references u_student(regno),
    course_code varchar(10),
    constraint fk_course_code1 foreign key(course_code) references u_course(course_code),
    external_marks float(3, 1),
    constraint check_ext_marks check(external_marks <= 60)
);

alter table u_external_marks add grade char;

alter table u_external_marks add constraint check_grade check (grade in ('S', 'A', 'B', 'C', 'D', 'E', 'F', 'Z'));
alter table u_external_marks add gradept float;
alter table u_external_marks add constraint check_gradept check(gradept  in (10, 9, 8, 7, 6, 5, 0));

alter table u_external_marks
ADD SESSION VARCHAR(5);

alter table u_external_marks
add primary key(regno, course_code, session); 
-- 1 - active; 0 - inactive



-- To be written
create table u_administration(
    -- includes COE, Dean Academics, etc
    f_id varchar(10),
    constraint fk_fid foreign key(f_id) references u_faculty(faculty_id),
    position varchar(30), -- eg. COE, Dean Academics
    username varchar(20),
    password varchar(20)
);


-- a temporary purpose table used before allotting courses
create table u_hm_preregistration(
    regno varchar(10),
    constraint fk_regno4 foreign key(regno) references u_student(regno),
    opt1_prgm_id float,
    constraint fk_prgm_id_hm1 foreign key(opt1_prgm_id) references u_prgm(prgm_id),
    opt2_prgm_id float,
    constraint fk_prgm_id_hm2 foreign key(opt2_prgm_id) references u_prgm(prgm_id),
    opt3_prgm_id float,
    constraint fk_prgm_id_hm3 foreign key(opt3_prgm_id) references u_prgm(prgm_id)
);


alter table u_hm_preregistration
add cgpa float(4, 2);


create table academic_calendar(
    sem INT PRIMARY key,
    sem_begin date,
    course_regn_begin date,
    course_regn_close date, -- and 0th class committee meeting

    first_test_begin date,
    first_test_end date,
    first_test_eval date,

    
    second_test_begin date,
    second_test_end date,
    second_test_eval date,
    
    third_test_begin date,
    third_test_end date,
    
    model_prac_begin date,
    model_prac_end date,
    exam_regn_begin date,
    last_working_day date,  -- internal marks consolidation and publication

    sem_prac_begin date,
    sem_prac_end date,

    sem_theory_begin date,
    sem_theory_end date,

    vacation_begin date,
    vacation_end date
);


create table u_exam_regn(
	regno varchar(10),
	constraint fk_regno5 foreign key(regno) references u_student(regno),
	session varchar(5),
	consolidated_attendance float,
	transaction_id varchar(30)
);


ALTER TABLE u_exam_regn
ADD eligible_for_exam INT; -- 0 - NO, 1 - yesu_exam_regn


alter table u_exam_regn
add constraint pk_u_exam_regn primary key(regno, session);