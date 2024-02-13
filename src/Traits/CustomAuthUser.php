<?php

declare(strict_types=1);

namespace ChrisIdakwo\Auth\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CustomAuthUser
{
	/**
	 * Find by identifiers scope
	 */
	public function scopeFindByIdentifiers(Builder $builder, int|string $username): Builder
    {
		$identifiers = $this->getAuthIdentifiersName();
		$builder->where(static function ($query) use ($identifiers, $username) {
			foreach ($identifiers as $key) {
				$query->orWhere($key, '=', $username);
			}
		});
		return $builder;
	}

	/**
	 * Get the name of the unique identifier for the user.
	 *
	 * You can list as many items as possible in the array, or just one item.
	 *
	 * @return array<string>
	 */
	abstract public function getAuthIdentifiersName(): array;
}
