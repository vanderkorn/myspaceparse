<?php
	// @creation_date 15.10.10
	// @modification_date 17.10.10
	// @author Kornilov Ivan
	// @document index.php
	// Парсинг myspace
	// @version 0.1
function LoginMySpace($Url,$UrlFrom,$user,$pass){
    // инсталлирован ли у нас курл?
 if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
$curl = curl_init(); // инициализируем cURL
curl_setopt($curl, CURLOPT_URL, $Url);//Настойка опций cookie
curl_setopt($curl, CURLOPT_COOKIEJAR, 'cook.txt');//сохранить куки в файл
curl_setopt($curl, CURLOPT_COOKIEFILE, 'cook.txt');//считать куки из файла
curl_setopt($curl, CURLOPT_USERAGENT, "Opera/10.00 (Windows NT 5.1; U; ru) Presto/2.2.0");
curl_setopt($curl, CURLOPT_FAILONERROR, 1);
curl_setopt($curl, CURLOPT_REFERER, $UrlFrom);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, 'ctl00$ctl00$cpMain$cpMain$LoginBox$Email_Textbox='.$user.'&ctl00$ctl00$cpMain$cpMain$LoginBox$Password_Textbox='.$pass.'&dlb=\'Логин\'');
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);// не проверять SSL сертификат
curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);// не проверять Host SSL сертификата
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);// разрешаем редиректы
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl); // выполняем запрос и записываем в переменную
curl_close($curl); // заканчиваем работу curl
return $result; // собственно печатаем результат
}
function ReadMySpace($Url,$UrlFrom,$qyery){
 if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
$curl = curl_init(); // инициализируем cURL
curl_setopt($curl, CURLOPT_URL, $Url);
curl_setopt($curl, CURLOPT_COOKIEJAR, 'cook.txt');//сохранить куки в файл
curl_setopt($curl, CURLOPT_COOKIEFILE, 'cook.txt');//считать куки из файла
curl_setopt($curl, CURLOPT_USERAGENT, "Opera/10.00 (Windows NT 5.1; U; ru) Presto/2.2.0");
curl_setopt($curl, CURLOPT_FAILONERROR, 1);
curl_setopt($curl, CURLOPT_REFERER, $UrlFrom);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_POST, 1); // устанавливаем метод POST
curl_setopt($curl, CURLOPT_POSTFIELDS, $qyery);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);// не проверять SSL сертификат
curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);// не проверять Host SSL сертификата
curl_setopt($curl,  CURLOPT_FOLLOWLOCATION, 1);// разрешаем редиректы
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl); // выполняем запрос и записываем в переменную
curl_close($curl); // заканчиваем работу curl
return $result; // собственно печатаем результат
}

function ReadMySpace2($Url,$UrlFrom){
 if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
$curl = curl_init(); // инициализируем cURL
curl_setopt($curl, CURLOPT_URL, $Url);
curl_setopt($curl, CURLOPT_COOKIEJAR, 'cook.txt');//сохранить куки в файл
curl_setopt($curl, CURLOPT_COOKIEFILE, 'cook.txt');//считать куки из файла
curl_setopt($curl, CURLOPT_USERAGENT, "Opera/10.00 (Windows NT 5.1; U; ru) Presto/2.2.0");
curl_setopt($curl, CURLOPT_FAILONERROR, 1);
curl_setopt($curl, CURLOPT_REFERER, $UrlFrom);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_POST, 0); // устанавливаем метод POST
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);// не проверять SSL сертификат
curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);// не проверять Host SSL сертификата
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);// разрешаем редиректы
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl); // выполняем запрос и записываем в переменную
curl_close($curl); // заканчиваем работу curl
return $result; // собственно печатаем результат
}

