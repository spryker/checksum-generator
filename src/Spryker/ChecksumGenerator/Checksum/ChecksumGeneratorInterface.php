<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\ChecksumGenerator\Checksum;

interface ChecksumGeneratorInterface
{
    /**
     * Specification:
     * - Serializes the given data.
     * - Based on serialized data generates checksum.
     * - Encrypts a checksum.
     * - Encodes encrypted checksum.
     * - Returns the encoded checksum.
     *
     * @param array $data
     * @param string $encryptionKey
     *
     * @return string
     */
    public function generateChecksum(array $data, string $encryptionKey): string;
}
