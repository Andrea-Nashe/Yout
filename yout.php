<?php
$video_url = base64_encode("VIDEO_URL");

$data = [
    "video_url" => $video_url,
    "start_time" => "false",
    "end_time" => "false",
    "title" => "Hello world",
    "artist" => "Hello world",
    "audio_quality" => "128k",
    "format" => "mp3"
];

$postData = http_build_query($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://dvr.yout.com/mp3");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: API_KEY",
    "Content-Type: application/x-www-form-urlencoded"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    file_put_contents("audio.mp3", $response);
    echo "✅ audio.mp3";
} else {
    echo "❌ $httpCode\n";
    echo $response;
}
?>