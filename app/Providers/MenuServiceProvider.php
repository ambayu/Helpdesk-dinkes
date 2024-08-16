<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Notifikasi;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //manipulation


    $filePath = base_path('resources/menu/verticalMenu.json');
    $verticalMenuJson2 = file_get_contents($filePath);
    $data = json_decode($verticalMenuJson2, true); // Decodes JSON into associative array

    $menuName = "Kirim Permintaan";

    $menu = Menu::all(); // Assuming $menu is the collection of Menu objects


    $newSubmenu = [];

    $newSubmenu[] = [
      "url" => '/front-pages/help-center',
      "name" => 'lihat Semua ',
      "slug" => '',
      "permissions" => 'submit-request'
    ];

    // Transform Menu items into desired format
    foreach ($menu as $item) {
      $newSubmenu[] = [
        "url" => 'app/layanan/' . $item->slug,        // Assuming $item->slug is the slug attribute of Menu
        "name" => $item->nama_layanan,                // Assuming $item->nama_layanan is the name attribute of Menu
        "slug" => 'kirim-permintaan.' . $item->slug,
        "permissions" => 'submit-request'                    // Assuming $item->slug is the slug attribute of Menu
      ];
    }

    // Find menu with specific name and add new submenu
    foreach ($data['menu'] as &$menu) {  // Using reference '&' to modify array directly
      if (isset($menu['name']) && $menu['name'] == $menuName) {
        if (!isset($menu['submenu'])) {
          $menu['submenu'] = [];
        }
        // Append $newSubmenu to existing submenu
        $menu['submenu'] = array_merge($menu['submenu'], $newSubmenu);
        break; // Exit loop after updating submenu
      }
    }

    // Write updated data to a new file
    $newFilePath = base_path('resources/menu/verticalMenu2.json');
    file_put_contents($newFilePath, json_encode($data, JSON_PRETTY_PRINT));


    //end

    view()->composer('*', function ($view) {

      if (isset(auth()->user()->id)) {
        $notif = Notifikasi::with('user')->where('status', '1')->where('id_user', auth()->user()->id)->take(8)->get()->map(function ($notification) {
          $notification->time_ago = $notification->created_at->diffForHumans();
          return $notification;
        });

        $notif_count = Notifikasi::where('status', 1)->where('id_user', auth()->user()->id)->count();
        $view->with('notif', $notif);
        $view->with('notif_count', $notif_count);
      }
    });


    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu2.json'));

    $verticalMenuData = json_decode($verticalMenuJson);
    $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    $horizontalMenuData = json_decode($horizontalMenuJson);

    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
  }
}
