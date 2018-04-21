<?php
namespace AppBundle\Services;
/**
 * Created by PhpStorm.
 * User: Benhbenny
 * Date: 21/04/2018
 * Time: 09:48
 */
class BlackMirorService
{


    /**
     * @param $method
     * @param $url
     * @param bool $data
     * @param $token
     * @return mixed
     */
    public function getOrPostFromAPI($method, $url, $data = false, $token = null)
    {

        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                if ($data){
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        if($token){
            curl_setopt($curl,CURLOPT_HTTPHEADER, array(
                "x-auth-token: ".$token
            ));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
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