//залогиниться
$res=LoginMySpace("https://secure.myspace.com/index.cfm?fuseaction=login.process","http://myspace.com/","etea2009@mail.ru","28071987");
//запрос поиска
$res2=ReadMySpace("http://browseusers.myspace.com/Browse/Browse.aspx","http://www.myspace.com/home","hasPhoto=1&GN=M&minAge=25&maxAge=50&minCm=92&maxCm=243&heightBetween=0&SK=B&DK=B&RG=_&CL=_&ddlCountry=222&ddlRegion=0&txtRegion=&ddlSearchRadius=0&txtPostalCode=&hdnSearchMode=distance&SB=L&view=0&scope=1&display=0");
//переход на вторую страницу
$res3=ReadMySpace2("http://browseusers.myspace.com/Browse/Browse.aspx?hasPhoto=1&GN=M&minAge=25&maxAge=50&minCm=92&maxCm=243&heightBetween=0&SK=B&DK=B&RG=_&CL=_&ddlCountry=222&ddlRegion=0&txtRegion=&ddlSearchRadius=0&txtPostalCode=&hdnSearchMode=distance&SB=L&view=0&scope=1&display=0&page=2","http://browseusers.myspace.com/Browse/Browse.aspx");

//парсинг параметров для отправки сообщений
$re='|class=\"msProfileLink friendToolTipBox\" friendid=\"(\d+)\"|i';
preg_match($re,$res3,$p);
echo $p[1];
$re='|&token=(.*?)\"|i';
preg_match($re,$res3,$p2);
echo $p2[1];

$res4=ReadMySpace2("http://messaging.myspace.com/index.cfm?fuseaction=mail.messageV3&friendID=".$p[1],"http://www.myspace.com/".$p[1]);
$re='|\"__VIEWSTATE\" value=\"(.*?)\"|i';
preg_match($re,$res4,$view);
echo "VIEWSTATE=".$view[1]."< br />";

$re='|\"ctl00_ctl00_ctl00_cpMain_cpMain_messagingMain_ComposeMessage_sendMessageCommonControl_uploadAttachmentControl_draftGuid\" value=\"(.*?)\"|i';
preg_match($re,$res4,$par1);
echo "ctl00\$ctl00\$ctl00\$cpMain\$cpMain\$messagingMain\$ComposeMessage\$sendMessageCommonControl\$uploadAttachmentControl\$draftGuid=".

$par1[1]."< br />";
$re='|\"mhash\" value=\"(.*?)\"|i';
preg_match($re,$res4,$par2);
echo "mhash=".$par2[1]."< br />";


$pref='ctl00$ctl00$ctl00$cpMain$cpMain$messagingMain$ComposeMessage$sendMessageCommonControl';
$post_elements=array(
'__VIEWSTATE'=>$view[1],
$pref.'$attachmentListSend'=>'',
'fileBrowseAttach'=>'',
$pref.'$uploadAttachmentControl$newAttachmentsList'=>'',
$pref.'$recipientsInfoData'=>$p[1],
$pref.'$messageType'=>'',
$pref.'$previousMessageId'=>'',
$pref.'$originalMessageFolder'=>'',
$pref.'$linksPreview'=>'',
$pref.'$txtSubject'=>'Hello!',
$pref.'$ctl01'=>'Hello World',
$pref.'$uploadAttachmentControl$draftGuid'=>$par1[1],
'ctl00_ctl00_ctl00_cpMain_cpMain_messagingMain_ComposeMessage_sendMessageCommonControl_autoCompleteV2_rcptList'=>$p[1],
$pref.'$saveDraftGuid'=>$par1[1],
'mhash'=>$par2[1],
'chash'=>'0',
 '__EVENTTARGET'=>$pref.'$btnSend',
'__EVENTARGUMENT'=>'Send'
);
							
//отправка сообщения юзеру
$res5=ReadMySpace("http://messaging.myspace.com/index.cfm?fuseaction=mail.messageV3&friendID=".$p[1],"http://messaging.myspace.com/index.cfm?fuseaction=mail.messageV3&friendID=".$p[1],$post_elements);
$res5=mb_convert_encoding($res5, "windows-1251", "auto")."<br>\n";
echo $res5;
?>