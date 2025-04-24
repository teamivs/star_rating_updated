<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class ChatGpt extends CI_Controller{
   public function __construct(){
		parent::__construct();
   }

   public function generate(){
      
    $text=$this->input->post('question');
		$data = [

			"model" => "gpt-3.5-turbo",
	
			'messages' => [
				[
				   "role" => "user",
	
				   "content" => $text
			   ]
	
			],
	
			'temperature' => 0.5,
	
			"max_tokens" => 4000,
	
			"top_p" => 1.0,
	
			"frequency_penalty" => 0.52,
	
			"presence_penalty" => 0.5,
	
			"stop" => ["11."],
	
		  ];



		$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

  

$headers = [];

$headers[] = 'Content-Type: application/json';

$headers[] = 'Authorization: Bearer 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';

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  

$response = curl_exec($ch);

if (curl_errno($ch)) {

    echo 'Error:' . curl_error($ch);

}

curl_close($ch);

$data = json_decode($response);

$messageContent='Message content not found';
// Extracting the message content
if (isset($data->choices[0]->message->content)) {
    $messageContent = $data->choices[0]->message->content."\n\n".'Kind regards,'."\n".$this->session->ignite_name;
} 

if($this->input->post('frommodule')==1){
	$this->db->where('a_id',$this->input->post('aid'))->update('ignite_assesment',array('a_chatgpt_response'=>$messageContent));
	$assement=$this->db->where('a_id',$this->input->post('aid'))->get('ignite_assesment')->row();
}elseif($this->input->post('frommodule')==2){
	if($this->input->post('aid')!=null){
	$this->db->where('tlb_id',$this->input->post('aid'))->update('ignite_tutor_lesson_book',array('tlb_chatgpt_response'=>$messageContent));

	$assement=$this->db->where('tlb_id',$this->input->post('aid'))->get('ignite_tutor_lesson_book')->row();
	}else{
		$assement=array('tlb_chatgpt_response'=>$messageContent);
	}
}
echo json_encode($assement);
   }

   public function generate_for_multiple(){
      
    $text=$this->input->post('question');
		$data = [

			"model" => "gpt-3.5-turbo",
	
			'messages' => [
				[
				   "role" => "user",
	
				   "content" => $text
			   ]
	
			],
	
			'temperature' => 0.5,
	
			"max_tokens" => 4000,
	
			"top_p" => 1.0,
	
			"frequency_penalty" => 0.52,
	
			"presence_penalty" => 0.5,
	
			"stop" => ["11."],
	
		  ];



		$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

  

$headers = [];

$headers[] = 'Content-Type: application/json';

$headers[] = 'Authorization: Bearer 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';

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  

$response = curl_exec($ch);

if (curl_errno($ch)) {

    echo 'Error:' . curl_error($ch);

}

curl_close($ch);

$data = json_decode($response);

$messageContent='Message content not found';
// Extracting the message content
if (isset($data->choices[0]->message->content)) {
    $messageContent = $data->choices[0]->message->content."\n\n".'Kind regards,'."\n".$this->session->ignite_name;
} 


	$this->db->where('tlb_id',$this->input->post('aid'))->update('ignite_tutor_lesson_book',array('tlb_chatgpt_response'=>$messageContent));
	
	$assement=$this->db->where('tlb_id',$this->input->post('aid'))->get('ignite_tutor_lesson_book')->row();

echo json_encode(array('tlb_chatgpt_response'=>$messageContent));
   }

}