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
    ];

    protected $hidden = [
        'code',
        'result',
    ];

    private $aesEncrypter;

    public function __construct()
    {
        if(!isset($this->key_id))
            $this->setKey();
        $this->aesEncrypter = new AesEncrypter($this->key_id);
    }

    // TODO
    // public function EncryptionKey()
    // {
    //     return $this->belongsTo(EncryptionKey::class);
    // }

    private function setKey()
    {
        $this->attributes['key_id'] = EncryptionKey::where('active', 1)->get()->random(1)->first()->id;
    }

    public function setCode($code)
    {
        $this->attributes['code'] = $this->aesEncrypter->encryptGUID($code);
    }

    public function setResult($result)
    {
        $this->attributes['result'] = $this->aesEncrypter->encryptBoolean($result);
    }

    public function withDecryptedData()
    {
        $this->code_decrypted = $this->aesEncrypter->decryptGUID($this->attributes['code']);
        $this->result_decrypted = $this->aesEncrypter->decryptBoolean($this->attributes['result']);
        return $this;
    }

    // Accessor for decrypted code
    public function getDecryptedCode()
    {
        return $this->aesEncrypter->decryptGUID($this->attributes['code']);
    }

    // Accessor for decrypted boolean
    public function getDecryptedResult()
    {
        return $this->aesEncrypter->decryptBoolean($this->attributes['result']);
    }
}
