<?php

use App\Models\Navigation;
use App\Models\Role;
use App\Models\DocumentModel;
use App\Models\FaqModel;
use App\Models\User;
use Carbon\Carbon;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->orderBy('sort', 'desc')->get();
    }
}

if (!function_exists('getParentMenus')) {
    function getParentMenus($url)
    {
        $menu = Navigation::where('url', $url)->first();
        if ($menu) {
            $parentMenu = Navigation::select('name')->where('id', $menu->main_menu)->first();
            return $parentMenu->name ?? '';
        }
        return '';
    }
}


if (!function_exists('getRoles')) {
    function getRoles()
    {
        return Role::where('name', '!=', 'admin')->get();
    }
}

if (!function_exists('getPertanyaanUmum')) {
    function getPertanyaanUmum()
    {
      return FaqModel::where('StatusAktivasi', 'Aktif')->where('TypePertanyaan', 'PU')->get();
    }
}

if (!function_exists('getPrivasiData')) {
    function getPrivasiData()
    {
      return FaqModel::where('StatusAktivasi', 'Aktif')->where('TypePertanyaan', 'PD')->get();
    }
}

if (!function_exists('getPhotoUser')) {
  function getPhotoUser()
  {
    $data = DocumentModel::where('CreatedBy', Auth::user()->id)->where('TypeDokumen', 'Foto')->first();
    
    return $data;
  }
}

if (!function_exists('getUsiaPelamar')) {
  function getUsiaPelamar($date)
  {
    $data = Carbon::parse($date)->age;
    
    return $data;
  }
}

function capitalizeWords($text) {
  // Split the text into words
  $words = explode(" ", $text);
  // Capitalize the first letter of each word
  $capitalizedWords = array_map('ucfirst', $words);
  // Join the capitalized words back into a string
  return implode(" ", $capitalizedWords);
}

function formatDate($dateString) {
  $date = DateTime::createFromFormat('Y-m-d', $dateString);
  if ($date) {
    return $date->format('d-m-Y');
  } else {
    // Handle invalid date format (optional)
    return null; // Or throw an exception
  }
}

if (!function_exists('ShowHideMenu')) {
  function ShowHideMenu()
  {
    $CheckUser = User::where('id', Auth::user()->id)->first();
    
    return $CheckUser;
  }
}