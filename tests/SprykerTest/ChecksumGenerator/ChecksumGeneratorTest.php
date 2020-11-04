<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\ChecksumGenerator;

use Codeception\Test\Unit;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group ChecksumGenerator
 * @group ChecksumGeneratorTest
 * Add your own group annotations below this line
 */
class ChecksumGeneratorTest extends Unit
{
    protected const ENCRYPTION_KEY = 'change123';
    protected const FAKE_ENCRYPTION_KEY = 'fake_encryption_key';

    /**
     * @var \SprykerTest\ChecksumGenerator\ChecksumGeneratorTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testGenerateProductConfigurationDataChecksumGeneratesEncodedCheckSum(): void
    {
        // Arrange
        $productConfiguration = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
            'fakeKey3' => 'fakeValue3',
        ];

        // Act
        $encodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($productConfiguration, static::ENCRYPTION_KEY);

        // Assert
        // Assert
        $this->assertSame(
            32,
            mb_strlen($encodedCheckSum),
            'Expects that string length will be equal to the predefined value (32).'
        );
    }

    /**
     * @return void
     */
    public function testGenerateProductConfigurationDataChecksumGeneratesEncodedCheckSumForEmptyConfiguration(): void
    {
        // Arrange
        $productConfiguration = [];

        // Act
        $encodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($productConfiguration, static::ENCRYPTION_KEY);

        // Assert
        $this->assertSame(
            32,
            mb_strlen($encodedCheckSum),
            'Expects that string length will be equal to the predefined value (32).'
        );
    }

    /**
     * @return void
     */
    public function testGenerateProductConfigurationDataChecksumTryToUseAnotherEncryptionKey(): void
    {
        // Arrange
        $productConfiguration = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
        ];

        // Act
        $firstEncodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($productConfiguration, static::ENCRYPTION_KEY);

        $secondEncodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($productConfiguration, static::FAKE_ENCRYPTION_KEY);

        // Assert
        $this->assertNotSame(
            $firstEncodedCheckSum,
            $secondEncodedCheckSum,
            'Expects different checksum will be generated.'
        );
    }

    /**
     * @return void
     */
    public function testGenerateProductConfigurationDataChecksumCompareTwoChecksumWithSameProductConfigurations(): void
    {
        // Arrange
        $productConfiguration = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
        ];

        // Act
        $firstEncodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($productConfiguration, static::ENCRYPTION_KEY);

        $secondEncodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($productConfiguration, static::ENCRYPTION_KEY);

        // Assert
        $this->assertSame(
            $firstEncodedCheckSum,
            $secondEncodedCheckSum,
            'Expects equal checksum values when same data.'
        );
    }

    /**
     * @return void
     */
    public function testGenerateProductConfigurationDataChecksumCompareTwoChecksumWithDifferentProductConfigurations(): void
    {
        // Arrange
        $firstProductConfiguration = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
        ];

        $secondProductConfiguration = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'differentFakeValue2',
        ];

        // Act
        $firstEncodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($firstProductConfiguration, static::ENCRYPTION_KEY);

        $secondEncodedCheckSum = $this->tester->getCrcProductConfigurationDataChecksumGenerator()
            ->generateChecksum($secondProductConfiguration, static::ENCRYPTION_KEY);

        // Assert
        $this->assertNotSame(
            $firstEncodedCheckSum,
            $secondEncodedCheckSum,
            'Expects not equal checksum values with different data.'
        );
    }
}
