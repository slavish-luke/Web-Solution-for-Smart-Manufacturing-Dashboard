DROP TABLE IF EXISTS machine;

CREATE TABLE machine (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    operator_id int,
    note varchar(200),
    ison bool,
    img_address varchar(200),
    PRIMARY KEY (id),
    FOREIGN KEY (operator_id) REFERENCES account(id)
);

INSERT INTO machine (name, ison, img_address) VALUES ('CNC Machine', 1, 'https://swmachinetech.com/wp-content/uploads/2023/07/50365-15745388.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('3D Printer', 0, 'https://cdn.shopify.com/s/files/1/0606/0323/6501/files/M5C_50ae6ec8-0be9-4eeb-a701-9d66b777c1f8.jpg?v=1706062195');
INSERT INTO machine (name, operator_id, ison, img_address) VALUES ('Industrial Robot', 4, 1, 'https://builtin.com/sites/www.builtin.com/files/2023-11/industrial-robot.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Automated Guided Vehicle', 1, 'https://www.ssi-schaefer.com/resource/image/1480284/landscape_ratio16x9/800/450/9bcd448b4526d3c2d65b84eada4f7685/B08B6E31B1674E81DB9E77EA46943A0C/agv-collage-72dpi-web-1-jpg-dam-image-en-34266-.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Smart Conveyor System', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUuFon7nFZArJmKRIqxYp3ZKdlx6HQWFupaQ&s');
INSERT INTO machine (name, operator_id, ison, img_address) VALUES ('IoT Sensor Hub', 4, 1, 'https://www.iot-store.com.au/cdn/shop/products/rak-wireless-lora-iot-rak-wisnode-sensor-hub-modular-wireless-sensor-probe-38026879893740_1024x1024.jpg?v=1667081741');
INSERT INTO machine (name, operator_id, ison, img_address) VALUES ('Predictive Maintenance System', 4, 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0-qnrkW6AVa8imDYFQbxFJ7psz8wQZO3fVg&s');
INSERT INTO machine (name, ison, img_address) VALUES ('Automated Assembly Line', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPk8NNUWWhnd_4vfNqLEmM_uM1jyX80hPYjw&s');
INSERT INTO machine (name, ison, img_address) VALUES ('Quality Control Scanner', 1, 'https://www.qualitymag.com/ext/resources/InfoCenters/Faro/Topic-2/Editorial/QM-0122_Faro-Topic2_Editorial.jpg?t=1641506186&width=696');
INSERT INTO machine (name, ison, img_address) VALUES ('Energy Management System', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7PeBRjPsWZXXW6bdr33PMl_EKK0jqqOrF3g&amp;s');