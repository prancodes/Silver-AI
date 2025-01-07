<?php

require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

$complete = $open_ai->completion([
   'model' => 'gpt-3.5-turbo-instruct',
   'prompt' => 'Hello',
   'temperature' => 0.9,
   'max_tokens' => 150,
   'frequency_penalty' => 0,
   'presence_penalty' => 0.6,
]);


var_dump($complete);
echo "<br>";
echo "<br>";
echo "<br>";
// decode response
$d = json_decode($complete);
// Get Content
echo($d->choices[0]->message->content);
