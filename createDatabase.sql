/* 
DROP DATABASE BTZDatabase;
DROP TABLE TargetProperty;
DROP TABLE AdminAndAgent;
DROP TABLE UserT;
DROP TABLE Role;
DROP TABLE Property;
DROP TABLE PropertyType;
DROP TABLE BuildingType;
DROP TABLE SaleOrRent;
DROP TABLE Ownership;
*/

CREATE DATABASE BTZDatabase;

USE BTZDatabase;

/*DROP TABLE Agent;
DROP TABLE User;
DROP TABLE TargetProperty;*/

CREATE TABLE TargetProperty
(
    TargetPropertyID INT(10) NOT NULL PRIMARY KEY,
    PreferLocationAddress VARCHAR(50),
    PreferLocationCity VARCHAR(25),
    PreferLocationProvince VARCHAR(25),
    PreferLocationPostalCode VARCHAR(6),
    TargetPropertyType VARCHAR(25),
    SaleOrRent VARCHAR(25),
    LowerPriceLimit DOUBLE(10,2),
    UpperPriceLimit DOUBLE(10,2),
    ListedSince DATE,
    NumberOfBedrooms INT(10),
    NumberOfWashrooms INT(10),
    OpenHouseOnly BOOLEAN
);


CREATE TABLE User
(
    UserID INT(10) NOT NULL PRIMARY KEY,
    Email VARCHAR(50) NOT NULL,
    Password BINARY(50) NOT NULL,
    FirstName VARCHAR(25) NOT NULL,
    LastName VARCHAR(25) NOT NULL,
    Role VARCHAR(25) NOT NULL,
    Address VARCHAR(50),
    City VARCHAR(25),
    Province VARCHAR(25),
    PostalCode VARCHAR(6),
    PhoneNumber VARCHAR(10),
    TargerPropertyID INT(10) NOT NULL,
    CONSTRAINT targetPropertyFK
        FOREIGN KEY (TargerPropertyID)
        REFERENCES TargetProperty(TargetPropertyID)
);

CREATE TABLE Agent
(
    AgentID INT(10) NOT NULL PRIMARY KEY,
    YearOfExperience INT(3) NOT NULL,
    UserID INT(10) NOT NULL,
    CONSTRAINT userIDFK
        FOREIGN KEY (UserID)
        REFERENCES User(UserID)
);
INSERT INTO TargetProperty VALUES(
    1,
    'PreferLocationAddress',
    'PreferLocationCity',
    'PreferLocationProvince',
    'F8K5U9',
    'TargetPropertyType',
    'SaleOrRent',
    50000,
    80000,
    '2018-12-31',
    3,
    2,
    True
);

INSERT INTO User VALUES(
    1,
    'abc@gmail.com',
    'hhh', 
    'fn',
    'ln',
    'visitor',
    '123 drive',
    'kitchener',
    'ON',
    'N2R4P1',
    '1234567890',
    1 
);
INSERT INTO User VALUES( 
    2,
    'abc@gmail.com',
    'sss', 
    'fna',
    'lna',
    'Admin',
    '1 drive',
    'Toronto',
    'ON',
    'N9D9A2',
    '0987654321',
    1 
);
INSERT INTO Agent VALUES(
    1,
    5,
    2
);