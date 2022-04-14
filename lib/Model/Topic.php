<?php

namespace Bitrix\Talks\Model;

final class Topic implements \JsonSerializable
{
	private int $id;

	public function __construct(int $id)
	{
		$this->id = $id;
	}

	public function jsonSerialize(): array
	{
		return [
			'id' => $this->id,
		];
	}
}