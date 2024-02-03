<?php

/*TDD*/

declare(strict_types=1);

require_once(__DIR__ . "/../../vendor/autoload.php");

use PST\Testing\Should;
use PST\Testing\Exceptions\ShouldException;

try {
    Should::haveMethod(
        'PST\Testing\Should',

        "beTrue",
        "notBeTrue",
        "beFalse",
        "notBeFalse",
        "beNull",
        "notBeNull",
        "haveMethod",
        "notHaveMethod",
        "beA",
        "notBeA"
    );

    Should::beTrue(true, true);
    Should::notBeTrue(false, false);
    Should::beFalse(false, false);
    Should::notBeFalse(true, true);
    Should::beNull(null, null);
    Should::notBeNull(true, true);
    Should::beA('PST\Testing\Should','PST\Testing\Should','PST\Testing\Should');
    Should::notBeA('PST\Testing\Should', 'PST\Testing\Exceptions\ShouldException', 'PST\Testing\Exceptions\ShouldException');

} catch (ShouldException $e) {
    print_r($e->getMessage() . "\n");


} catch (Throwable $e) {
    throw $e;
}

