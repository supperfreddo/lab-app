<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'result',
        'key_id',
    ];

    protected $hidden = [
        'code',
        'result',
        'key_id',
        'EncryptionKey',
    ];

    private $aesEncrypter;

    public function EncryptionKey()
    {
        return $this->hasOne(EncryptionKey::class, 'id', 'key_id');
    }

    private function setAesEncrypter()
    {
        // Set AES encrypter
        $this->aesEncrypter = new AesEncrypter(hex2bin($this->EncryptionKey->key));
    }

    public function setKey()
    {
        // Set random key from db
        $this->attributes['key_id'] = EncryptionKey::where('active', 1)->get()->random(1)->first()->id;
    }

    public function setCode($code)
    {
        // Set encrypted code
        $this->setAesEncrypter();
        $this->attributes['code'] = $this->aesEncrypter->encryptGUID($code);
    }

    public function setResult($result)
    {
        // Set encrypted result
        $this->setAesEncrypter();
        $this->attributes['result'] = $this->aesEncrypter->encryptBoolean($result);
    }

    public function withDecryptedData()
    {
        // Set decrypted data
        $this->code_decrypted = $this->getDecryptedCode();
        $this->result_decrypted = $this->getDecryptedResult();
        return $this;
    }

    // Accessor for decrypted code
    public function getDecryptedCode()
    {
        $this->setAesEncrypter();
        return $this->aesEncrypter->decryptGUID($this->attributes['code']);
    }

    // Accessor for decrypted boolean
    public function getDecryptedResult()
    {
        $this->setAesEncrypter();
        return $this->aesEncrypter->decryptBoolean($this->attributes['result']);
    }
}
