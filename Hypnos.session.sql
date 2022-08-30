CREATE TABLE Reservation (
  `Email` varchar(50) DEFAULT NULL,
  `HotelNum` int DEFAULT NULL,
  `Room` varchar(50) DEFAULT NULL,
  `Date` varchar(50) DEFAULT NULL
)

INSERT INTO `reservation` (`Email`, `HotelNum`, `Room`, `Date`) VALUES
('First123@hotmail.com', 1, 'room1', '24/08/2022:26/08/2022'),
('First123@hotmail.com', 1, 'room1', '27/08/2022:30/08/2022'),
('First123@hotmail.com', 1, 'room2', '26/08/2022:28/08/2022'),
('First123@hotmail.com', 1, 'room2', '02/09/2022:05/09/2022'),
('First123@hotmail.com', 1, 'room2', '08/09/2022:10/09/2022'),
('First123@hotmail.com', 1, 'room2', '14/09/2022:17/09/2022');

CREATE TABLE hotels (
  `order` int NOT NULL,
  `manager` varchar(50) DEFAULT NULL,
  `HotelName` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
)

INSERT INTO `hotels` (`order`, `manager`, `HotelName`, `description`, `adress`, `city`, `Email`) VALUES
(1, 'Albert Smith', 'Carliona', 'Pharetra massa massa ultricies mi. Ultrices vitae auctor eu augue ut lectus arcu bibendum at. Suscipit tellus mauris a diam maecenas sed enim. Faucibus nisl tincidunt eget nullam non nisi est sit amet. Tincidunt eget nullam non ni', '75 Street Tarzone', 'Arizona', 'a@a'),
(2, 'Vaner Yon', 'Sceliora', 'Pharetra massa massa ultricies mi. Ultrices vitae auctor eu augue ut lectus arcu bibendum at. Suscipit tellus mauris a diam maecenas sed enim. Faucibus nisl tincidunt eget nullam non nisi est sit amet. Tincidunt eget nullam non ni', '13 Street Azeni', 'California', 'b@b');

CREATE TABLE `account` (
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Priority` int DEFAULT NULL
)

INSERT INTO `account` (`FirstName`, `LastName`, `Email`, `Password`, `Priority`) VALUES
('Roger', 'Arie', 'First123@hotmail.com', '2yT/9zz5emU0I', 2),
('Albert', 'Smith', 'a@a', '2yT/9zz5emU0I', 1),
('Vaner', 'Yon', 'b@b', '2yT/9zz5emU0I', 1);

select * from reservation where EMAIL = "First123@hotmail.com"
SELECT * from reservation where (HotelNum,Room,Date) in ((1,"room1","24/08/2022:26/08/2022"))