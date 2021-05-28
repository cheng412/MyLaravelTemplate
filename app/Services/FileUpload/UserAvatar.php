<?php

namespace App\Services\FileUpload;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserAvatar
{
    protected $file;
    protected $user;
    protected $path;

    const FILE_PATH = 'users';
    const FILE_DISK = 'public';

    public function __construct($file, User $user)
    {
        $this->file = $file;
        $this->user = $user;
    }

    public function upload()
    {
        if ($this->user->avatar)
            $this->deleteOldFile();

        $this->path = Storage::disk(self::FILE_DISK)->putFile(self::FILE_PATH, $this->file);

        $this->user->update([
            'avatar' => $this->path
        ]);

        return $this->path;
    }

    private function deleteOldFile()
    {
        Storage::disk(self::FILE_DISK)->delete($this->user->avatar);
    }
}