<?php

namespace Jaikumar0101\LivewireEditor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string assets(string|null $editor = null)
 * @method static string css()
 * @method static string js(string|null $editor = null)
 * @method static string alpineJs()
 * @method static void resetAssets()
 *
 * @see \Jaikumar0101\LivewireEditor\LivewireEditorManager
 */
class LivewireEditor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewire-editor';
    }
}
