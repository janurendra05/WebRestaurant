create database restoran;

use restoran;

CREATE TABLE `kategori_menu` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`) VALUES
('IDK001', 'Appetizer'),
('IDK002', 'Seafood'),
('IDK003', 'Vegetables'),
('IDK004', 'Dessert'),
('IDK005', 'Drink');

CREATE TABLE `menu` (
  `id_menu` varchar(6) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga_menu` int(10) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `id_kategori` varchar(6) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga_menu`, `deskripsi`, `id_kategori`, `gambar`) VALUES
('IDM001', 'Artichoke Spinach Dip', 50000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK001', 'https://www.browneyedbaker.com/wp-content/uploads/2011/06/artichoke-spinach-dip-1-5251.jpg'),
('IDM002', 'Cheesy Pull-Apart Bread', 25000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK001', 'https://www.browneyedbaker.com/wp-content/uploads/2011/06/cheesy-bread-36-600.jpg'),
('IDM003', 'Fontina-Stuffed, Bacon-Wrapped Dates', 30000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK001', 'https://www.browneyedbaker.com/wp-content/uploads/2011/06/fontina-stuffed-bacon-wrapped-dates1.jpg'),
('IDM004', 'Homemade Restaurant-Style Salsa', 45000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK001', 'https://www.browneyedbaker.com/wp-content/uploads/2011/06/salsa-1-550.jpg'),
('IDM005', 'Hot Corn and Cheese Dip', 70000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK001', 'https://www.browneyedbaker.com/wp-content/uploads/2011/06/corn-dip-3-550.jpg'),

('IDM006', 'Prawn Pollichathu', 200000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK002', 'https://i.ndtvimg.com/i/2016-03/prawn-625_625x350_51457506268.jpg'),
('IDM007', 'Calamari Fritters', 150000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK002', 'https://i.ndtvimg.com/i/2016-03/calamari-fried-625_625x350_71457506458.jpg'),
('IDM008', 'Goan Crab Curry', 500000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK002', 'https://i.ndtvimg.com/i/2016-03/goan-crab-curry-625_625x350_61457506533.jpg'),
('IDM009', 'Mussels with Lemongrass', 230000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK002', 'https://i.ndtvimg.com/i/2016-03/mussels-625_625x350_81457506568.jpg'),
('IDM010', 'Lobster Malay Curry', 415000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK002', 'https://i.ndtvimg.com/i/2016-03/lobster-curry-625_625x350_81457506601.jpg'),

('IDM011', 'Baked Parmesan Zucchini', 415000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK003', 'https://s23209.pcdn.co/wp-content/uploads/2014/06/IMG_2270edit.jpg'),
('IDM012', 'Baked Parmesan Mushrooms', 415000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK003', 'https://s23209.pcdn.co/wp-content/uploads/2014/03/IMG_2289edit.jpg'),
('IDM013', 'Garlic Parmesan Roasted Potatoes', 415000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK003', 'https://s23209.pcdn.co/wp-content/uploads/2014/07/IMG_4381edit.jpg'),
('IDM014', 'Baked Green Bean Fries', 415000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK003', 'https://s23209.pcdn.co/wp-content/uploads/2014/12/IMG_4785edit.jpg'),
('IDM015', 'Honey Glazed Baby Carrots', 415000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK003', 'https://s23209.pcdn.co/wp-content/uploads/2013/11/IMG_8674edit.jpg'),

('IDM016', 'Apple Pie', 100000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK004', 'https://i.ndtvimg.com/i/2015-09/apple-pie-ice-cream-625_625x350_81443595158.jpg'),
('IDM017', 'Almond Malai Kulfi', 200000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK004', 'https://i.ndtvimg.com/i/2015-09/almond-kulfi-625_625x350_61443596643.jpg'),
('IDM018', 'Lemon Tart', 120000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK004', 'https://i.ndtvimg.com/i/2015-09/lemon-tart-625_625x350_61443595187.jpg'),
('IDM019', 'Pistachio Phirni', 124000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK004', 'https://i.ndtvimg.com/i/2015-09/pistachio-phirni-625_625x350_81443596823.jpg'),
('IDM020', 'Fudgy Chewy Brownies', 175000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK004', 'https://i.ndtvimg.com/i/2015-09/chocolate-brownies-625_625x350_81443599634.jpg'),

('IDM021', 'Old Fashioned', 75000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK005', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/old-fashioned-1592951230.jpg?crop=1xw:1xh;center,top&resize=980:*'),
('IDM022', 'Margarita', 50000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK005', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/margarita-1592951298.jpg?crop=1xw:1xh;center,top&resize=980:*'),
('IDM023', 'Cosmopolitan', 88500, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK005', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/cosmopolitan-1592951320.jpg?crop=1xw:1xh;center,top&resize=980:*'),
('IDM024', 'Negroni', 65000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK005', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/negroni-1592951342.jpg?crop=1xw:1xh;center,top&resize=980:*'),
('IDM025', 'Moscow Mule', 99000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'IDK005', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/moscow-mule-1592951361.jpg?crop=1xw:1xh;center,top&resize=980:*');

CREATE TABLE `order` (
  `id_menu` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `nama` int(11) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id_user` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id_user`, `username`, `first_name`, `last_name`, `email`, `tanggal_lahir`, `jenis_kelamin`, `password`) VALUES
('U00001', 'admin', 'admin', 'admin', 'admin@admin.com', '2000-10-10', 'L', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
('U97587', 'user', 'user', 'user', 'user@umn.ac.id', '0000-00-00', 'L', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08');

ALTER TABLE `kategori_menu`
ADD PRIMARY KEY (`id_kategori`);

ALTER TABLE `menu`
ADD PRIMARY KEY (`id_menu`),
ADD KEY `id_kategori` (`id_kategori`);

ALTER TABLE `order`
ADD KEY `id_menu` (`id_menu`);

ALTER TABLE `user`
ADD PRIMARY KEY (`id_user`);

ALTER TABLE `menu`
ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_menu` (`id_kategori`);

ALTER TABLE `order`
ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

COMMIT;

