CREATE DATABASE  IF NOT EXISTS `cs2102` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cs2102`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: 127.0.0.1    Database: cs2102
-- ------------------------------------------------------
-- Server version	5.5.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accompanied_booking`
--

DROP TABLE IF EXISTS `accompanied_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accompanied_booking` (
  `PassportNumber` varchar(25) NOT NULL DEFAULT '',
  `ReferenceNo` int(11) NOT NULL,
  PRIMARY KEY (`PassportNumber`,`ReferenceNo`),
  KEY `ReferenceNo` (`ReferenceNo`),
  CONSTRAINT `accompanied_booking_ibfk_1` FOREIGN KEY (`PassportNumber`) REFERENCES `passenger` (`PassportNumber`),
  CONSTRAINT `accompanied_booking_ibfk_2` FOREIGN KEY (`ReferenceNo`) REFERENCES `booking` (`ReferenceNo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accompanied_booking`
--

LOCK TABLES `accompanied_booking` WRITE;
/*!40000 ALTER TABLE `accompanied_booking` DISABLE KEYS */;
INSERT INTO `accompanied_booking` VALUES ('E1234568',1),('EP10001',13),('E0000PR',19),('EP10001',19),('EP10003',19),('E10005',21);
/*!40000 ALTER TABLE `accompanied_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `username` varchar(250) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('admin','admin');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airline`
--

DROP TABLE IF EXISTS `airline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airline` (
  `IATACode` char(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `logo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`IATACode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airline`
--

LOCK TABLES `airline` WRITE;
/*!40000 ALTER TABLE `airline` DISABLE KEYS */;
INSERT INTO `airline` VALUES ('3K','Jetstar Asia','3k.png'),('SQ','Singapore Airlines','sq.png');
/*!40000 ALTER TABLE `airline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `ReferenceNo` int(11) NOT NULL AUTO_INCREMENT,
  `ContactNum` varchar(25) NOT NULL,
  `ContactEmail` varchar(25) NOT NULL,
  `PassportNumber` varchar(25) NOT NULL,
  PRIMARY KEY (`ReferenceNo`),
  KEY `fk_PassportNumber` (`PassportNumber`),
  CONSTRAINT `fk_PassportNumber` FOREIGN KEY (`PassportNumber`) REFERENCES `passenger` (`PassportNumber`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,'91234567','hello@goodbye.com','E1234567'),(6,'12345','email@mail.com','EP10001'),(7,'12345','email@mail.com','EP10001'),(8,'12345','email@mail.com','EP10002'),(9,'6123 6780','email2@mail.com','EP10002'),(10,'6123 6780','email2@mail.com','EP10002'),(11,'6123 6780','email2@mail.com','EP10002'),(12,'6123 6780','email2@mail.com','EP10002'),(13,'6123 6780','email2@mail.com','EP10002'),(14,'90034942','rey@nus.edu.sg','E0000PR'),(15,'90034942','rey@nus.edu.sg','E0000PR'),(17,'91234567','asdf@asdasd.das','E111111E'),(19,'90000000','llll@lll.com','EL01'),(21,'9001000','jim@lee.com','E10000');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flight` (
  `IATACode` char(10) NOT NULL DEFAULT '',
  `FlightNo` varchar(10) NOT NULL DEFAULT '',
  `DepartureTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ArrivalTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(25) NOT NULL,
  `destination` varchar(25) NOT NULL,
  PRIMARY KEY (`IATACode`,`FlightNo`,`DepartureTime`),
  CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`IATACode`) REFERENCES `airline` (`IATACode`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight`
--

LOCK TABLES `flight` WRITE;
/*!40000 ALTER TABLE `flight` DISABLE KEYS */;
INSERT INTO `flight` VALUES ('3K','555','2014-11-08 16:00:00','2014-11-08 18:00:00','Singapore','Ho Chi Minh City'),('SQ','123','2014-11-09 00:00:00','2014-11-09 02:00:00','Singapore','Ho Chi Minh City'),('SQ','880','2014-11-09 01:00:00','2014-11-09 04:15:00','Singapore','Hong Kong');
/*!40000 ALTER TABLE `flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `fullflightdetails`
--

DROP TABLE IF EXISTS `fullflightdetails`;
/*!50001 DROP VIEW IF EXISTS `fullflightdetails`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `fullflightdetails` AS SELECT 
 1 AS `IATACode`,
 1 AS `FlightNo`,
 1 AS `DepartureTime`,
 1 AS `ArrivalTime`,
 1 AS `source`,
 1 AS `destination`,
 1 AS `name`,
 1 AS `classType`,
 1 AS `price`,
 1 AS `seatCount`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `passenger`
--

DROP TABLE IF EXISTS `passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passenger` (
  `PassportNumber` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `DOB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PassportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger`
--

LOCK TABLES `passenger` WRITE;
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */;
INSERT INTO `passenger` VALUES ('E0000PR','Rey Neo','1991-08-22 16:00:00'),('E10000','Jim Lee','1990-12-31 16:00:00'),('E10005','Joe Lee','1989-12-31 16:00:00'),('E111111E','Tan Gu Gu','1989-12-31 16:00:00'),('E1234567','John Tan','1989-12-30 16:00:00'),('E1234568','Jane Tan','1990-12-29 16:00:00'),('edfd','Rey Neo','0000-00-00 00:00:00'),('EL01','Lily Lim Li Lee','1989-12-31 16:00:00'),('EP10001','Tan Ah Kow','1979-12-31 16:00:00'),('EP10002','Tan Ah Meow','1974-12-31 16:00:00'),('EP10003','Ho Lee Fuk','1980-12-31 16:00:00');
/*!40000 ALTER TABLE `passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seatsbooking`
--

DROP TABLE IF EXISTS `seatsbooking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seatsbooking` (
  `seatNo` varchar(10) NOT NULL,
  `ReferenceNo` int(11) NOT NULL,
  `classType` varchar(10) NOT NULL DEFAULT '',
  `IATACode` char(10) NOT NULL DEFAULT '',
  `FlightNo` varchar(10) NOT NULL DEFAULT '',
  `DepartureTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`,`seatNo`),
  KEY `IATACode` (`IATACode`,`FlightNo`,`DepartureTime`,`classType`),
  CONSTRAINT `seatsbooking_ibfk_1` FOREIGN KEY (`IATACode`, `FlightNo`, `DepartureTime`, `classType`) REFERENCES `seatstype` (`IATACode`, `FlightNo`, `DepartureTime`, `classType`),
  CONSTRAINT `seatsbooking_ibfk_2` FOREIGN KEY (`ReferenceNo`) REFERENCES `booking` (`ReferenceNo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seatsbooking`
--

LOCK TABLES `seatsbooking` WRITE;
/*!40000 ALTER TABLE `seatsbooking` DISABLE KEYS */;
INSERT INTO `seatsbooking` VALUES ('178',1,'Economy','3K','555','2014-11-08 16:00:00'),('179',1,'Economy','3K','555','2014-11-08 16:00:00'),('180',1,'Economy','3K','555','2014-11-08 16:00:00'),('177',7,'Economy','3K','555','2014-11-08 16:00:00'),('176',8,'Economy','3K','555','2014-11-08 16:00:00'),('174',21,'Economy','3K','555','2014-11-08 16:00:00'),('175',21,'Economy','3K','555','2014-11-08 16:00:00'),('299',13,'Economy','SQ','123','2014-11-09 00:00:00'),('300',13,'Economy','SQ','123','2014-11-09 00:00:00'),('298',14,'Economy','SQ','123','2014-11-09 00:00:00'),('297',15,'Economy','SQ','123','2014-11-09 00:00:00'),('296',17,'Economy','SQ','123','2014-11-09 00:00:00'),('32',19,'Business','SQ','880','2014-11-09 01:00:00'),('33',19,'Business','SQ','880','2014-11-09 01:00:00'),('34',19,'Business','SQ','880','2014-11-09 01:00:00'),('35',19,'Business','SQ','880','2014-11-09 01:00:00');
/*!40000 ALTER TABLE `seatsbooking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seatstype`
--

DROP TABLE IF EXISTS `seatstype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seatstype` (
  `classType` varchar(10) NOT NULL DEFAULT '',
  `IATACode` char(10) NOT NULL DEFAULT '',
  `FlightNo` varchar(10) NOT NULL DEFAULT '',
  `DepartureTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,0) DEFAULT NULL,
  `seatCount` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`classType`,`IATACode`,`FlightNo`,`DepartureTime`),
  KEY `IATACode` (`IATACode`,`FlightNo`,`DepartureTime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seatstype`
--

LOCK TABLES `seatstype` WRITE;
/*!40000 ALTER TABLE `seatstype` DISABLE KEYS */;
INSERT INTO `seatstype` VALUES ('Business','SQ','123','2014-11-09 00:00:00',500,30),('Business','SQ','880','2014-11-09 01:00:00',900,35),('Economy','3K','555','2014-11-08 16:00:00',58,180),('Economy','SQ','123','2014-11-09 00:00:00',150,300),('Economy','SQ','880','2014-11-09 01:00:00',320,300);
/*!40000 ALTER TABLE `seatstype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cs2102'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetAllAirlines` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllAirlines`()
BEGIN
   SELECT *  FROM Airline;
   END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetEmptySeats` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEmptySeats`(IN IATACODE_PARAM CHAR(10), IN FlightNo_PARAM VARCHAR(10), IN DepartureTime_PARAM Timestamp, IN ClassType_PARAM VARCHAR(10), OUT EmptySeats int)
BEGIN
 SET EmptySeats=
 (SELECT seatCount
 FROM seatstype
 WHERE IATACODE = IATACODE_PARAM
 AND FlightNo = FlightNo_PARAM             
 AND DepartureTime = DepartureTime_PARAM
 AND classType = ClassType_PARAM
 GROUP BY seatCount);
 
 SET EmptySeats= EmptySeats -
 (SELECT count(*)
 FROM seatsBooking
 WHERE IATACODE = IATACODE_PARAM
 AND FlightNo = FlightNo_PARAM
 AND DepartureTime = DepartureTime_PARAM
 AND classType = ClassType_PARAM);
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MakeBooking` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `MakeBooking`(IATACODE_PARAM varchar(10), 
FlightNo_PARAM VARCHAR(10), DepartureTime_PARAM TIMESTAMP, ClassType_PARAM VARCHAR(10), 
CNUM_PARAM varchar(25), CEMAIL_PARAM varchar(25), PN_PARAM varchar(25), NAME_PARAM varchar(25), 
DOB_PARAM TIMESTAMP)
BEGIN
DECLARE seatNumber int(11) default 0;
DECLARE referenceNum int(11) default 0;

#Check / Create Pax tuples
CALL NewPassenger(PN_PARAM, NAME_PARAM, DOB_PARAM);

#Create new Booking
INSERT INTO booking(`ContactNum`,`ContactEmail`,`PassportNumber`) VALUES (CNUM_PARAM, CEMAIL_PARAM, PN_PARAM);
SET referenceNum = LAST_INSERT_ID();

#Add to seat Booking
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MakeBookingForFour` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `MakeBookingForFour`(IATACODE_PARAM varchar(10), 
FlightNo_PARAM VARCHAR(10), DepartureTime_PARAM TIMESTAMP, ClassType_PARAM VARCHAR(10), 
CNUM_PARAM varchar(25), CEMAIL_PARAM varchar(25), PN_PARAM varchar(25), NAME_PARAM varchar(25), DOB_PARAM TIMESTAMP, 
PN_PARAM2 varchar(25), NAME_PARAM2 varchar(25), DOB_PARAM2 TIMESTAMP,
PN_PARAM3 varchar(25), NAME_PARAM3 varchar(25), DOB_PARAM3 TIMESTAMP,
PN_PARAM4 varchar(25), NAME_PARAM4 varchar(25), DOB_PARAM4 TIMESTAMP)
BEGIN
DECLARE seatNumber int(11) default 0;
DECLARE referenceNum int(11) default 0;

#Check / Create Pax tuples
CALL NewPassenger(PN_PARAM, NAME_PARAM, DOB_PARAM);
CALL NewPassenger(PN_PARAM2, NAME_PARAM2, DOB_PARAM2);
CALL NewPassenger(PN_PARAM3, NAME_PARAM3, DOB_PARAM3);
CALL NewPassenger(PN_PARAM4, NAME_PARAM4, DOB_PARAM4);

#Create new Booking
INSERT INTO booking(`ContactNum`,`ContactEmail`,`PassportNumber`) VALUES (CNUM_PARAM, CEMAIL_PARAM, PN_PARAM);
SET referenceNum = LAST_INSERT_ID();

#Person 1
#Add to seat Booking
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);

#Person 2
#Add to seat Booking & accompany table
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);
INSERT INTO accompanied_booking(`PassportNumber`,`ReferenceNo`) values (PN_PARAM2, referenceNum);

#Person 3
#Add to seat Booking & accompany table
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);
INSERT INTO accompanied_booking(`PassportNumber`,`ReferenceNo`) values (PN_PARAM3, referenceNum);

#Person 4
#Add to seat Booking & accompany table
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);
INSERT INTO accompanied_booking(`PassportNumber`,`ReferenceNo`) values (PN_PARAM4, referenceNum);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MakeBookingForThree` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `MakeBookingForThree`(IATACODE_PARAM varchar(10), 
FlightNo_PARAM VARCHAR(10), DepartureTime_PARAM TIMESTAMP, ClassType_PARAM VARCHAR(10), 
CNUM_PARAM varchar(25), CEMAIL_PARAM varchar(25), PN_PARAM varchar(25), NAME_PARAM varchar(25), DOB_PARAM TIMESTAMP, 
PN_PARAM2 varchar(25), NAME_PARAM2 varchar(25), DOB_PARAM2 TIMESTAMP,
PN_PARAM3 varchar(25), NAME_PARAM3 varchar(25), DOB_PARAM3 TIMESTAMP)
BEGIN
DECLARE seatNumber int(11) default 0;
DECLARE referenceNum int(11) default 0;

#Check / Create Pax tuples
CALL NewPassenger(PN_PARAM, NAME_PARAM, DOB_PARAM);
CALL NewPassenger(PN_PARAM2, NAME_PARAM2, DOB_PARAM2);
CALL NewPassenger(PN_PARAM3, NAME_PARAM3, DOB_PARAM3);

#Create new Booking
INSERT INTO booking(`ContactNum`,`ContactEmail`,`PassportNumber`) VALUES (CNUM_PARAM, CEMAIL_PARAM, PN_PARAM);
SET referenceNum = LAST_INSERT_ID();

#Person 1
#Add to seat Booking
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);

#Person 2
#Add to seat Booking & accompany table
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);
INSERT INTO accompanied_booking(`PassportNumber`,`ReferenceNo`) values (PN_PARAM2, referenceNum);

#Person 3
#Add to seat Booking & accompany table
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);
INSERT INTO accompanied_booking(`PassportNumber`,`ReferenceNo`) values (PN_PARAM3, referenceNum);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MakeBookingForTwo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `MakeBookingForTwo`(IATACODE_PARAM varchar(10), 
FlightNo_PARAM VARCHAR(10), DepartureTime_PARAM TIMESTAMP, ClassType_PARAM VARCHAR(10), 
CNUM_PARAM varchar(25), CEMAIL_PARAM varchar(25), PN_PARAM varchar(25), NAME_PARAM varchar(25), 
DOB_PARAM TIMESTAMP, PN_PARAM2 varchar(25), NAME_PARAM2 varchar(25), 
DOB_PARAM2 TIMESTAMP)
BEGIN
DECLARE seatNumber int(11) default 0;
DECLARE referenceNum int(11) default 0;

#Check / Create Pax tuples
CALL NewPassenger(PN_PARAM, NAME_PARAM, DOB_PARAM);
CALL NewPassenger(PN_PARAM2, NAME_PARAM2, DOB_PARAM2);

#Create new Booking
INSERT INTO booking(`ContactNum`,`ContactEmail`,`PassportNumber`) VALUES (CNUM_PARAM, CEMAIL_PARAM, PN_PARAM);
SET referenceNum = LAST_INSERT_ID();

#Person 1
#Add to seat Booking
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);

#Person 2
#Add to seat Booking & accompany table
CALL GetEmptySeats(IATACODE_PARAM,FlightNo_PARAM,DepartureTime_PARAM,ClassType_PARAM, seatNumber);
INSERT INTO seatsbooking(`seatNo`,`ReferenceNo`,`classType`,`IATACode`,`FlightNo`,`DepartureTime`) Values (seatNumber, referenceNum, ClassType_PARAM, IATACODE_PARAM, FlightNo_PARAM, DepartureTime_PARAM);
INSERT INTO accompanied_booking(`PassportNumber`,`ReferenceNo`) values (PN_PARAM2, referenceNum);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `NewPassenger` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `NewPassenger`(PN_PARAM varchar(25), NAME_PARAM varchar(25), DOB_PARAM TIMESTAMP)
BEGIN
#If passenger already exists, do nothing.
#Else If passenger exists, but details different, throw violation.
#Else add new passenger
INSERT INTO passenger(`PassportNumber`,`name`,`DOB`)
SELECT PN_PARAM, NAME_PARAM, DOB_PARAM FROM `passenger` 
WHERE NOT EXISTS (SELECT * FROM `passenger` 
      WHERE PassportNumber=PN_PARAM AND name=NAME_PARAM AND DOB = DOB_PARAM) 
LIMIT 1; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SearchFlights` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SearchFlights`(IN SOURCE_PARAM VARCHAR(25), IN DESTINATION_PARAM VARCHAR(25), IN DATE_PARAM CHAR(10), IN CLASS_PARAM VARCHAR(10))
BEGIN
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND classType = CLASS_PARAM;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SearchFlightsSorted` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SearchFlightsSorted`(IN SOURCE_PARAM VARCHAR(25), IN DESTINATION_PARAM VARCHAR(25), IN DATE_PARAM CHAR(10), IN CLASS_PARAM VARCHAR(10), IN SORTBY_PARAM VARCHAR(10), IN ORDER_PARAM CHAR(1))
BEGIN

CASE 
WHEN SORTBY_PARAM = 'FlightNo'
AND ORDER_PARAM = 'D'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY FlightNo DESC;
 
WHEN SORTBY_PARAM = 'FlightNo'
AND ORDER_PARAM = 'A'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY FlightNo ASC;

WHEN SORTBY_PARAM = 'DepartureTime'
AND ORDER_PARAM = 'D'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY FlightNo DESC;
 
WHEN SORTBY_PARAM = 'DepartureTime'
AND ORDER_PARAM = 'A'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY DepartureTime ASC;

WHEN SORTBY_PARAM = 'ArrivalTime'
AND ORDER_PARAM = 'D'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY DepartureTime DESC;
 
WHEN SORTBY_PARAM = 'ArrivalTime'
AND ORDER_PARAM = 'A'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY ArrivalTime ASC;

WHEN SORTBY_PARAM = 'price'
AND ORDER_PARAM = 'D'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY price DESC;
 
WHEN SORTBY_PARAM = 'price'
AND ORDER_PARAM = 'A'
THEN 
SELECT * FROM FullFlightDetails WHERE 
source LIKE SOURCE_PARAM AND destination LIKE DESTINATION_PARAM AND 
DepartureTime BETWEEN DATE_PARAM AND DATE_ADD(DATE_PARAM,INTERVAL 1 DAY) AND 
classType = CLASS_PARAM 
ORDER BY price ASC;

END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `fullflightdetails`
--

/*!50001 DROP VIEW IF EXISTS `fullflightdetails`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `fullflightdetails` AS select `flight`.`IATACode` AS `IATACode`,`flight`.`FlightNo` AS `FlightNo`,`flight`.`DepartureTime` AS `DepartureTime`,`flight`.`ArrivalTime` AS `ArrivalTime`,`flight`.`source` AS `source`,`flight`.`destination` AS `destination`,`airline`.`name` AS `name`,`seatstype`.`classType` AS `classType`,`seatstype`.`price` AS `price`,`seatstype`.`seatCount` AS `seatCount` from ((`flight` join `airline` on((`flight`.`IATACode` = `airline`.`IATACode`))) join `seatstype` on(((`seatstype`.`DepartureTime` = `flight`.`DepartureTime`) and (`seatstype`.`IATACode` = `flight`.`IATACode`) and (`seatstype`.`FlightNo` = `flight`.`FlightNo`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-07  2:10:15
