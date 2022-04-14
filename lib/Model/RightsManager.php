<?php

namespace Bitrix\Talks\Model;

final class RightsManager
{
	private Webinar $webinar;

	public function __construct(Webinar $webinar)
	{
		$this->webinar = $webinar;
	}

	public function canRead($userId): bool
	{
		return $userId !== null;
	}
}