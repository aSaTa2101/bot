
<?php



// 
// 
// 
$mix_admin = '1790797379';
if($tx=="/send" and $cid==$mix_admin){
  bot('sendmessage',[
    'chat_id'=>$mix_admin,
    'text'=>"Yuboriladigan xabar matnini kiriting!",
    'parse_mode'=>"html",
]);
    file_put_contents("xabarlar.txt","user");
}
if($xabar=="user" and $cid==$mix_admin){
if($tx=="/otmen"){
  file_put_contents("xabarlar.txt","");
}else{
  $lich = file_get_contents("stat/user.db");
  $lichka = explode("\n",$lich);
  foreach($lichka as $lichkalar){
  $okuser=bot("sendmessage",[
    'chat_id'=>$lichkalar,
    'text'=>$tx,
    'parse_mode'=>'html'
]);
}

if($okuser){
  bot("sendmessage",[
    'chat_id'=>$mix_admin,
    'text'=>"Hamma userlarga yuborildi!",
    'parse_mode'=>'html',
]);
  file_put_contents("xabarlar.txt","");
}
}
}
if($tx=="/sendchannel" and $cid==$mix_admin){
  bot('sendmessage',[
    'chat_id'=>$mix_admin,
    'text'=>"Kanallarga yuboriladigan xabar matnini kiriting!",
    'parse_mode'=>"html",
  ]);
  file_put_contents("xabarlar.txt","guruh");
}
if($xabar=="guruh" and $cid==$mix_admin){
  if($tx=="/otmen"){
  file_put_contents("xabarlar.txt","");
}else{
  $gr = file_get_contents("stat/group.db");
  $grup = explode("\n",$gr);
foreach($grup as $chatlar){
  $okguruh=bot("sendmessage",[
    'chat_id'=>$chatlar,
    'text'=>$tx,
    'parse_mode'=>'html',
]);
}
if($okguruh){ 
  bot("sendmessage",[
    'chat_id'=>$mix_admin,
    'text'=>"Hamma kanallarga yuborildi!",
    'parse_mode'=>'html',
]);
  file_put_contents("xabarlar.txt","");
}
}
} 
if($tx == "/stat"){
$gr = substr_count($guruhlar,"\n"); 
$us = substr_count($userlar,"\n"); 
$obsh = $gr + $us;
   bot('sendMessage',[
   'chat_id'=>$cid,
    'text'=> "🎛Bot statistikasi:

➩Bot A'zolari: <b>$us</b>

➩ Ulangan Kanallar: <b>$gr</b>

➠Umumiy: <b>$obsh</b>\n",
'parse_mode' => 'html',
]);
}
include("index.php");
// 
// 
?>