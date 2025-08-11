<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Metric;
use App\Models\User;

class MetricPolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Metric $metric): bool
    {
        return false;
    }

    public function delete(User $user, Metric $metric): bool
    {
        return false;
    }
}
