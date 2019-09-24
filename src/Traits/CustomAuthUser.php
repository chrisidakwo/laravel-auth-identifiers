<?php

namespace ChrisIdakwo\Auth\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CustomAuthUser {
	/**
	 * Find by identifiers scope
	 *
	 * @param Builder $builder
	 * @param string|int $username
	 *
	 * @return Builder
	 */
	public function scopeFindByIdentifiers(Builder $builder, $username): Builder {
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
	 * @return array
	 */
	abstract public function getAuthIdentifiersName(): array;
}
