
--July , 26th 2020 changes

DROP TABLE IF EXISTS `default_store`;
CREATE TABLE IF NOT EXISTS `default_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(10) NOT NULL,
  `store_address` varchar(50) NOT NULL,
  `store_phone` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`store_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



INSERT INTO `default_store` (`store_id`, `company_id`, `store_address`, `store_phone`, `is_active`) VALUES
(1, 'C0DC', 'Savoy Arcade F-11 Markaz, Islamabad,Pakistan', '0332-566-5114', 1);

alter table default_store add FOREIGN KEY (company_id) REFERENCES default_company(company_id);
alter table default_user add FOREIGN KEY (store_id) REFERENCES default_store(store_id);