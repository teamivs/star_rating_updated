-- Create keywords table
CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_keyword` (`category`, `keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add sample keywords for different categories
INSERT INTO `keywords` (`category`, `keyword`) VALUES
-- Service quality keywords
('service_quality', 'professional'),
('service_quality', 'efficient'),
('service_quality', 'attentive'),
('service_quality', 'knowledgeable'),
('service_quality', 'friendly'),
('service_quality', 'helpful'),
('service_quality', 'courteous'),
('service_quality', 'responsive'),

-- Product quality keywords
('product_quality', 'high quality'),
('product_quality', 'durable'),
('product_quality', 'reliable'),
('product_quality', 'excellent'),
('product_quality', 'premium'),
('product_quality', 'well-made'),
('product_quality', 'superior'),

-- Customer experience keywords
('customer_experience', 'satisfied'),
('customer_experience', 'pleased'),
('customer_experience', 'happy'),
('customer_experience', 'impressed'),
('customer_experience', 'delighted'),
('customer_experience', 'exceeded expectations'),
('customer_experience', 'great experience'),
('customer_experience', 'wonderful experience'),

-- Business-specific keywords (customize these for your business)
('business_specific', 'on-time'),
('business_specific', 'clean'),
('business_specific', 'organized'),
('business_specific', 'affordable'),
('business_specific', 'value for money'),
('business_specific', 'recommend'),
('business_specific', 'will return'),
('business_specific', 'highly recommend'); 