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
use Bitrix\Main\Engine\JsonPayload;
use Bitrix\Main\Error;
use Bitrix\Main\HttpResponse;
use Bitrix\Main\Response;
use Bitrix\Talks\Filter;
use Bitrix\Talks\Model;

class Webinar extends JsonController implements FallbackActionInterface
{
	public function configureActions()
	{
		return [
			'showMembers' => [
				'+prefilters' => [
					new Filter\LocalSubnet(),
					new Filter\ReadPermission(),
				],
			]
		];
	}

	protected function getDefaultPreFilters()
	{
		return [
			new ContentType([ContentType::JSON]),
		];
	}

	public function getAutoWiredParameters(): array
	{
		return [
			new ExactParameter(
				Model\Webinar::class,
				'webinar',
				function($className, string $name, int $year, Model\Topic $topic) {
					$webinar = new Model\Webinar($name, $year);
					$webinar->setTopic($topic);

					return $webinar;
				}
			),
			new Parameter(
				Model\Topic::class,
				function($className, int $id) {
					return new Model\Topic($id);
				}
			),
		];
	}

	public function showMembersAction(Model\Webinar $webinar, bool $active, JsonPayload $payload): array
	{
		return [
			'active' => $active,
			'webinar' => $webinar,
			'members' => [
				'Ivan',
				'Oleg',
			],
		];
	}

	public function getAction(): array
	{
		return $this->convertKeysToCamelCase([
			'IBLOCK_ID' => 1,
		]);
	}

	// public function fallbackAction($actionName)
	// {
	// 	return $this->forward(new Room(), $actionName);
	// }

	public function fallbackAction($actionName)
	{
		return $this->forward(new Room(), $actionName, [
			'person' => 'Ivan',
		]);
	}
}