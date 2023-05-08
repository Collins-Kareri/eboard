<?php

namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

/**
 * USER HAS AVATAR
 */
trait HasAvatar
{
    //todo updateAvatar,deleteAvatar,getAvatar,defaultUrl
    /**
     * Generate avatar name
     */
    private function generateName()
    {
        $names=Str::of($this->full_name)->explode(" ");
        $initials="";
        $randomUlid=Str::ulid(Carbon::now());

        for($index=0;$index<count($names);$index++) {
            $initials=$initials.$names[$index][0];
        }

        return Str::lower("{$initials}-eboard-{$randomUlid}");
    }

    /**
     * Upload avatar
     */
    public function updateAvatar(UploadedFile $file)
    {
        $filePath= $this->avatar ?? $this->generateName().'.'.$file->extension();

        // store in minio
        $imageName=$file->storePubliclyAs('', $filePath);

        $this->update([
            'avatar'=>$imageName
        ]);
    }

     /**
     * Delete avatar
     */
    public function deleteAvatar()
    {
        $deleteRes=Storage::delete($this->avatar);

        if($deleteRes) {
            $this->update([
                        'avatar'=>null
                    ]);
        }
    }

    /**
     * Get avatar
     */
    public function avatarUrl(): Attribute
    {
        return Attribute::get(
            function () {
                return $this->avatar ? env('AWS_URL').'/'.env('AWS_BUCKET').'/'.$this->avatar : $this->defaultUrl();
            }
        );
    }

    /**
     * Get if no avatar url is in database.
     */
    private function defaultUrl()
    {
        $name = urlencode($this->full_name);
        return "https://ui-avatars.com/api/?name={$name}&color=#060406&background=#DFF3E4";
    }
}
