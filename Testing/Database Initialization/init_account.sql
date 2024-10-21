DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(60) NOT NULL,
    name varchar(100) NOT NULL,
    email varchar(100),
    notes varchar(10000) DEFAULT '',
    role_id int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);

INSERT INTO account (username, password, name, email, role_id) VALUES ('JohnDoe', '$2y$10$poIZ.KsUOZomZRQGrjgOBuxcwFAvFjaX0QQ57qyhwYYSzaw2QJOpK', 'John Doe', 'johndoe@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JaneDoe', '$2y$10$nrQH7Ia3qk64dtYK77vq9OKvSG/2CM7.VRmaeBb54RGCqijXSG7LK', 'Jane Doe', 'janedoe@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('EthanCollins', '$2y$10$xwXDuWfyX52FmsX9B93EIeX8HHOycbQs6gWn4y/DEraycEqER9mL2', 'Ethan Collins', 'ethancollins@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('WallaceHunter', '$2y$10$XVHuBF2Pxk2nIMAqBfQbnel.UT8gb2JM6RwqxWGFkElYUOLJcgoM2', 'Wallace Hunter', 'wallacehunter@email.com', 4);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JeremySmith', '$2y$10$WKmIJomOYJxfcULnrVeMY.nKmjIkzIE/HWpUBQfeGARmKQtQCNZfK', 'Jeremy Smith', 'jeremysmith@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('SamuelHayes', '$2y$10$BJBU4bp6XRUgasCdwPXJv.XimAhGwYqvNmrc0Iy5X/2APosWnFT/q', 'Samuel Hayes', 'samuelhayes@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('ArthurBarker', '$2y$10$qA5i0sEOeGaOo0v5HzQis.ma0yDLjk4M8UYoPbRbSNplYXSKTnsJm', 'Arthur Barker', 'arthurbarkere@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('BillyMatthews', '$2y$10$mvIJyM178wAvKRmpAiwLu.CcTogJ3VpXVr6DYqMnp7yYhldpdOQo2', 'Billy Matthews', 'billymatthews@email.com', 4);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JayMills', '$2y$10$Gi4kK/QaGFC5eEP81y7nZ..ilu3s3w7HlFx3JeAURQ1HQl/7rUWbS', 'Jay Mills', 'jaymills@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('LoganPorter', '$2y$10$BnNh9fUSZvPq2hMeE/lS0OXfDKXH6/te8W.rWvnmRruvAOAemtqTm', 'Logan Porter', 'loganporter@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('GaugeNielsen', '$2y$10$qozhn0u26V6K0dUhzh965us8jqrmXPsjI.HCmHWRIJW.gqyvFvt/W', 'Gauge Nielsen', 'gaugenielsen@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JaylinBarr', '$2y$10$GXVQ9LNEu1aqml/mvfYnx.Lrw18GL5Y8oYYkc15uhqJwPYxXRtXcW', 'Jaylin Barr', 'jaylinbarr@email.com', 4);