<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SitemapController extends Controller
{
  public function index()
  {
    $Title    = "Sitemap";
    $SubTitle = "Sitemap website";

    return response()
    ->view('sitemap.index', compact('Title', 'SubTitle'))  // Set the view and data
    ->header('Content-Type', 'text/xml'); 
  }
}
