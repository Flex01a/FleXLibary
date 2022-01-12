<?php
# By : @ZZZZD, @RRLRR #
error_reporting(0);
header('Content-Type: application/json', false);
if (function_exists('fastcgi_finish_request')) {
fastcgi_finish_request();
}
ob_start();
$API_KEY = "1883871949:AAEYciJpEjDi5i4Vd2pRMM2EvG-7XPB1sOA";
define('API_KEY',$API_KEY);
define('IDBot', explode(":", API_KEY)[0]);
echo file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
function bot($method,$database=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$database);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}
$header = array('origin: https://www.bigconverter.com','referer: https://www.bigconverter.com/v19/','user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36');
function Get_mp3($video =null, $header =null)
{
$curl  = curl_init();
curl_setopt($curl, CURLOPT_URL,"https://www.bigconverter.com/inc/processfile.php");
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'type=mp3&search_txt='.$video);
curl_setopt($curl, CURLOPT_COOKIEJAR, "cookie.txt");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);
preg_match_all('/(<h5 class="media-heading">(.*?)<\/h5>)|(data-link="(.*?)")/', $result, $matches);
unset($matches[4][0]);
if( $matches[2][0]!=null ){
$response = array();
$response[ok] = 1;
$response[result][title] = $matches[2][0];
for($i=1;$i<=count($matches[4]);$i++){
$response[result][download][video][mp3][$i] = $matches[4][$i]; 
}
}
else{
$response[ok] = 0;
$response[result] = "something is wrong";
}
return json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
function unescapeUTF8EscapeSeq($str){
return preg_replace_callback("/\\\u([0-9a-f]{4})/i",create_function('$matches','return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_QUOTES, \'UTF-8\');'),$str);
}
function search($search){
$contents = file_get_contents('https://www.youtube.com/results?search_query='.urlencode($search));  
$getti = '#"title":{"runs":\[{"text":"(.*?)\"#';
preg_match_all($getti,$contents,$endti);
$idvid = '#"videoId":"(.*?)"#';
preg_match_all($idvid,$contents,$vidid);
$runsTitle=[$endti[1][0],$endti[1][1],$endti[1][2],$endti[1][3],$endti[1][4],$endti[1][5],$endti[1][6],$endti[1][7],$endti[1][8],$endti[1][9],$endti[1][10],$endti[1][11],$endti[1][12],$endti[1][13],$endti[1][14],$endti[1][15],$endti[1][16],$endti[1][17],$endti[1][18],$endti[1][19],$endti[1][20],$endti[1][21],$endti[1][22]];
$runsId=[$vidid[1][0],$vidid[1][4],$vidid[1][8],$vidid[1][12],$vidid[1][16],$vidid[1][20],$vidid[1][24],$vidid[1][28],$vidid[1][32],$vidid[1][36],$vidid[1][40],$vidid[1][44],$vidid[1][48],$vidid[1][52],$vidid[1][56],$vidid[1][60],$vidid[1][64],$vidid[1][68],$vidid[1][72],$vidid[1][76],$vidid[1][80],$vidid[1][84],$vidid[1][88]];
$array['ok'] = true;
for ($i = 0; $i < 23; $i++){
$title = str_replace('",', null, preg_replace('#[0-9@=|()!-/"\}]]#', null,unescapeUTF8EscapeSeq($runsTitle[$i])));
$yidr = $runsId[$i];
$array['url'][] = [
'Title' =>$title,
'Id'   =>$yidr,
];
}
function Get_mp4($video =null, $header =null)
{
$curl  = curl_init();
curl_setopt($curl, CURLOPT_URL,"https://www.bigconverter.com/inc/processfile.php");
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'type=mp4&search_txt='.$video);
curl_setopt($curl, CURLOPT_COOKIEJAR, "cookie.txt");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);
preg_match_all('/(<h5 class="media-heading">(.*?)<\/h5>)|(data-link="(.*?)")/', $result, $matches);
unset($matches[4][0]);
if( $matches[2][0]!=null ){
$response = array();
$response[ok] = 1;
$response[result][title] = $matches[2][0];
for($i=1;$i<=count($matches[4]);$i++){
$response[result][download][video][mp3][$i] = $matches[4][$i]; 
}
}
else{
$response[ok] = 0;
$response[result] = "something is wrong";
}
return json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
header("Content-Type: application/json; charset=UTF-8");
return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
function li($value){
$value = "https://www.youtube.com/watch?v=".$value;
$curl = curl_init();
$headers = array('Host: api.snappea.com','Origin: https://www.snappea.com','Referer: https://www.snappea.com/en/videoInfo?key='.$value.'&searchType=link','user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36');
curl_setopt($curl, CURLOPT_URL, 'https://api.snappea.com/v1/video/details?url='.$value);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($curl);
curl_close($curl);
return $result;
}
function Getformat($search){
$infoid = json_decode(videoInfo($search), true);
$obj = json_decode(file_get_contents("https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=".$search."&format=json"));
$array ="🎬 ".mb_strimwidth($infoid['title'],0, 40, "..")."\n👤 [".$obj->{'author_name'}."](".$obj->{'author_url'}.")\n🕑 ".Getduration($infoid[duration])." - 👁 ".CountFormat($infoid[viewCount]);
return $array;
}
function thumb($search){
$obj = json_decode(file_get_contents("https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=".$search."&format=json"));
return $obj->{'thumbnail_url'};
}
function videoInfo($vid){
$FunctionGet = json_decode(li($vid), true);
$array['title'] = $FunctionGet[videoInfo][title];
$array['thumbnail'] = $FunctionGet[videoInfo][thumbnail];
$array['duration'] = $FunctionGet[videoInfo][duration];
$array['expires'] = $FunctionGet[videoInfo][expires];
$array['viewCount'] = $FunctionGet[videoInfo][viewCount];
$array['size'] = $FunctionGet[videoInfo][downloadInfoList][6][partList][0][size];
return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
function CountFormat($num){
if ($num > 1000) {
$x = round($num);
$x_number_format = number_format($x);
$x_array = explode(',', $x_number_format);
$x_parts = array('K', 'M', 'B', 'T');
$x_count_parts = count($x_array) - 1;
$x_display = $x;
$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
$x_display .= $x_parts[$x_count_parts - 1];
return $x_display;
}
return $num;
}
function Getduration($duration){
$seconds = $duration;
$minutes = (int) ($seconds / 60);
$hours   = (int) ($minutes / 60);
if ($minutes >= 1){
$sec = $seconds - ($minutes *60);
if($sec <= 9){
$sec = "0".$sec;
}else{
$sec = $sec;
}
$lin = $minutes.":".$sec;
}else{
if($seconds <= 9){
$seconds = "00:0".$seconds;
}else{
$seconds = "00:".$seconds;
}
$lin = $seconds;
}
return $lin;
}
function url($vid){
$FunctionGet = json_decode(li($vid), true);
$urlList = $FunctionGet[videoInfo][downloadInfoList][6][partList][0][urlList][0];
$array['results'] = $urlList;
return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
function is_idvid($vid){
if (preg_match('#youtube.com#',$vid)) {
parse_str($vid, $etc);
$vid = $etc['https://www_youtube_com/watch?v'];
if (!$vid){
$vid = $etc['http://www_youtube_com/watch?v'];
}
}elseif(preg_match('#youtu.be#', $vid)){
$ex = explode("/", $vid);
$vid = $ex[3];
}
return $vid;
}
function q($q){
$contents = file_get_contents('https://www.youtube.com/results?search_query='.urlencode($q));  
$getti = '#"title":{"runs":\[{"text":"(.*?)\"#';
preg_match_all($getti,$contents,$endti);
$idvid = '#"videoId":"(.*?)"#';
preg_match_all($idvid,$contents,$vidid);
$runsTitle=[$endti[1][0],$endti[1][1],$endti[1][2],$endti[1][3],$endti[1][4],$endti[1][5],$endti[1][6],$endti[1][7],$endti[1][8],$endti[1][9],$endti[1][10],$endti[1][11],$endti[1][12],$endti[1][13],$endti[1][14],$endti[1][15],$endti[1][16],$endti[1][17],$endti[1][18],$endti[1][19],$endti[1][20],$endti[1][21],$endti[1][22]];
$runsId=[$vidid[1][0],$vidid[1][4],$vidid[1][8],$vidid[1][12],$vidid[1][16],$vidid[1][20],$vidid[1][24],$vidid[1][28],$vidid[1][32],$vidid[1][36],$vidid[1][40],$vidid[1][44],$vidid[1][48],$vidid[1][52],$vidid[1][56],$vidid[1][60],$vidid[1][64],$vidid[1][68],$vidid[1][72],$vidid[1][76],$vidid[1][80],$vidid[1][84],$vidid[1][88]];
$array['ok'] = true;
for ($i = 0; $i < 23; $i++){
$title = str_replace('",', null, preg_replace('#[0-9@=|()!-/"\}]]#', null,$runsTitle[$i]));
$yidr = $runsId[$i];
$array['results'][] = [
'title' => $title,
'url'   => $yidr
];
}
return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
$update = file_get_contents("php://input");
$updateData = json_decode($update,true);
$messageData = isset($updateData["callback_query"]) ? $updateData["callback_query"] : $updateData["message"];
$chatId = isset($updateData["callback_query"]) ? $updateData["callback_query"]["message"]["chat"]["id"] : $updateData["message"]["chat"]["id"];
$chatName = isset($updateData["callback_query"]) ? $updateData["callback_query"]["message"]["chat"]["title"] : $updateData["message"]["chat"]["title"];
$chatType = isset($updateData["callback_query"]) ? $updateData["callback_query"]["message"]["chat"]["type"] : $updateData["message"]["chat"]["type"];
$messageId = isset($updateData["callback_query"]) ? $updateData["callback_query"]["message"]["message_id"] : $updateData["message"]["message_id"];
$messageText = $messageData["text"];
$reply = $messageData["reply_to_message"];
$callbackid = $updateData['callback_query']['id'];
$data = $updateData["callback_query"]["data"];
$from_id = $messageData["from"]["id"];
$setbot = json_decode(file_get_contents(IDBot.".json"),true);
$usebot = json_decode(file_get_contents(IDBot."use.json"),true);
$TokenInfo = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$UserBot = $TokenInfo->result->username; 
$NameBot = $TokenInfo->result->first_name; 
$IdBot = $TokenInfo->result->id;
$TxT = ["oldDo"=>"❏︙تم تفعيل التحميل سابقا","Do"=>"❏︙تم تفعيل التحميل بنجاح","oldaDofalse"=>"❏︙تم تعطيل التحميل سابقا","Dofalse"=>"❏︙تم تعطيل التحميل بنجاح","oldadd"=>"❏︙تم تفعيل البوت سابقا","add"=>"❏︙تم تفعيل البوت بنجاح","start"=>"❏︙اهلا بك في بوت التحميل من السوشل ميديا .\n❏︙البوت يدعم التنزيل من ( تيك توك ، انستغرام ، فيسبك <ميتا> ، بنترست ، لايكي ، ومن يوتيوب ) .\n❏︙قم الان بارسال رابط او كلمه للبحث او التنزيل .\n"];
if($messageText  == "/start") {
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["start"],'reply_to_message_id'=>$messageId]);
}
if($chatType != "private"){
if($messageText  == "تفعيل" ) {
if($setbot[$chatId]["Ad"]){
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["oldadd"],'reply_to_message_id'=>$messageId]);
}else{
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["add"],'reply_to_message_id'=>$messageId]);
$setbot[$chatId]["Ad"] = true;
file_put_contents(IDBot.".json",json_encode($setbot,128|32|256));
}
}
if($messageText  == "تفعيل التنزيل" ) {
if($setbot[$chatId]["Do"]){
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["oldDo"],'reply_to_message_id'=>$messageId]);
}else{
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["Do"],'reply_to_message_id'=>$messageId]);
$setbot[$chatId]["Do"] = true;
file_put_contents(IDBot.".json",json_encode($setbot,128|32|256));
}
}
if($messageText  == "تعطيل التنزيل" ) {
if($setbot[$chatId]["Do"]){
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["oldaDofalse"],'reply_to_message_id'=>$messageId]);
}else{
bot('sendmessage',['chat_id'=>$chatId,'text'=>$TxT["Dofalse"],'reply_to_message_id'=>$messageId]);
$setbot[$chatId]["Do"] = false;
file_put_contents(IDBot.".json",json_encode($setbot,128|32|256));
}
}
if(preg_match('/بحث /', $messageText) ){
if(!strstr($messageText,"://") && !strstr($messageText,"dl_") && !strstr($messageText,"https://")){
unset($usebot[$from_id]["msg"]);
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
$ex = explode('بحث ',$messageText);
$vr = bot('sendMessage',[
'chat_id'=>$chatId,
'text'=>'⌔︙يتم البحث عن "'.$ex[1].'"',
'reply_to_message_id'=>$messageId,
])->result->message_id;
$FunctionGet = json_decode(q($ex[1]), true);
$y = '⌔︙نتائج البحث لـ "'.$ex[1].'"';
for ($i=0; $i < 5; $i++) {
$infoid = json_decode(videoInfo($FunctionGet['results'][$i]['url']), true);
$t =$t."\n\n🎬 ".mb_strimwidth($infoid['title'],0, 40, "..")."\n🕑 ".Getduration($infoid[duration])." - 👁 ".CountFormat($infoid[viewCount])."\n🔗 /dl_".str_replace('-','vo',$FunctionGet['results'][$i]['url']);
}
bot('EditMessageText',[
'chat_id' =>$chatId,
'message_id'=>$vr,
'text'=>$y."\n".$t,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'التالي •','callback_data' =>"qq!!".$messageText."!!10"]],
]])
]);
$usebot[$from_id]["vr"] = $vr;
$usebot[$from_id]["msg"] = $messageId;
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
}
}
if(strstr($data,"qq!!")){
$trs = explode('!!',$data)[1];
$dfo = explode('!!',$data)[2];
$FunctionGet = json_decode(q($trs), true);
$y = '⌔︙نتائج البحث لـ "'.$trs.'"';
if($dfo == 0){
for ($i= 0; $i < 5; $i++) {
$infoid = json_decode(videoInfo($FunctionGet['results'][$i]['url']), true);
$t =$t."\n\n🎬 ".mb_strimwidth($infoid['title'],0, 40, "..")."\n🕑 ".Getduration($infoid[duration])." - 👁 ".CountFormat($infoid[viewCount])."\n🔗 /dl_".str_replace('-','vo',$FunctionGet['results'][$i]['url']);
}
bot('EditMessageText',[
'chat_id' =>$chatId,
'message_id'=>$messageId,
'text'=>$y."\n".$t,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'التالي •','callback_data' =>"qq!!".$trs."!!10"]],
]])
]);return false;
}
if($dfo == 20){
for ($i= ($dfo - 5); $i < $dfo; $i++) {
$infoid = json_decode(videoInfo($FunctionGet['results'][$i]['url']), true);
$t =$t."\n\n🎬 ".mb_strimwidth($infoid['title'],0, 40, "..")."\n🕑 ".Getduration($infoid[duration])." - 👁 ".CountFormat($infoid[viewCount])."\n🔗 /dl_".str_replace('-','vo',$FunctionGet['results'][$i]['url']);
}
bot('EditMessageText',[
'chat_id' =>$chatId,
'message_id'=>$messageId,
'text'=>$y."\n".$t,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'السابق •','callback_data' =>"qq!!".$trs."!!".($dfo -5)]],
]])
]);return false;
}
for ($i= ($dfo - 5); $i < $dfo; $i++) {
$infoid = json_decode(videoInfo($FunctionGet['results'][$i]['url']), true);
$t =$t."\n\n🎬 ".mb_strimwidth($infoid['title'],0, 40, "..")."\n🕑 ".Getduration($infoid[duration])." - 👁 ".CountFormat($infoid[viewCount])."\n🔗 /dl_".str_replace('-','vo',$FunctionGet['results'][$i]['url']);
}
bot('EditMessageText',[
'chat_id' =>$chatId,
'message_id'=>$messageId,
'text'=>$y."\n".$t,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'السابق •','callback_data' =>"qq!!".$trs."!!".($dfo -5)],['text'=>'التالي •','callback_data' =>"qq!!".$trs."!!".($dfo +5)]],
]])
]);
}
if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $messageText)){
unset($usebot[$from_id]["msg"]);
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $messageText, $match);
$FunctionGet = json_decode(li($match[1]), true);
$urlList = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][urlList][0];
$bytes   = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][size];
if($bytes > 52428800){
bot('sendMessage',[
'chat_id'=>$chatId,
'text'=>'⚠️┇عذرا لا يمكن تحميل فيديو بحجم ↫ "*'.number_format($bytes / 1048576,0) . 'MB*"'."\n[⭕┇اضغط هنا للتحميل من موقع خارجي]($urlList)",
'parse_mode'=>'MarkDown','disable_web_page_preview'=>true,
'reply_to_message_id'=>$messageId,
]);
}else{
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$messageId]);
$rt = bot('sendmessage', ['chat_id' => $chatId, 'text' => "انتظر قليلاً."])->result->message_id;
bot('sendphoto',[
'chat_id'=>$chatId,
'photo'=>thumb($match[1]),
"caption"=>Getformat($match[1]),
'parse_mode'=>'MarkDown','disable_web_page_preview'=>true,
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'فيديو مرئي','callback_data' =>"vi#".$match[1]]],
[['text'=>'ملف صوتي','callback_data' =>"au#".$match[1]],['text'=>'بصمه صوتيه','callback_data' =>"vo#".$match[1]]],
]])
]);
$usebot[$from_id]["msg"] = $messageId;
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$rt]);
}
}
if(strstr($messageText,"dl_")){
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$usebot[$from_id]["vr"]]);
unset($usebot[$from_id]["vr"]);
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
$messageText = str_replace("@".$UserBot, "", $messageText);
$dld = str_replace("vo", "-", $messageText);
$dl_id = explode('_', $dld)[1];
$FunctionGet = json_decode(li($dl_id), true);
$urlList = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][urlList][0];
$bytes   = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][size];
if($bytes > 52428800){
bot('sendMessage',[
'chat_id'=>$chatId,
'text'=>'⚠️┇عذرا لا يمكن تحميل فيديو بحجم ↫ "*'.number_format($bytes / 1048576,0) . 'MB*"'."\n[⭕┇اضغط هنا للتحميل من موقع خارجي]($urlList)",
'parse_mode'=>'MarkDown','disable_web_page_preview'=>true,
'reply_to_message_id'=>$usebot[$from_id]["msg"],
]);
}else{
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$messageId]);
$rt = bot('sendmessage', ['chat_id' => $chatId, 'text' => "انتظر قليلاً.",'reply_to_message_id'=>$usebot[$from_id]["msg"]])->result->message_id;
bot('sendphoto',[
'chat_id'=>$chatId,
'photo'=>thumb($dl_id),
"caption"=>Getformat($dl_id),
'parse_mode'=>'MarkDown','disable_web_page_preview'=>true,
'reply_to_message_id'=>$usebot[$from_id]["msg"],
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'فيديو مرئي','callback_data' =>"vi#".$dl_id]],
[['text'=>'ملف صوتي','callback_data' =>"au#".$dl_id],['text'=>'بصمه صوتيه','callback_data' =>"vo#".$dl_id]],
]])
]);
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$rt]);
}
}
$exGet = explode("#",$data);
if($exGet[0] == "vi"){
$FunctionGet = json_decode(li($exGet[1]), true);
$download = json_decode(Get_mp4('https://www.youtube.com/watch?v='.$exGet[1], $header), 1);
$rand = rand(1, 2);
$videoo = $download[result][download][video][mp3][$rand];
$urlList = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][urlList][0];
$id_msg = bot("sendmessage",[
"chat_id"=>$chatId,
"text"=>"❕┇*جاري المعالجة*...",
"parse_mode"=>"markdown",
'reply_to_message_id'=>$usebot[$from_id]["msg"],
])->result->message_id;
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$messageId,]);
$bj = bot('sendvideo',[
'chat_id'=>$chatId,
"video"=>curl_file_create($videoo,'video/mp4','hamoudi.mp4'),
'thumb'=>curl_file_create(thumb($exGet[1])),
"caption"=>Getformat($exGet[1]),
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$usebot[$from_id]["msg"],
'disable_web_page_preview'=>true,
])->ok;
unset($usebot[$from_id]["msg"]);
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
if(!$bj){
bot("editmessagetext",[
"chat_id"=>$chatId,
"text"=>"❌┇حدث *خطأ* غير معروف.",
"parse_mode"=>"markdown",
"message_id"=>$id_msg,
]);return false;
}else{
bot("editmessagetext",[
"chat_id"=>$chatId,
"text"=>"✅┇تم *'التحميل*",
"parse_mode"=>"markdown",
"message_id"=>$id_msg,
]);
}
}
# # # # # # # # # 
if($exGet[0] == "au"){
$FunctionGet = json_decode(li($exGet[1]), true);
$download = json_decode(Get_mp3('https://www.youtube.com/watch?v='.$exGet[1], $header), 1);
$rand = rand(1, 5);
$videoo = $download[result][download][video][mp3][$rand];
$urlList = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][urlList][0];
$id_msg = bot("sendmessage",[
"chat_id"=>$chatId,
"text"=>"❕┇*جاري المعالجة*...",
"parse_mode"=>"markdown",
'reply_to_message_id'=>$usebot[$from_id]["msg"],
])->result->message_id;
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$messageId,]);
$bj = bot('sendaudio',[
'chat_id'=>$chatId,
'title'=>$FunctionGet['videoInfo']['title'],
"audio"=>curl_file_create($videoo,'audio/mp3','hamoudi.mp3'),
'thumb'=>curl_file_create(thumb($exGet[1])),
"caption"=>Getformat($exGet[1]),
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$usebot[$from_id]["msg"],
'disable_web_page_preview'=>true,
])->ok;
unset($usebot[$from_id]["msg"]);
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
if(!$bj){
bot("editmessagetext",[
"chat_id"=>$chatId,
"text"=>"❌┇حدث *خطأ* غير معروف.",
"parse_mode"=>"markdown",
"message_id"=>$id_msg,
]);return false;
}else{
bot("editmessagetext",[
"chat_id"=>$chatId,
"text"=>"✅┇تم *'التحميل*",
"parse_mode"=>"markdown",
"message_id"=>$id_msg,
]);
}
}
# # # # # # #
if($exGet[0] == "vo"){
$FunctionGet = json_decode(li($exGet[1]), true);
$download = json_decode(Get_mp3('https://www.youtube.com/watch?v='.$exGet[1], $header), 1);
$rand = rand(1, 5);
$videoo = $download[result][download][video][mp3][$rand];
$urlList = $FunctionGet[videoInfo][downloadInfoList][5][partList][0][urlList][0];
$id_msg = bot("sendmessage",[
"chat_id"=>$chatId,
"text"=>"❕┇*جاري المعالجة*...",
"parse_mode"=>"markdown",
'reply_to_message_id'=>$usebot[$from_id]["msg"],
])->result->message_id;
bot('deleteMessage',['chat_id'=>$chatId,'message_id' =>$messageId,]);
$bj = bot('sendvoice',[
'chat_id'=>$chatId,
"voice"=>curl_file_create($videoo,'audio/mp3','hamoudi.mp3'),
'thumb'=>curl_file_create(thumb($exGet[1])),
"caption"=>Getformat($exGet[1]),
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$usebot[$from_id]["msg"],
'disable_web_page_preview'=>true,
])->ok;
unset($usebot[$from_id]["msg"]);
file_put_contents(IDBot."use.json",json_encode($usebot,128|32|256));
if(!$bj){
bot("editmessagetext",[
"chat_id"=>$chatId,
"text"=>"❌┇حدث *خطأ* غير معروف.",
"parse_mode"=>"markdown",
"message_id"=>$id_msg,
]);return false;
}else{
bot("editmessagetext",[
"chat_id"=>$chatId,
"text"=>"✅┇تم *'التحميل*",
"parse_mode"=>"markdown",
"message_id"=>$id_msg,
]);
}
}
}
