<?php

namespace App\Models;

use App\Models\EncryptionKey;
use Illuminate\Encryption\Encrypter;

class AesEncrypter extends Encrypter
{

    public function __construct($key)
    {
        // Initialize the parent constructor
        parent::__construct($key, 'AES-256-CBC');
    }

    public function encryptGUID($guid)
    {
        // Encrypt GUID
        return $this->encrypt($guid);
    }

    public function decryptGUID($encryptedGuid)
    {
        // Decrypt encrypted GUID
        return $this->decrypt($encryptedGuid);
    }

    public function encryptBoolean($boolean)
    {
        // Encrypt boolean
        return $this->encrypt($boolean ? 'true' : 'false');
    }

    public function decryptBoolean($encryptedBoolean)
    {
        // Decrypt the encrypted boolean
        return $this->decrypt($encryptedBoolean) === 'true';
    }
}
