<?php

namespace Bitrix\Talks\Filter;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;

class LocalSubnet extends ActionFilter\Base
{
	private $nets = [
		'192.168.',
		'127.0.0.1',
	];

	public function onBeforeAction(Event $event): ?EventResult
	{
		$remoteAddress = Context::getCurrent()->getServer()->getRemoteAddr();

		if (!$remoteAddress || !$this->isAllowed($remoteAddress))
		{
			$this->addError(new Error("Only for local subnet."));

			return new EventResult(EventResult::ERROR, null, null, $this);
		}

		return null;
	}

	private function isAllowed(string $ip): bool
	{
		foreach ($this->nets as $net)
		{
			if (strpos($ip, $net) === 0)
			{
				return true;
			}
		}

		return false;
	}
}