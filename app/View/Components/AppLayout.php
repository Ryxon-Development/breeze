<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

//By default this layout class file doesn't need this file to be created, the layout can simply be called by: <x-app-layout />
//1. However, if you want to pass data to the layout, you can do so by creating this file and passing the data to the view.
//2. This layout can now be called by class name AppLayout, and data can be passed to it.
////Example: In a controller or PHP code
//return view('some.view', ['layout' => new AppLayout]);
//// In a Blade view
//{{ $layout }}

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
