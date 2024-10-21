DROP TABLE IF EXISTS machine;

CREATE TABLE machine (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    img_address varchar(200),
    operator_id int,
    note varchar(200),
    temperature decimal(4, 2),
    pressure decimal(4, 2),
    vibration decimal(3, 2),
    humidity decimal(4, 2),
    power_consumption decimal(5, 2),
    operational_status varchar(20),
    error_code char(4),
    production_count int(3),
    maintenance_log varchar(20),
    speed decimal(3, 2),
    PRIMARY KEY (id),
    FOREIGN KEY (operator_id) REFERENCES account(id)
);

INSERT INTO machine VALUES (DEFAULT, 'CNC Machine', 'https://swmachinetech.com/wp-content/uploads/2023/07/50365-15745388.jpg', NULL, NULL, 64.52, 5.91, 3.92, 49.64, 479.27, 'active', NULL, 27, NULL, 4.21);
INSERT INTO machine VALUES (DEFAULT, '3D Printer', 'https://cdn.shopify.com/s/files/1/0606/0323/6501/files/M5C_50ae6ec8-0be9-4eeb-a701-9d66b777c1f8.jpg?v=1706062195', NULL, NULL, 25.77, 7.7, 4.36, 51.27, 356.01, 'active', NULL, 1, NULL, 0.92);
INSERT INTO machine VALUES (DEFAULT, 'Industrial Robot', 'https://builtin.com/sites/www.builtin.com/files/2023-11/industrial-robot.jpg', 4, NULL, 35.75, 8.63, 0.29, 34.68, 448.98, 'active', NULL, 48, NULL, 4.93);
INSERT INTO machine VALUES (DEFAULT, 'Automated Guided Vehicle', 'https://www.ssi-schaefer.com/resource/image/1480284/landscape_ratio16x9/800/450/9bcd448b4526d3c2d65b84eada4f7685/B08B6E31B1674E81DB9E77EA46943A0C/agv-collage-72dpi-web-1-jpg-dam-image-en-34266-.jpg', NULL, NULL, 67.52, 5.44, 1.36, 54.18, 289.84, 'active', NULL, 2, NULL, NULL);
INSERT INTO machine VALUES (DEFAULT, 'Smart Conveyor System', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUuFon7nFZArJmKRIqxYp3ZKdlx6HQWFupaQ&s', NULL, NULL, 37.23, 9.43, 2.57, 40.57, 228.89, 'active', NULL, 46, NULL, 3.33);
INSERT INTO machine VALUES (DEFAULT, 'IoT Sensor Hub', 'https://www.iot-store.com.au/cdn/shop/products/rak-wireless-lora-iot-rak-wisnode-sensor-hub-modular-wireless-sensor-probe-38026879893740_1024x1024.jpg?v=1667081741', 4, NULL, 26.39, 7.52, 3.4, 60.46, 315.16, 'maintenance', 'E101', 51, 'Routine Check', NULL);
INSERT INTO machine VALUES (DEFAULT, 'Predictive Maintenance System', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0-qnrkW6AVa8imDYFQbxFJ7psz8wQZO3fVg&s', 4, NULL, 73.31, 8.23, 3.27, 43.85, 418.06, 'active', NULL, 77, NULL, NULL);
INSERT INTO machine VALUES (DEFAULT, 'Automated Assembly Line', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPk8NNUWWhnd_4vfNqLEmM_uM1jyX80hPYjw&s', NULL, NULL, 21.79, 3.51, 2.92, 36.99, 410.16, 'active', NULL, 48, NULL, NULL);
INSERT INTO machine VALUES (DEFAULT, 'Quality Control Scanner', 'https://www.qualitymag.com/ext/resources/InfoCenters/Faro/Topic-2/Editorial/QM-0122_Faro-Topic2_Editorial.jpg?t=1641506186&width=696', NULL, NULL, 51.77, 6.53, 1.48, 47.89, 446.91, 'active', NULL, 17, NULL, NULL);
INSERT INTO machine VALUES (DEFAULT, 'Energy Management System', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7PeBRjPsWZXXW6bdr33PMl_EKK0jqqOrF3g&amp;s', NULL, NULL, 58.31, 3.93, 3.45, 44.24, 137.02, 'active', NULL, 36, NULL, NULL);