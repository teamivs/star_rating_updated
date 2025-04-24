<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| ChatGPT API Configuration
| -------------------------------------------------------------------
|
| This file contains the configuration for the ChatGPT API integration.
|
*/

// Your OpenAI API key
$config['openai_api_key'] = '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'; // Hardcoded API key

if (empty($config['openai_api_key'])) {
    log_message('error', 'OpenAI API key is not set in environment variables');
}

// Default model to use
$config['default_model'] = 'gpt-3.5-turbo';

// Default parameters
$config['max_tokens'] = 150;
$config['temperature'] = 0.7; 