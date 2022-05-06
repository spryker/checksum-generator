<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\ChecksumGenerator\Checksum;

class CrcOpenSslChecksumGenerator implements ChecksumGeneratorInterface
{
    /**
     * @var string
     */
    protected const ENCRYPTION_METHOD = 'aes256';

    /**
     * @var string
     */
    protected $hexInitializationVector;

    /**
     * @param string $hexInitializationVector
     */
    public function __construct(string $hexInitializationVector)
    {
        $this->hexInitializationVector = $hexInitializationVector;
    }

    /**
     * {@inheritDoc}
     * - Serializes the given data.
     * - Based on serialized data generates `crc32` checksum.
     * - Converts initialization vector to its binary representation.
     * - Encrypts a checksum using OpenSSL.
     * - Encodes encrypted checksum with base64 algorithm.
     * - Returns the encoded checksum.
     *
     * @param array $data
     * @param string $encryptionKey
     *
     * @return string
     */
    public function generateChecksum(array $data, string $encryptionKey): string
    {
        $dataCheckSum = $this->prepareDataCheckSum($data);

        $encryptedCheckSum = $this->encrypt((string)$dataCheckSum, $encryptionKey);

        return base64_encode($encryptedCheckSum);
    }

    /**
     * @param string $dataCheckSum
     * @param string $encryptionKey
     *
     * @return string|false
     */
    protected function encrypt(string $dataCheckSum, string $encryptionKey)
    {
        return openssl_encrypt(
            $dataCheckSum,
            static::ENCRYPTION_METHOD,
            $encryptionKey,
            0,
            $this->getInitializationVector(),
        );
    }

    /**
     * @param array $data
     *
     * @return int
     */
    protected function prepareDataCheckSum(array $data): int
    {
        $serializedData = serialize($data);

        return crc32($serializedData);
    }

    /**
     * @return string|false
     */
    protected function getInitializationVector()
    {
        return hex2bin($this->hexInitializationVector);
    }
}
