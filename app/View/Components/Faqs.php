<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Faqs extends Component
{
    /**
     * Create a new component instance.
     */

    public $pertanyaanUmum;
    public $privasiData;

    public function __construct($pertanyaanUmum, $privasiData)
    {
      $this->pertanyaanUmum = $pertanyaanUmum;
      $this->privasiData    = $privasiData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.faqs');
    }
}
