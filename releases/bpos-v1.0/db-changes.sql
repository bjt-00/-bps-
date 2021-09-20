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

