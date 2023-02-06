<?php

namespace App\Services;


/*
 * this service uses 2 libraries to talk to the spotify api
 *      Aerni\Spotify\Spotify : can talk to the spotify api without user tokens: just used to search for tracks
 *      SpotifyWebAPI : can talk to spotify api with user tokens: used for creating playlists for user
 */


use Illuminate\Support\Collection;

class SearchService
{
    protected Collection $cachedResults;

    // split into separate parts and try to find songs for each parts
    // try to search for parts with more words per part first
    // last try : every individual word as separate part
    // if a result has been found before the last try: abort by breaking the loops
    public function splitAndSearch($text)
    {
        // optimizing:
        // keep track of what has been requested from the api, so we dont do unnecessary double lookups
        $this->cachedResults = collect();

        // reverse the list so the groups with more words are at the beginning
        $solutionCandidates = $this->split($text)->reverse();

        foreach ($solutionCandidates as $solutionCandidate) {
            $parts = explode('/', $solutionCandidate);

            $allValid = true;
            foreach ($parts as $part) {
                if ($this->cachedResults->contains('id', $part)) {

                    $cachedResult = $this->cachedResults->where('id', $part)->first();
                    if ($cachedResult && !$cachedResult['object']) {
//                        break;
                        $allValid = false;
                    }
                } else {
                    $searchResult = $this->search($part);

                    if ($searchResult) {
                        $this->cachedResults->push(
                            ['id' => $part, 'object' => $searchResult],
                        );
                    } else {
                        $allValid = false;
                        $this->cachedResults->push(
                            ['id' => $part, 'object' => null],
                        );
//                        break;
                    }
                }
            }

            if ($allValid) {
                break;
            }
        }

        $list = $this->transformSolution($solutionCandidate);
        return $list;
    }

    public function search(string $text)
    {
//        echo('searching for = ' . $text);
//        echo('<br />');

        $spotifyService = new SpotifyService();
        $result = $spotifyService->search($text);

        return $result;
    }

    private function split(string $text)
    {
        $spaceCount = substr_count($text, ' ');

        if ($spaceCount < 1) {
            return collect($text);
        }

        $results = collect();


        if ($spaceCount > 0) {
//            $halve = floor($spaceCount / 2);
//            $parts = $this->split2($text, ' ', $halve);
//            $solutions1 = $this->split($parts[0]);
//            $solutions2 = $this->split($parts[1]);
//
//            foreach ($solutions1 as $solution1) {
//                foreach ($solutions2 as $solution2) {
//                    $solution = $solution1 . '/' . $solution2;
//                    $results->push($solution);
//                }
//            }

            for ($cutOff = 1; $cutOff <= $spaceCount; $cutOff++) {
//                echo($cutOff);
//                echo(' : ');
                $parts = $this->split2($text, ' ', $cutOff);
//                echo($parts[0]);
//                echo(' //// ');
//                echo($parts[1]);
//                echo('<hr>');

                $solutions1 = $this->split($parts[0]);
                $solutions2 = $this->split($parts[1]);

                foreach ($solutions1 as $solution1) {
                    foreach ($solutions2 as $solution2) {
                        $solution = $solution1 . '/' . $solution2;
                        $results->push($solution);
                    }
                }
            }
        }

        if ($spaceCount < 3) {
            $results->push($text);
        }

        return $results->unique();
    }

    // https://stackoverflow.com/questions/5956066/how-can-i-split-a-string-in-php-at-the-nth-occurrence-of-a-needle
    private function split2($string, $needle, $nth)
    {
        $max = strlen($string);
        $n = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($string[$i] == $needle) {
                $n++;
                if ($n >= $nth) {
                    break;
                }
            }
        }
        $arr[] = substr($string, 0, $i);
        $arr[] = substr($string, $i + 1, $max);

        return $arr;
    }

    private function transformSolution($object)
    {
        $results = collect();

        $parts = explode('/', $object);
        foreach ($parts as $part) {
            if ($this->cachedResults->contains('id', $part)) {
                $cachedResult = $this->cachedResults->where('id', $part)->first();
                $results->push($cachedResult);
            }
        }

        $list = $results->map(function ($item) {


            if (isset($item['object'])) {
                $artist = array_map(function ($artistArray) {
                    return $artistArray['name'];

                }, $item['object']['artists']);
                $name = $item['object']['name'];
            } else {
                $artist = [''];
                $name = '';
            }

            return [
                'name' => $name,
                'artist' => $artist,
            ];
        });

        return $list;
    }
}
