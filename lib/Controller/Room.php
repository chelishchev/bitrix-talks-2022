<?php

namespace Bitrix\Talks\Controller;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\Action;
use Bitrix\Main\Engine\ActionFilter\ContentType;
use Bitrix\Main\Engine\AutoWire\ExactParameter;
use Bitrix\Main\Engine\AutoWire\Parameter;
use Bitrix\Main\Engine\Contract\FallbackActionInterface;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\JsonController;
use Bitrix\Main\Error;
use Bitrix\Main\HttpResponse;
use Bitrix\Main\Response;
use Bitrix\Talks\Filter;
use Bitrix\Talks\Model;

class Room extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [];
	}

	public function sayHelloAction(string $person): string
	{
		return "New person in room! Hi, {$person}!";
	}
}