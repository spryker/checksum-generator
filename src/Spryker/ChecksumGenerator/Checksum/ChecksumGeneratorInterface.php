<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
