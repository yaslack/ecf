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

DELETE FROM hotels
 WHERE manager IS NULL;



UPDATE account
set Priority = 2
where Email = 'First123@hotmail.com'

insert into hotels (Email) select 
Email from account;
delete FROM account where Email= "First123@hotmail.com"

SELECT Priority FROM account where Email= "First123@hotmail.com"