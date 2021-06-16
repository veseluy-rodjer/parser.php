<?php
require_once './Documents/phpQuery-onefile.php';

function getPageByUrl ($url)
{
		// Инициализируем сеанс
		$curl = curl_init();

		// Указываем адрес страницы
		curl_setopt($curl, CURLOPT_URL, $url);

		// Ответ сервера сохранять в переменную, а не на экран
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// Переходить по редиректам
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

		// Массив устанавливаемых HTTP-заголовков
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: text/plain']);

		// Браузер
		curl_setopt($curl, CURLOPT_USERAGENT,  'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');

		// Работа с https
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

		// принимать и сохранять куки в файл
		// curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie');

		// отправлять сохраненные куки на сервер
		// curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie');

		// Отправка формы на сервер
		// curl_setopt($curl, CURLOPT_POSTFIELDS, ['protection' => 'string']);

		// Выполняем запрос:
		$result = curl_exec($curl);

		// Отлавливаем ошибки подключения
		if ($result === false) {
			echo "Ошибка CURL: " . curl_error($curl);
			return false;
		}
		else {
			return $result;
		}
}

$str = getPageByUrl('http://code.mu/exercises/advanced/php/parsing/poetapnyj-parsing-i-metod-pauka/1/index.php');
$pq = phpQuery::newDocument($str);
$links = $pq['a'];
foreach ($links as $link) {
	$link = pq($link);
	$cont[] = $link->attr('href');
}
$n = 0;
foreach ($cont as $value) {
	$n += 1;
	echo $n . ' ' . $value . "\n";
}

