create database project_management;
use project_management;
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
model_name varchar(255),
model_no varchar(255),
created_at timestamp,
updated_at timestamp,
primary key (id)
)