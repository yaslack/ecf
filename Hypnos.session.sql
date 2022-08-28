create table ACCOUNT
(
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(50),
    Password VARCHAR(50)
)


select `order` from hotels where Email = "a@a";

select * From hotels
select * From account

UPDATE hotels
set `order` = `order`-1
where `order` > 2 

select Max(`order`) from hotels


ALTER TABLE hotels AUTO_INCREMENT = 5;

alter TABLE hotels
ADD COLUMN Email VARCHAR(50)

ALTER TABLE hotels ADD `order` INT PRIMARY KEY AUTO_INCREMENT FIRST


alter TABLE hotels
drop COLUMN `order`

DELETE FROM account
where Email= "a@a"



UPDATE account
set Priority = 2
where Email = 'First123@hotmail.com'

insert into hotels (Email) select 
Email from account;


SELECT Priority FROM account where Email= "First123@hotmail.com"

select * from hotels

SELECT `order` FROM hotels where HotelName= "Carliona"

create table Reservation
(
    Email VARCHAR(50) ,
    HotelNum int,
    Room VARCHAR(50),
    Date VARCHAR(50)
)

select * from Reservation

DROP TABLE Reservation

Insert into Reservation
Values ("First123@hotmail.com",1,"room2","26/08/2022:28/08/2022")

Insert into Reservation
Values ("First123@hotmail.com",1,"room2","14/09/2022:17/09/2022")


select Date from reservation where HotelNum = 1 and room = "room1"