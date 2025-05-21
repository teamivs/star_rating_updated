<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| ChatGPT API Configuration
| -------------------------------------------------------------------
|
| This file contains the configuration for the ChatGPT API integration.
|
| To get your API key:
| 1. Go to https://platform.openai.com/account/api-keys
| 2. Create a new API key (it should start with sk-proj-)
| 3. Replace the value below with your API key
|
| Note: The API key must start with 'sk-proj-' followed by at least 32 characters
|
*/

// Your OpenAI API key - Replace this with your actual sk-proj API key
$config['openai_api_key'] = getenv('OPENAI_API_KEY');

if (empty($config['openai_api_key']) || $config['openai_api_key'] === 'sk-proj-YOUR_API_KEY_HERE') {
    log_message('error', 'OpenAI API key is not set or is using the default value');
}

// Default model to use
$config['default_model'] = '';

// Default parameters
$config['max_tokens'] = 500;
$config['temperature'] = 0.7;
