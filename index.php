
<?php
// 
// 
// 
ob_start();
$token = '2141601403:AAFdbYFD1TEZ2iIRO8tMqT_RhtC8ULo_ZK8';
$mix_admin = '1790797379';
define('API_KEY', $token);

// 
// 
// 

function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot".API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}
// 
// 
// 

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$tx = $message->text;
$cid = $message->chat->id;
$uid = $message->from->id;
$ty = $message->chat->type;
$name = $message->from->first_name;
$mid = $message->message_id;
$audio = $message->audio;
$data = $update->callback_query->data;
$cmid = $update->callback_query->message->message_id;
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$qid = $update->callback_query->id; 
$ctext = $update->callback_query->message->text; 
$callfrid = $update->callback_query->from->id; 
$callfname = $update->callback_query->from->first_name;  
$calltitle = $update->callback_query->message->chat->title; 
$calluser = $update->callback_query->message->chat->username; 
$channel = $update->channel_post; //shu
$channel_text = $channel->text;
$channel_mid = $channel->message_id; 
$channel_id = $channel->chat->id; 
$channel_title = $channel->chat->title;
$channel_user = $channel->chat->username; 
$chanel_doc = $channel->document; 
$chanel_vid = $channel->video; 
$chanel_mus = $channel->audio; 
$chanel_voi = $channel->voice; 
$chanel_gif = $channel->animation; 
$chanel_fot = $channel->photo; //shu
$chanel_txt = $channel->text; 
$caption =$channel->caption; 
$chat_id = $message->chat->id;
// 
// 
// 
mkdir("stat");
$guruhlar = file_get_contents("stat/group.db");
$userlar = file_get_contents("stat/user.db");
$xabar = file_get_contents("xabarlar.txt");
     
if($tx == "/start") {
    $userlar = file_get_contents("stat/user.db");
   if(stripos($userlar,"$cid")!==false){
    }else{
    file_put_contents("stat/user.db","$userlar\n$cid");
       }     
bot('sendMessage',[
'chat_id'=>$cid,
'parse_mode'=>"markdown",
'text'=>"🇺🇿Ushbu Bot sizga kanalingizga yuborilga musiqalar avtori o'rniga kanal havolasini qo'yib beradi.

🇷🇺Этот бот разместит ссылку на канал вместо автора музыки, которую вы отправили на свой канал.

🇬🇧This Bot will put a channel link instead of the music author you sent to your channel.
©Asata_2101",
]);
}
// 
// 
// 
     if (isset($message->audio)){
      if(stripos($guruhlar,"$channel_id")!==false){
    }else{
    file_put_contents("stat/group.db","$guruhlar\n$channel_id");
    }  
$file_id = $message->audio->file_id;

      $get = bot('getfile',['file_id'=>$file_id]);
      $patch = $get->result->file_path;

// 
// 
// 
      file_put_contents('test.mp3', file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));

copy('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch, 'music.mp3');
}
if (isset($channel->audio)){}
 if(stripos($guruhlar,"$channel_id")!==false){
    }else{
    file_put_contents("stat/group.db","$guruhlar\n$channel_id");
    }  
$file_id = $channel ->audio->file_id;
$title = $channel ->audio->title;
$performer = $channel ->audio->performer;
      $get = bot('getfile',['file_id'=>$file_id]);
      $patch = $get->result->file_path;


      file_put_contents('music.mp3', file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));

bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
bot('sendaudio',[
'chat_id'=>$channel_id,
'audio'=>new CURLFile("music.mp3"),
'title'=>"$performer - $title",
'performer'=>'➣'.$channel_title,
'caption'=>"$performer - $title"]);
?>