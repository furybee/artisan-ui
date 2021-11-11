<?php

namespace FuryBee\ArtisanUi\Http\Controllers;

use FuryBee\ArtisanUi\Logic\CommandLogic;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Symfony\Component\Console\Descriptor\JsonDescriptor;
use Symfony\Component\Console\Output\BufferedOutput;

class HomeController
{
    /**
     * Returns the Artisan UI home page.
     *
     * @return View
     */
    public function __invoke()
    {
        $commands = CommandLogic::getAllCommands();

        return view('artisan-ui::layout', [
            'commands' => $commands,
            'hasVendor' => config('artisan-ui.vendor'),
        ]);
    }
}
