<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
    public function testGenerateChecksumGeneratesEncodedCheckSum(): void
    {
        // Arrange
        $data = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
            'fakeKey3' => 'fakeValue3',
        ];

        // Act
        $encodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($data, static::ENCRYPTION_KEY);

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
    public function testGenerateChecksumGeneratesEncodedCheckSumForEmptyConfiguration(): void
    {
        // Arrange
        $data = [];

        // Act
        $encodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($data, static::ENCRYPTION_KEY);

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
    public function testGenerateChecksumTryToUseAnotherEncryptionKey(): void
    {
        // Arrange
        $data = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
        ];

        // Act
        $firstEncodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($data, static::ENCRYPTION_KEY);

        $secondEncodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($data, static::FAKE_ENCRYPTION_KEY);

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
    public function testGenerateChecksumCompareTwoChecksumWithSameProductConfigurations(): void
    {
        // Arrange
        $data = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
        ];

        // Act
        $firstEncodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($data, static::ENCRYPTION_KEY);

        $secondEncodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($data, static::ENCRYPTION_KEY);

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
    public function testGenerateChecksumCompareTwoChecksumWithDifferentProductConfigurations(): void
    {
        // Arrange
        $firstData = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'fakeValue2',
        ];

        $secondData = [
            'fakeKey1' => 'fakeValue1',
            'fakeKey2' => 'differentFakeValue2',
        ];

        // Act
        $firstEncodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($firstData, static::ENCRYPTION_KEY);

        $secondEncodedCheckSum = $this->tester->getCrcOpenSslChecksumGenerator()
            ->generateChecksum($secondData, static::ENCRYPTION_KEY);

        // Assert
        $this->assertNotSame(
            $firstEncodedCheckSum,
            $secondEncodedCheckSum,
            'Expects not equal checksum values with different data.'
        );
    }
}
