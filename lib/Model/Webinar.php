<?php

namespace Bitrix\Talks\Model;

final class Webinar implements \JsonSerializable
{
	private string $name;
	private int $year;
	private ?Topic $topic = null;

	public function __construct(string $name, int $year)
	{
		$this->name = $name;
		$this->year = $year;
	}

	public function getTopic(): ?Topic
	{
		return $this->topic;
	}

	public function setTopic(Topic $topic): void
	{
		$this->topic = $topic;
	}

	public function jsonSerialize(): array
	{
		return array_filter([
			'name' => $this->name,
			'year' => $this->year,
			'topic' => $this->getTopic(),
		]);
	}
}