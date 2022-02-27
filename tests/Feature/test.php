<?php

$link = "第01集\$https:\/\/mgtv-com.jjyl12349.com\/share\/6aaoacr2kktuz9Un#第02集\$https:\/\/mgtv-com.jjyl12349.com\/share\/dJroPBiI0Fpp3B3J#第03集\$https:\/\/mgtv-com.jjyl12349.com\/share\/JjdxA7bE71KRZs6S#第04集\$https:\/\/vsl9.jjyl12349.com\/share\/Ti05CwD9hYE7ueCi#第05集\$https:\/\/vsl9.jjyl12349.com\/share\/MKQXBeUNTjgF5Wgq#第06集\$https:\/\/vsl9.jjyl12349.com\/share\/KGdWaqcwv2klM14d#第07集\$https:\/\/vsl9.jjyl12349.com\/share\/vS2hDKIjk5H9tWpM#第08集\$https:\/\/vsl9.jjyl12349.com\/share\/uNRzEDXuv8WwW4Ac#第09集\$https:\/\/vsl9.jjyl12349.com\/share\/r3j1dVoC8AUMK7F0#第10集\$https:\/\/vsl9.jjyl12349.com\/share\/CY9z2J9R1rL3Y5b5#第11集\$https:\/\/vsl9.jjyl12349.com\/share\/EOjGNQ4TNp8SrZP3#第12集\$https:\/\/vsl9.jjyl12349.com\/share\/s6JvkkFQz7I81AVF$$\$第01集\$https:\/\/mgtv-com.jjyl12349.com\/20211027\/ee0r25g1\/index.m3u8#第02集\$https:\/\/mgtv-com.jjyl12349.com\/20211104\/jkrVzbzb\/index.m3u8#第03集\$https:\/\/mgtv-com.jjyl12349.com\/20211114\/OUZKftZD\/index.m3u8#第04集\$https:\/\/vsl9.jjyl12349.com\/20211119\/A5DVTova\/index.m3u8#第05集\$https:\/\/vsl9.jjyl12349.com\/20211124\/dL5qdj6k\/index.m3u8#第06集\$https:\/\/vsl9.jjyl12349.com\/20211202\/m7PcAq9h\/index.m3u8#第07集\$https:\/\/vsl9.jjyl12349.com\/20211208\/iLJiZI8v\/index.m3u8#第08集\$https:\/\/vsl9.jjyl12349.com\/20211215\/NAgXsHnK\/index.m3u8#第09集\$https:\/\/vsl9.jjyl12349.com\/20220119\/gF7PpClp\/index.m3u8#第10集\$https:\/\/vsl9.jjyl12349.com\/20220126\/WKzRw53K\/index.m3u8#第11集\$https:\/\/vsl9.jjyl12349.com\/20220202\/JqZpVcqU\/index.m3u8#第12集\$https:\/\/vsl9.jjyl12349.com\/20220209\/t3wB5rCt\/index.m3u8";

$link2 = "HD\$https:\/\/qq-qy-yk-mg-bl-1905.jjyl12349.com\/share\/xY4BSadsm18IKGBs$$\$HD\$https:\/\/qq-qy-yk-mg-bl-1905.jjyl12349.com\/20220207\/IaMn5AAF\/index.m3u8";

$m3u8Links = explode("$$$", $link2)[1];

$m3u8Links = collect(explode("#", $m3u8Links))->map(function($link) {
    return explode('$', $link)[1];
});

echo $m3u8Links;
