<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChatGpt
{
    private $api_key;
    private $api_url = 'https://api.openai.com/v1/chat/completions';
    private $company_info;

    public function __construct()
    {
        $CI = &get_instance();

        // Load required files
        $CI->load->config('chatgpt');
        $CI->load->model('Company_model');

        // Get API key from config
        $this->api_key = $CI->config->item('openai_api_key');

        if (empty($this->api_key)) {
            log_message('error', 'OpenAI API key is not set in configuration');
            throw new Exception('OpenAI API key is not configured');
        }

        // Validate API key format
        if (!preg_match('/^sk-proj-[a-zA-Z0-9\-_]{32,}$/', $this->api_key)) {
            log_message('error', 'Invalid API key format. Expected format: sk-proj-{32+ characters}');
            throw new Exception('Invalid API key format. Please use a valid sk-proj API key.');
        }

        // Get company info
        $this->company_info = $CI->Company_model->get_company();
    }

    /**
     * Generate a review using ChatGPT
     * 
     * @param int $rating The rating (1-5)
     * @param array $keywords Array of keywords to use in the review
     * @param string $company_name The name of the company to review
     * @param string $company_location The location of the company
     * @return string|false The generated review text or false on failure
     */
    public function generate_review($rating, $keywords = [], $company_name = null, $company_location = null)
    {
        try {
            log_message('debug', 'Starting review generation with rating: ' . $rating);
            log_message('debug', 'Keywords: ' . json_encode($keywords));
            log_message('debug', 'Company name: ' . $company_name);
            log_message('debug', 'Company location: ' . $company_location);

            if (empty($this->api_key)) {
                log_message('error', 'API key is empty');
                throw new Exception('OpenAI API key is not set');
            }

            // Validate rating
            if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
                log_message('error', 'Invalid rating value: ' . $rating);
                throw new Exception('Invalid rating value: ' . $rating);
            }

            // Prepare the prompt
            $prompt = $this->prepare_prompt($rating, $keywords, $company_name, $company_location);
            log_message('debug', 'Prepared prompt: ' . $prompt);

            // Make API request
            $response = $this->make_api_request($prompt);
            if (!$response) {
                log_message('error', 'No response received from API');
                throw new Exception('Failed to get response from ChatGPT API');
            }

            // Extract review text from response
            $review = $this->extract_review_from_response($response);
            if (!$review) {
                log_message('error', 'Failed to extract review from response');
                throw new Exception('Failed to extract review from API response');
            }

            log_message('debug', 'Successfully generated review: ' . $review);
            return $review;
        } catch (Exception $e) {
            log_message('error', 'Error in generate_review: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * Prepare the prompt for ChatGPT
     */
    private function prepare_prompt($rating, $keywords, $company_name = null, $company_location = null)
    {
        $sentiment = $this->get_sentiment_for_rating($rating);
        $keyword_text = !empty($keywords) ? ' Include these keywords: ' . implode(', ', $keywords) : '';

        // Use provided company name or fallback to company info
        $company_name = $company_name ?? 'the business';

        // Use provided company location or fallback to company info
        $location_text = !empty($company_location) ? " in " . $company_location : '';

        return "Write a detailed, vast, authentic customer review for $company_name$location_text. The review should be $sentiment in tone.$keyword_text Keep it brief and natural.";
    }

    /**
     * Get sentiment based on rating
     */
    private function get_sentiment_for_rating($rating)
    {
        switch ($rating) {
            case 5:
                return 'extremely positive';
            case 4:
                return 'very positive';
            case 3:
                return 'moderately positive';
            case 2:
                return 'somewhat negative';
            case 1:
                return 'very negative';
            default:
                return 'neutral';
        }
    }

    /**
     * Make API request to ChatGPT
     */
    private function make_api_request($prompt)
    {
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant that generates authentic-sounding business reviews.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.9,
            'max_tokens' => 500,
            'top_p' => 0.9,
            'frequency_penalty' => 0.5,
            'presence_penalty' => 0.7
        ];

        log_message('debug', 'Making ChatGPT API request with data: ' . json_encode($data));
        log_message('debug', 'Using API key: ' . substr($this->api_key, 0, 8) . '...');

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            log_message('error', 'Curl error: ' . $error);
            curl_close($ch);
            throw new Exception('Connection error: ' . $error);
        }

        curl_close($ch);

        log_message('debug', 'ChatGPT API response code: ' . $http_code);
        log_message('debug', 'ChatGPT API response: ' . $response);

        if ($http_code === 401) {
            throw new Exception('Invalid API key. Please check your sk-proj API key.');
        } elseif ($http_code === 429) {
            $error_data = json_decode($response, true);
            $error_message = isset($error_data['error']['message']) ? $error_data['error']['message'] : 'Rate limit exceeded';

            if (strpos($error_message, 'quota') !== false) {
                throw new Exception('API quota exceeded. Please check your OpenAI account billing and plan details at https://platform.openai.com/account/billing');
            } else {
                throw new Exception('Rate limit exceeded. Please try again in a few minutes.');
            }
        } elseif ($http_code !== 200) {
            throw new Exception('API request failed with status ' . $http_code . ': ' . $response);
        }

        $decoded_response = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to decode API response: ' . json_last_error_msg());
        }

        return $decoded_response;
    }

    /**
     * Extract review text from API response
     */
    private function extract_review_from_response($response)
    {
        log_message('debug', 'Extracting review from response: ' . json_encode($response));

        if (!isset($response['choices'][0]['message']['content'])) {
            log_message('error', 'Response missing content: ' . json_encode($response));
            throw new Exception('Response missing content');
        }

        $review = trim($response['choices'][0]['message']['content']);
        log_message('debug', 'Extracted review: ' . $review);
        return $review;
    }
}
