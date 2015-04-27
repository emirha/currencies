SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE `currenciesCountry` (
  `country` varchar(3) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `totalBought` decimal(15,2) NOT NULL DEFAULT '0.00',
  `totalSold` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `currenciesTotals` (
  `currency` varchar(3) NOT NULL,
  `totalSold` decimal(15,2) NOT NULL,
  `totalBought` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `messages` (
`id` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `currencyFrom` varchar(3) NOT NULL,
  `currencyTo` varchar(3) NOT NULL,
  `amountSell` decimal(10,2) NOT NULL,
  `amountBuy` decimal(10,2) NOT NULL,
  `rate` double NOT NULL,
  `timePlaced` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `originatingCountry` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1980 DEFAULT CHARSET=utf8;
DELIMITER //
CREATE TRIGGER `messages_ad` AFTER DELETE ON `messages`
 FOR EACH ROW BEGIN

INSERT INTO `currenciesTotals` SET
              `currency` = OLD.`currencyFrom`,
              `totalSold` = OLD.`amountSell`
              
              ON DUPLICATE KEY
              UPDATE
              
              `totalSold` = `totalSold` - OLD.`amountSell`;
              
              
INSERT INTO `currenciesTotals` SET
              `currency` = OLD.`currencyTo`,
              `totalBought` = OLD.`amountBuy`
              
              ON DUPLICATE KEY
              UPDATE
              
              `totalBought` = `totalBought` - OLD.`amountBuy`;

END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `messages_ai` AFTER INSERT ON `messages`
 FOR EACH ROW BEGIN

INSERT INTO `currenciesTotals` SET
              `currency` = NEW.`currencyFrom`,
              `totalSold` = NEW.`amountSell`
              
              ON DUPLICATE KEY
              UPDATE
              
              `totalSold` = `totalSold` + NEW.`amountSell`;
              
              
INSERT INTO `currenciesTotals` SET
              `currency` = NEW.`currencyTo`,
              `totalBought` = NEW.`amountBuy`
              
              ON DUPLICATE KEY
              UPDATE
              
              `totalBought` = `totalBought` + NEW.`amountBuy`;
              
              
INSERT INTO `currenciesCountry` SET
   			`country` = NEW.originatingCountry,
            `currency` = NEW.currencyFrom,
            `totalSold`  = NEW.amountSell
            
            ON DUPLICATE KEY
              UPDATE
              
               `totalSold`  =  `totalSold` + NEW.amountSell;
               
               
               
INSERT INTO `currenciesCountry` SET
   			`country` = NEW.originatingCountry,
            `currency` = NEW.currencyFrom,
            `totalBought`  = NEW.amountBuy
            
            ON DUPLICATE KEY
              UPDATE
              
               `totalBought`  =  `totalBought` + NEW.amountBuy;
              

END
//
DELIMITER ;


ALTER TABLE `currenciesCountry`
 ADD PRIMARY KEY (`country`,`currency`);

ALTER TABLE `currenciesTotals`
 ADD PRIMARY KEY (`currency`);

ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1980;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
