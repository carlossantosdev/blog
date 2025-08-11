<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Post;
use App\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchImageForPost implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Post $post,
    ) {}

    public function handle(): void
    {
        if (! app()->runningUnitTests()) {
            $image = Http::get('https://picsum.photos/1280/720')
                ->throw()
                ->body();

            Storage::put($path = '/images/posts/'.Str::random().'.jpg', $image);
        } else {
            $path = null;
        }

        $this->post->update([
            'image_path' => $path,
            'image_disk' => $path !== null && $path !== '' && $path !== '0' ? config('filesystems.default') : null,
        ]);
    }
}
