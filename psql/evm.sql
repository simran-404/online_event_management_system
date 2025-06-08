CREATE TABLE customer (
    user_id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contact VARCHAR(15) NOT NULL,
    gender VARCHAR(25) check(gender in ('male', 'female', 'others', 'prefer-not-to-say')),
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
create table login(login_id serial PRIMARY KEY, 
	username varchar (50)NOT NULL,
	password varchar(255) NOT NULL
);

create table package(
    package_id int GENERATED ALWAYS AS IDENTITY primary key, 
    name VARCHAR(100),
    price BIGINT
);
create table event(
    event_id int GENERATED ALWAYS AS IDENTITY primary key, 
    event_date date,
    start_time time, 
    end_time time, 
    location varchar(20), 
    venue varchar(30),
    package_id int references package(package_id) on delete cascade,
    user_id int references customer(user_id) on delete cascade
);
create table activity(
    activity_id int GENERATED ALWAYS AS IDENTITY primary key, 
    activity_name varchar(100), 
    event_id int references event(event_id) on delete cascade
);
create table decoration(
    decor_id int GENERATED ALWAYS AS IDENTITY primary key, 
    carpet varchar(30), curtain varchar(30), 
    tables int, 
    chairs int, 
    event_id int references event(event_id) on delete cascade
);
create table flower(
    flower_id int GENERATED ALWAYS AS IDENTITY primary key, 
    flower_name varchar(30),
    decor_id int references decoration(decor_id) on delete cascade
);
create table catering(
    cat_id int GENERATED ALWAYS AS IDENTITY primary key,
    food_preference varchar(20),
    event_id int references event(event_id) on delete cascade
);
create table transaction(
    trans_id int GENERATED ALWAYS AS IDENTITY primary key, 
    name varchar(100),
    card_type varchar(30),
    card_number varchar(255),
    cvv varchar(255), 
    exp_date varchar(30),
    event_id int references event(event_id) on delete cascade
);
create table feedback(
    feedback_id int GENERATED ALWAYS AS IDENTITY primary key, 
    email varchar(70), 
    username varchar(50), 
    comments varchar(500), 
    over_exp varchar(10) 
    check(over_exp in ('vg','g','b','p')), 
    time_resp varchar(10) check(time_resp in('vg','g','b','p')), 
    over_supp varchar(10) check(over_supp in('vg','g','b','p')), 
    over_satis varchar(10) check(over_satis in ('vg','g','b','p'))
);


/*Insert data in package table*/
INSERT INTO package (name, price) VALUES ('Budget', 50000);
INSERT INTO package (name, price) VALUES ('Premium', 100000);
INSERT INTO package (name, price) VALUES ('Luxury', 200000);
