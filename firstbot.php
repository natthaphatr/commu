<?php
function reply_msg($txtin,$replyToken)//สร้างข้อความและตอบกลับ
{
    $access_token = 'eAaYQOpFjEnTlzOIMlj6dIFZl4XoBxnUfUYnwuDF0XT4uOtkDFv8q4BEAO+lAvWNVt5F7k4u2BPi9M01KWSkOzSVhFc1QQzGNAKEl723w+bWsD1haQkPvIIyNozYC0wZS/QweWzw6dPieILkboCL5QdB04t89/1O/w1cDnyilFU=';
    $messages = ['type' => 'text','text' => $txtin];//สร้างตัวแปร 
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
    $post = json_encode($data);
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result . "\r\n";
}

// รับข้อมูล
require('connect_db.php');
$content = file_get_contents('php://input');//รับข้อมูลจากไลน์
$events = json_decode($content, true);//แปลง json เป็น php
file_put_contents('log.txt',$events,FILE_APPEND); //สร้างไฟล์ log
if (!is_null($events['events'])) //check ค่าในตัวแปร $events
{
    foreach ($events['events'] as $event) {
        if ($event['type'] == 'message' && $event['message']['type'] == 'text')
        {
            $replyToken = $event['replyToken']; //เก็บ reply token เอาไว้ตอบกลับ
            $source_type = $event['source']['type'];//เก็บที่มาของ event(user หรือ group)
            $txtin = $event['message']['text'];//เอาข้อความจากไลน์ใส่ตัวแปร $txtin
            $sql_text="SELECT * FROM commu WHERE keyword LIKE '%$txtin%'";
            $query = mysqli_query($conn,$sql_text);
            while($obj = mysqli_fetch_assoc($query))
            {
                $txtback = $txtback."\n". $obj["keyword"];
            }
        
            reply_msg($txtback,$replyToken);      
        }
    }
}
echo "BOT OK...........";