<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\ChecksumGenerator;

use Codeception\Actor;
use Spryker\ChecksumGenerator\Checksum\ChecksumGeneratorInterface;
use Spryker\ChecksumGenerator\Checksum\CrcOpenSslChecksumGenerator;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class ChecksumGeneratorTester extends Actor
{
    use _generated\ChecksumGeneratorTesterActions;

    /**
     * @return \Spryker\ChecksumGenerator\Checksum\ChecksumGeneratorInterface
     */
    public function getCrcProductConfigurationDataChecksumGenerator(): ChecksumGeneratorInterface
    {
        return new CrcOpenSslChecksumGenerator('0c1ffefeebdab4a3d839d0e52590c9a2');
    }
}
