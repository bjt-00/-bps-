# Sept-30-2021
DROP TABLE IF EXISTS DEFAULT_BILL;
CREATE TABLE IF NOT EXISTS `default_bill` (
  `bill_id` varchar(7) NOT NULL PRIMARY KEY,
  `total_sale` double NOT NULL,
  `currency` varchar(4) NOT NULL,
  `fee_unit` varchar(8) NOT NULL,
  `total_bill` double NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_type` varchar(8),
  `payment_transaction_id` varchar(15),
  `payment_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO c0ag_bill (
SELECT date_format(CURRENT_DATE-INTERVAL 1 MONTH,"%Y-%m") id 
,sum(total_amount) totalSale,currency,concat(round((1/100),2),' %') feeUnit,(sum(total_amount)*(1/100)) totalBill,
date_format(CURRENT_DATE,"%Y-%m-05") dueDate,date_format("1000-01-01","%Y-%m-%d") paymentDate,
0 paymentStatus
FROM c0ag_sale_transaction 
WHERE date_format(transaction_date_time,"%Y-%m") = date_format(CURRENT_DATE-INTERVAL 1 MONTH,"%Y-%m") 
GROUP BY currency,date_format(transaction_date_time,"%Y-%m")
);


# Sept-20-2021
ALTER TABLE `default_store` ADD `tax` DOUBLE NOT NULL DEFAULT '0.0' AFTER `store_phone`, ADD `tax_type` VARCHAR(5) NOT NULL DEFAULT '%' AFTER `tax`;

# October-14-2020
SELECT sum(total_amount) total_amount,sum(cash_recieved-balance) total_sale_amount,sum(total_amount-(cash_recieved-balance))  total_balance,currency,sale_outlet_id,user_id,date_format(transaction_date_time,"%M-%d-%Y") date
FROM `default_sale_transaction` 
group by currency,sale_outlet_id,user_id,date_format(transaction_date_time,"%M-%d-%Y")  
ORDER BY transaction_date_time  DESC;

#todays sale summary
SELECT sum(total_amount) total_amount,sum(cash_recieved-balance) total_sale_amount,sum(total_amount-(cash_recieved-balance))  total_balance,date_format(transaction_date_time,"%M-%d-%Y") date
FROM `default_sale_transaction` 
where date_format(transaction_date_time,"%M-%d-%Y") = date_format(CURRENT_DATE,"%M-%d-%Y")
group by currency,date_format(transaction_date_time,"%M-%d-%Y");

