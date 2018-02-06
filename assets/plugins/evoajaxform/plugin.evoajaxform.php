<?php
/*
@TODO:
— Плагин Evolution CMS для обработки ajax запроса с форм
*/
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}

$e = &$modx->event;

// Если это ajax формы
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
	// Если $_POST["formid"] существует и не пустой
	if(!empty($_POST["formid"])):
		// switch Event Name
		switch($e->name){
			case "OnWebPageInit":
				// Задаём $_GET["formid_ajax"] для кеширования
				$_GET["formid_ajax"] = "formid_ajax";
				break;
			case "OnLoadWebPageCache":
				// Если из кеша
				// Пока оставим. Вдруг в будущем отвалится.
				// Хрен знает, что там намутят по API
				/*
				$modx->documentObject = [];
				$modx->documentOutput = $modx->documentContent = '';
				*/
				break;
			case "OnLoadDocumentObject":
				// Если не из кеша
				// Сбрасываем вывод
				$modx->documentOutput = $modx->documentContent = '';
				// Подменяем шаблон
				$modx->documentObject['template'] = 11;
				// Подменяем заголовок ответа
				$modx->contentTypes[$modx->documentObject['id']] = "application/json";
				break;
		}
		// switch Event Name end
	endif;
endif;