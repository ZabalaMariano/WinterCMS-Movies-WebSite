<?php namespace MyPlugin\Movies;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'MyPlugin\Movies\Components\Actors' => 'actors',
            'MyPlugin\Movies\Components\ActorForm' => 'actorform'
        ];
    }

    public function registerSettings()
    {
    }

    public function boot(){
        \Event::listen('offline.sitesearch.query', function ($query) {

            // The controller is used to generate page URLs.
            $controller = \Cms\Classes\Controller::getController() ?? new \Cms\Classes\Controller();

            // Search your plugin's contents
            $items = Models\Movie
                ::where('name', 'like', "%${query}%")
                ->orWhere('description', 'like', "%${query}%")
                ->orWhere('year', 'like', "%${query}%")
                ->get();

            // Now build a results array
            $results = $items->map(function ($item) use ($query, $controller) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

                // Optional: Add an age penalty to older results. This makes sure that
                // newer results are listed first.
                // if ($relevance > 1 && $item->created_at) {
                //    $ageInDays = $item->created_at->diffInDays(\Illuminate\Support\Carbon::now());
                //    $relevance -= \OFFLINE\SiteSearch\Classes\Providers\ResultsProvider::agePenaltyForDays($ageInDays);
                // }

                $rta = [
                    'title'     => $item->name,
                    'text'      => $item->description,
                    'url'       => $controller->pageUrl('movies', ['slug' => $item->slug]),
                    'relevance' => $relevance
                ];

                if($item->poster){
                    $rta['thumb'] = optional($item->poster)->first(); // Instance of System\Models\File
                }

                return $rta;
                
            });

            return [
                'provider' => 'Movie', // The badge to display for this result
                'results'  => $results,
            ];
        });
    }
}
