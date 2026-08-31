<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

/**
 * The front end ships as hand-authored CSS partials and ES modules served
 * straight from public/, with no bundler in the loop. This derives a cache
 * key from the newest mtime across those trees, so any edit invalidates the
 * entry point that browsers request.
 */
class Assets
{
    private static ?string $version = null;

    /** @var list<string> */
    private const TREES = ['css', 'js'];

    public static function version(): string
    {
        if (self::$version !== null) {
            return self::$version;
        }

        $newest = 0;

        foreach (self::TREES as $tree) {
            $path = public_path($tree);

            if (! File::isDirectory($path)) {
                continue;
            }

            foreach (File::allFiles($path) as $file) {
                $newest = max($newest, $file->getMTime());
            }
        }

        return self::$version = (string) $newest;
    }
}
