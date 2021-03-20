insert into restau_el_hamri_db.city (name, zipcode) values  ( 'marrakech', '13266');
insert into restau_el_hamri_db.city (name, zipcode)  values ('agadir', '14449');
insert into restau_el_hamri_db.city (name, zipcode) values  ('rabat', '17776');
insert into restau_el_hamri_db.city (name, zipcode) values ('tanger', '16666');
insert into restau_el_hamri_db.city (name, zipcode) values ( 'asafi', '13233');
insert into restau_el_hamri_db.city (name, zipcode) values ('zagora', '14444');
insert into restau_el_hamri_db.city (name, zipcode) values ('ouarzazat', '12233');
insert into restau_el_hamri_db.city (name, zipcode) values ('casablanca', '16666');

INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto1', 'desc1',2);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto2', 'desc2',  2);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto3', 'desc3',  1);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto4', 'desc4',  6);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto5', 'desc5',2);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto6', 'desc6',  5);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto7', 'desc7',  3);
INSERT INTO restau_el_hamri_db.restaurant ( name, description, city_id_id) VALUES ( 'resto8', 'desc8',  7);

INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture1', 1);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture2', 2);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture3', 3);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture4', 4);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture1', 5);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture2', 6);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture3', 7);
INSERT INTO restau_el_hamri_db.restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture4', 8);

INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user1', 'user1', 1);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user2', 'user2', 2);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user3', 'user3', 3);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user4', 'user4', 4);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user5', 'user5', 5);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user6', 'user6', 6);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user7', 'user7', 7);
INSERT INTO restau_el_hamri_db.user ( username, password, city_id_id) VALUES ( 'user8', 'user8', 8);

INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message1', 3, 1, 2);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message2', 4, 6, 7);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message3', 5, 2, 6);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message4', 2, 3, 5);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message5', 3, 4, 3);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message6', 4, 5, 8);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message7', 5, 7, 6);
INSERT INTO restau_el_hamri_db.review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message8', 2, 8, 1) ;


