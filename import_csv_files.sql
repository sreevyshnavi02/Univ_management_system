/* Converting filename to 8.3 format: D:\COE\Complete system\student.csv => D:\COE\Complete system\student.csv */

LOAD DATA LOW_PRIORITY LOCAL INFILE 'D:\\COE\\Complete system\\student.csv' 
REPLACE INTO TABLE `univ_trial_n_error`.`u_student` CHARACTER SET utf8 FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\r\n'
(`regno`, `password`, `sname`, `gender`, `dob`, @ColVar5, @ColVar7) 
SET `yoj` = REPLACE(REPLACE(@u_courseColVar5, ',', ''), '.', '.'), 
`prgm_id` = REPLACE(REPLACE(@ColVar7, ',', ''), '.', '.');


/* Converting filename to 8.3 format: D:\COE\Complete system\test_course.csv => D:\COE\Complete system\test_course.csv */
LOAD DATA LOW_PRIORITY LOCAL INFILE 
'D:\\COE\\Complete system\\courses.csv' 
REPLACE INTO TABLE `univ_trial_n_error`.`u_course` CHARACTER SET utf8 FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\r\n'
(`course_code`, `course_name`, `course_catg`, @ColVar3, `dept_id`, `course_type`) 
SET `credits` = REPLACE(REPLACE(@ColVar3, ',', ''), '.', '.');


/* Converting filename to 8.3 format: D:\COE\Complete system\prgm_comp_courses.csv => D:\COE\Complete system\prgm_comp_courses.csv */
LOAD DATA LOW_PRIORITY LOCAL INFILE 
'D:\\COE\\Complete system\\prgm_comp_courses.csv' 
REPLACE INTO TABLE `univ_trial_n_error`.`u_prgm_comp_course` CHARACTER SET LATIN1 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' ESCAPED BY '"' 
LINES TERMINATED BY '\r\n' (@ColVar0, `course_code`, @ColVar2) 
SET `prgm_id` = REPLACE(REPLACE(@ColVar0, ',', ''), '.', '.'), 
`sem` = REPLACE(REPLACE(@ColVar2, ',', ''), '.', '.');