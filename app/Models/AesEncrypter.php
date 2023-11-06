<?php

namespace App\Models;

use App\Models\EncryptionKey;
use Illuminate\Encryption\Encrypter;

class AesEncrypter extends Encrypter
{

    public function __construct($key_id)
    {
        // Initialize the parent constructor
        parent::__construct(hex2bin($this->getKeyById($key_id)), 'AES-256-CBC');
    }

    public function getKeyById($key_id)
    {
        $key = EncryptionKey::find($key_id);
        if(isset($key))
            return $key->key;
        else
            return env('AES_KEY');
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
