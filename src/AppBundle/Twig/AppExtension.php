<?php
namespace AppBundle\Twig;
/**
 * Created by PhpStorm.
 * User: Benhbenny
 * Date: 21/04/2018
 * Time: 11:58
 */
class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('orderSeasons', array($this, 'orderSeasonAndEpisodes')),
        );
    }

    public function orderSeasonAndEpisodes($episodes)
    {
        $seasonKeys =[];
        $seasons = [];
        foreach ($episodes as $episode) {
            if(!in_array($episode['season'], $seasonKeys)){
                $key = $episode['season'];
                $seasonKeys [] = $episode['season'];
            }
            $seasons[$key][$episode['number']]= $episode;
        }

        return $seasons;
    }
}