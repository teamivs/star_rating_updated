-- Add is_bot column to comments table if it doesn't exist
ALTER TABLE `comments` ADD COLUMN IF NOT EXISTS `is_bot` TINYINT(1) NOT NULL DEFAULT 0;
 
-- Add created_at column if it doesn't exist
ALTER TABLE `comments` ADD COLUMN IF NOT EXISTS `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP; 