<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Podcast;

class PodcastCtrl extends Controller
{
    public function getPodcasts() {
        return Podcast::with('sources')
                        ->get()
                        ->makeHidden([
                            'desc_long'
                        ])
                        ->toJson();
    }

    public function getPodcast(Request $request, $id) {
        return Podcast::with('sources')
                ->find($id)
                ->makeHidden([
                    'desc_short'
                ])
                ->toJson();
    }

    // Get Podcasts
    public function xgetPodcasts() {
        $arr = [
            [
              'id' => 1,
              'type' => 'audio',
              'title' => 'EPISODE #03 - Was ich alles in meiner Botschafterausbildung lernte',
              'desc_short' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!',
              'desc_long' => '<strong>Rerum</strong>, consequuntur tempora quidem debitis dolores Deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!',
              'image' => 'https://semantic-ui.com/images/wireframe/image.png',
              'sources' => [
                [
                  'src' => 'https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/stratosphere.mp3',
                  'type' => 'audio/mp3'
                ]
              ]
            ],
            [
              'id' => 2,
              'type' => 'audio',
              'title' => 'EPISODE #05 - Was ich alles in meiner Botschafterausbildung lernte',
              'desc_short' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!',
              'desc_long' => '<strong>Rerum</strong>, consequuntur tempora quidem debitis dolores Deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!',
              'image' => asset('/media/images/6898628.jpg'),
              'sources' => [
                [
                  'src' => 'https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/cooking.mp3',
                  'type' => 'audio/mp3'
                ]
              ]
            ],
            [
              'id' => 3,
              'type' => 'audio',
              'title' => 'EPISODE #07 - Was ich alles in meiner lernen kann',
              'desc_short' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!',
              'desc_long' => '<strong>Rerum</strong>, consequuntur tempora quidem debitis dolores Deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, consequuntur tempora quidem debitis dolores deleniti repellat veniam dicta minima rem soluta, provident accusantium consequatur voluptatibus nisi eum animi officiis eligendi!',
              'image' => 'https://semantic-ui.com/images/wireframe/image.png',
              'sources' => [
                [
                  'src' => 'https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/the-landing.mp3',
                  'type' => 'audio/mp3'
                ]
              ]
            ]
        ];
        return json_encode($arr);
    }
}
