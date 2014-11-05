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
  `ReferenceNo` varchar(25) NOT NULL DEFAULT '',
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
INSERT INTO `accompanied_booking` VALUES ('E1234568','1');
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
  `ReferenceNo` varchar(25) NOT NULL,
  `ContactNum` varchar(25) NOT NULL,
  `ContactEmail` varchar(25) NOT NULL,
  `PassportNumber` varchar(25) NOT NULL,
  PRIMARY KEY (`ReferenceNo`),
  KEY `fk_PassportNumber` (`PassportNumber`),
  CONSTRAINT `fk_PassportNumber` FOREIGN KEY (`PassportNumber`) REFERENCES `passenger` (`PassportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES ('1','91234567','hello@goodbye.com','E1234567');
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
  `DepartureTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
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
INSERT INTO `passenger` VALUES ('E1234567','John Tan','1989-12-30 16:00:00'),('E1234568','Jane Tan','1990-12-29 16:00:00');
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
  `ReferenceNo` varchar(25) NOT NULL DEFAULT '',
  `classType` varchar(10) NOT NULL DEFAULT '',
  `IATACode` char(10) NOT NULL DEFAULT '',
  `FlightNo` varchar(10) NOT NULL DEFAULT '',
  `DepartureTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
INSERT INTO `seatsbooking` VALUES ('179','1','Economy','3K','555','2014-11-08 16:00:00'),('180','1','Economy','3K','555','2014-11-08 16:00:00');
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEmptySeats`(IN IATACODE_PARAM CHAR(10), IN FlightNo_PARAM VARCHAR(10), IN DepartureTime_PARAM Timestamp, IN ClassType_PARAM VARCHAR(10))
BEGIN
 SELECT st.seatCount - COUNT(*) as EmptySeats
 FROM SeatsBooking sb INNER JOIN seatstype st
 WHERE sb.IATACODE = IATACODE_PARAM
 AND st.IATACODE = IATACODE_PARAM
 AND st.FlightNo = FlightNo_PARAM
 AND sb.FlightNo = FlightNo_PARAM
 AND st.DepartureTime = DepartureTime_PARAM
 AND sb.DepartureTime = DepartureTime_PARAM
 AND st.classType = ClassType_PARAM
 AND sb.classType = ClassType_PARAM
 GROUP BY st.seatCount;
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

-- Dump completed on 2014-11-05 16:56:48
