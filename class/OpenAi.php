<?php
class OpenAi {	
	
	private $dTemperature = 0.9;
    private $iMaxTokens = 100;
    private $top_p = 1;
    private $frequency_penalty = 0.0;
    private $presence_penalty = 0.0;		
    private $sModel = "text-davinci-003";
	private $ApiKey = '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';
	
	public function getAnswer(){
		if($this->question) {
			$ch = curl_init();
			$headers  = [
				'Accept: application/json',
				'Content-Type: application/json',
				'Authorization: Bearer ' . $this->ApiKey . ''
			];

			$postData = [
				'model' => $this->sModel,
				'prompt' => str_replace('"', '', $this->question),
				'temperature' => $this->dTemperature,
				'max_tokens' => $this->iMaxTokens,
				'top_p' => $this->top_p,
				'frequency_penalty' => $this->frequency_penalty,
				'presence_penalty' => $this->presence_penalty,
				'stop' => '[" Human:", " AI:"]',
			];

			curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
			$result = curl_exec($ch);
			$decoded_json = json_decode($result, true);		
			return ($decoded_json['choices'][0]['text']); 
		}
	}
	
}
?>