<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChatGpt
{
    private $api_key;
    private $api_url = 'https://api.openai.com/v1/chat/completions';
    private $company_info;

    public function __construct()
    {
        $CI =& get_instance();
        $this->api_key = $CI->config->item('openai_api_key');

        // Load the company credentials model
        $CI->load->model('Company_model');
        $this->company_info = $CI->Company_model->get_company();

        if (empty($this->api_key)) {
            log_message('error', 'OpenAI API key is not set in configuration');
        }
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
        if (empty($this->api_key)) {
            log_message('error', 'Cannot generate review: OpenAI API key is not set');
            return false;
        }

        // Validate rating
        if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
            log_message('error', 'Invalid rating value: ' . $rating);
            return false;
        }

        // Prepare the prompt
        $prompt = $this->prepare_prompt($rating, $keywords, $company_name, $company_location);

        // Make API request
        $response = $this->make_api_request($prompt);

        if (!$response) {
            return false;
        }

        // Extract review text from response
        $review = $this->extract_review_from_response($response);

        if (!$review) {
            log_message('error', 'Failed to extract review from API response');
            return false;
        }

        return $review;
    }

    /**
     * Prepare the prompt for ChatGPT
     */
    private function prepare_prompt($rating, $keywords, $company_name = null, $company_location = null)
    {
        $sentiment = $this->get_sentiment_for_rating($rating);
        $keyword_text = !empty($keywords) ? ' Include these keywords naturally in the review: ' . implode(', ', $keywords) : '';

        // Use provided company name or fallback to company info
        $company_name = $company_name ?? (isset($this->company_info['company_name']) ? $this->company_info['company_name'] : 'the business');

        // Use provided company location or fallback to company info
        $company_location = $company_location ?? (isset($this->company_info['company_location']) ? $this->company_info['company_location'] : '');
        $location_text = !empty($company_location) ? " located in " . $company_location : '';

        return "Write a concise, authentic-sounding customer review for $company_name$location_text. 
The review should be $sentiment in tone and feel like a genuine customer experience. 
Make it specific and personal, mentioning concrete details about the experience.
$keyword_text
The review should be exactly 4-5 lines long, no more. Keep it brief but impactful.
Avoid generic phrases and make it unique each time.";
    }
    //Please write polite and best experience review for <Companyname>, Locatd at Pune using keywords like website design, digital marketing and SEO Services
    /**
     * Get sentiment description based on rating
     */
    private function get_sentiment_for_rating($rating)
    {
        switch ($rating) {
            case 5:
                return 'very positive';
            case 4:
                return 'positive';
            case 3:
                return 'neutral';
            case 2:
                return 'negative';
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
                    'content' => 'You are a helpful assistant that generates authentic-sounding business reviews. Each review should be unique and feel like it was written by a real customer.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.8,
            'max_tokens' => 100,
            'top_p' => 0.9,
            'frequency_penalty' => 0.7,
            'presence_penalty' => 0.6
        ];

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code !== 200) {
            log_message('error', 'ChatGPT API request failed with status ' . $http_code . ': ' . $response);
            return false;
        }

        return json_decode($response, true);
    }

    /**
     * Extract review text from API response
     */
    private function extract_review_from_response($response)
    {
        if (!isset($response['choices'][0]['message']['content'])) {
            return false;
        }

        return trim($response['choices'][0]['message']['content']);
    }
}
