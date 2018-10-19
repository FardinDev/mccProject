<?php


$accessToken = "*SECRET-KEY*"; //secret-key-goes-here


$fromFB = json_decode(file_get_contents('php://input'), true);

$senderId = $fromFB['entry'][0]['messaging'][0]['sender']['id'];

$message = $fromFB['entry'][0]['messaging'][0]['message']['text'];

$postBack = $fromFB['entry'][0]['standby'][0]['postback']['title'];

$defaultButtons = [
    [
        "type" => "postback",
        "title" => "List",
        "payload" => "list"
    ],
    [
        "type" => "postback",
        "title" => "Video",
        "payload" => "video"
    ],
    [
        "type" => "postback",
        "title" => "Grid",
        "payload" => "grid"
    ],

];

if (!empty($message) || !empty($postBack)) {
    $botReply = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
            "template_type"=>"button",
            "text"=>"Instruction for '".$message."' Not found :( Please type or Select any option listed below! :)",
            "buttons"=> $defaultButtons
        ]
        ]];

    //postbacks-responses
    $postBack = strtoupper($postBack);
    if ($postBack == "LIST") {
        $senderId = $fromFB['entry'][0]['standby'][0]['sender']['id'];
        $message = 'LIST';
    } elseif ($postBack == "VIDEO") {
        $senderId = $fromFB['entry'][0]['standby'][0]['sender']['id'];
        $message = 'VIDEO';
    } elseif ($postBack == "GRID") {
        $senderId = $fromFB['entry'][0]['standby'][0]['sender']['id'];
        $message = 'GRID';
    }



    //message-respones
    $message = strtoupper($message);

    if ($message == "HI" || $message == "HELLO") {
        //hi-hello-response
        $botReply = ["attachment"=>[
            "type"=>"template",
            "payload"=>[
                "template_type"=>"button",
                "text"=>"Hello :)  To View templates Type or select any option listed below!",
                "buttons"=> $defaultButtons
            ]
            ]];
    } elseif ($message == "BUTTON") {
        //simple-button
        $botReply = ["attachment"=>[
            "type"=>"template",
            "payload"=>[
              "template_type"=>"button",
              "text"=>"My eCommerce Website",
              "buttons"=>[
                [
                  "type"=>"web_url",
                  "url"=>"https://www.laravel-ecommerce.xyz",
                  "title"=>"Go To Website"
                ]
              ]
            ]
            ]];
    } elseif ($message == 'LIST') {
        //lists
        $botReply = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
        "template_type"=>"list",
        "elements"=>[
          [
            "title"=> "TechShop | A Smarter Way To Shop From A Smatter Shop ;)",
            "image_url"=> "https://www.laravel-ecommerce.cf/home.jpg",
            "subtitle"=> "View All Tech Products We Got For You",
            "default_action"=> [
                                "type"=> "web_url",
                                "url"=> "https://www.laravel-ecommerce.cf/",
                                "webview_height_ratio"=> "tall",
                                ],
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://www.laravel-ecommerce.cf/",
                "title"=>"Go To Website"
              ],
            ]
          ],
            [
            "title"=>"Iphone Sale",
            "item_url"=>"https://www.laravel-ecommerce.cf/shop/54",
            "image_url"=>"https://www.laravel-ecommerce.cf/storage/products/July2018/WTSpmDO3Zq5w6RGQTKdu.jpg",
            "subtitle"=>"Enjoy Easy Shopping",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://www.laravel-ecommerce.cf/shop/54",
                "title"=>"Shop"
              ],
            ]
          ],
            [
            "title"=>"The New MacBook Pro",
            "item_url"=>"https://www.laravel-ecommerce.cf/shop/8",
            "image_url"=>"https://www.laravel-ecommerce.cf/storage/products\July2018\laptop-8.jpg",
            "subtitle"=>"The Fastest NoteBook Ever Build",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"https://www.laravel-ecommerce.cf/shop/8",
                "title"=>"Shop"
              ],
            ]
          ]

        ]
      ]
    ]];
    } elseif ($message == "VIDEO") {
        //video
        $botReply = ["attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"media",
      "elements"=>[
        [
            "media_type" => "video",
            "url" => "https://www.facebook.com/mccltdbangladesh/videos/1452296188145067/",
          "buttons"=>[
            [
              "type"=>"web_url",
              "url"=>"https://www.facebook.com/mccltdbangladesh/?eid=ARCxQx1x7x552RwGiVbEFtDDiO4xkstOtaZiVBKyadHa_ckIpq8gy_dGcR7UvihPWJugwEK2-wEpEqzc",
              "title"=>"Visit This Page"
            ],
          ]
        ]

      ]
    ]
  ]];
    } elseif ($message == "GRID") {
        //scrollable-grid
        $botReply = ["attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"generic",
      "elements"=>[
            //single-item-stats
            [
                "title"=> "TechShop | A Smarter Way To Shop From A Smatter Shop ;)",
                "image_url"=> "https://www.laravel-ecommerce.cf/home.jpg",
                "subtitle"=> "View All Tech Products We Got For You",
                "default_action"=> [
	                                  "type"=> "web_url",
	                                  "url"=> "https://www.laravel-ecommerce.cf/",
	                                  "webview_height_ratio"=> "full",
	                                  ],
                "buttons"=>[
                    [
                        "type"=>"web_url",
                        "url"=>"https://www.laravel-ecommerce.cf/",
                        "title"=>"Go To Website"
                    ],
                ]
                ],
                //single-item-ends
                [
                    "title"=> "Iphone Sale",
                    "image_url"=> "https://www.laravel-ecommerce.cf/storage/products/July2018/WTSpmDO3Zq5w6RGQTKdu.jpg",
                    "subtitle"=> "Enjoy Easy Shopping",
                    "default_action"=> [
                                        "type"=> "web_url",
                                        "url"=> "https://www.laravel-ecommerce.cf/shop/54",
                                        "webview_height_ratio"=> "full",
                                        ],
                    "buttons"=>[
                        [
                            "type"=>"web_url",
                            "url"=>"https://www.laravel-ecommerce.cf/shop/54",
                            "title"=>"Shop Now"
                        ],
                        [
                            "type"=>"web_url",
                            "url"=>"https://www.laravel-ecommerce.cf/shop/54",
                            "title"=>"Add To Cart"
                        ],
                    ]
                    ],
                    [
                        "title"=> "The New MacBook Pro",
                        "image_url"=> "https://www.laravel-ecommerce.cf/storage/products\July2018\laptop-8.jpg",
                        "subtitle"=> "The Fastest NoteBook Ever Build",
                        "default_action"=> [
                                            "type"=> "web_url",
                                            "url"=> "https://www.laravel-ecommerce.cf/shop/8",
                                            "webview_height_ratio"=> "full",
                                            ],
                        "buttons"=>[
                            [
                                "type"=>"web_url",
                                "url"=>"https://www.laravel-ecommerce.cf/shop/8",
                                "title"=>"Shop Now"
                            ],
                            [
                                "type"=>"web_url",
                                "url"=>"https://www.laravel-ecommerce.cf/shop/8",
                                "title"=>"Add To Cart"
                            ],
                        ]
                    ]

      ]
    ]
  ]];
    } elseif ($message == "BYE") {
        //bye-response
        $botReply = ["text" => "Have a nice day. See you soon. :)"];
    }




    $reply = [
        'recipient' => [ 'id' => $senderId ],
        'message' => $botReply
    ];

    $main = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
    curl_setopt($main, CURLOPT_POST, 1);
    curl_setopt($main, CURLOPT_POSTFIELDS, json_encode($reply));
    curl_setopt($main, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_exec($main);
    curl_close($main);
}
