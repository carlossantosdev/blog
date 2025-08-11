<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it('renders', function () {
    get(route('deals'))->assertOk();
});
