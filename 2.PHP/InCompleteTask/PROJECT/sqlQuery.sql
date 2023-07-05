create database projectNewManagement;
use projectNewManagement;
create table projects(
id int auto_increment,
project_name varchar(255),
primary key(id),
created_at timestamp,
updated_at timestamp
);

create table tasks(
id int auto_increment,
task_name varchar(255),
task_description varchar(255),
project_id int,
delete_at timestamp null,
created_at timestamp,
updated_at timestamp,
PRIMARY key  (id),
foreign key (project_id) references projects(id)
);

create table images(
id int auto_increment,
img_path varchar(255),
model_name int,
model_no int,
created_at timestamp,
updated_at timestamp,
primary key (id),
foreign key (model_no) references mastertable(id)
);

create table mastertable(
id int auto_increment,
type varchar(255),
primary key  (id)
);