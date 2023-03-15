<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

/**
 * USER HAS AVATAR
 */
trait HasAvatar
{
    //todo updateAvatar,deleteAvatar,getAvatar,defaultUrl
    /**
     * Upload avatar
     */
    public function updateAvatar()
    {
        // $avatarData = file_get_contents(fake()->imageUrl());
        // $avatarName = "avatars/" . fake()->uuid() . '.png';
        // Storage::put($avatarName, $avatarData, 'public');
        // $avatar = Storage::getCLient()->getObjectUrl('eboard', $avatarName);
    }

    /**
     * Get avatar
     */
    public function avatarUrl(): Attribute
    {
        return Attribute::get(
            function () {
                return $this->avatar ? Storage::getCLient()->getObjectUrl('eboard', $this->avatar) : $this->defaultUrl();
            }
        );
    }

    /**
     * Get if no avatar url is in database.
     */
    private function defaultUrl()
    {
        $name = urlencode($this->first_name . " " . $this->last_name);
        return "https://ui-avatars.com/api/?name={$name}&color=#060406&background=#DFF3E4";
    }
}
