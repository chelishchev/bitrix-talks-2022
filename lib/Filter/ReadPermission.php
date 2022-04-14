<?php

namespace Bitrix\Talks\Filter;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Talks\Model\RightsManager;
use Bitrix\Talks\Model\Webinar;

class ReadPermission extends ActionFilter\Base
{
	public function onBeforeAction(Event $event): ?EventResult
	{
		foreach ($this->getAction()->getArguments() as $argument)
		{
			if ($argument instanceof Webinar)
			{
				if (!$this->canRead($argument))
				{
					$this->addError(new Error("Restricted access."));

					return new EventResult(EventResult::ERROR, null, null, $this);
				}
			}
		}

		return null;
	}

	private function canRead(Webinar $webinar): bool
	{
		$userId = $this->getAction()->getCurrentUser()->getId();

		return (new RightsManager($webinar))->canRead($userId);
	}
}