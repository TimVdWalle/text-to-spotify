@extends('layouts.master')

@section('pageTitle', 'Text to spotify')
@section('title', 'Convert text to spotify playlist')

@section('content')

    <div class="sixteen columns">
        <div class="six columns offset-by-four">
            <textarea frows="4" name="text" id="text"
                      rows="6"
                      cols="6"
                      class="p-2 w-full">{{$text ?? ''}}</textarea>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="sixteen columns">

            <article class="post album group">

                <div class="twelve columns omega">
{{--                    <h2>Dancing in my head</h2>--}}
{{--                    <div id="meta-wrap" class="group">--}}
{{--                        <ul class="album-meta eight columns alpha">--}}
{{--                            <li><span>Release date:</span> September 12th, 2012</li>--}}
{{--                            <li><span>Label:</span> Bedrock</li>--}}
{{--                            <li><span>Catalog #:</span> BDR012</li>--}}
{{--                        </ul>--}}
{{--                    </div><!-- /meta-wrap -->--}}

                    <h3>Tracklisting</h3>
                    <ol class="tracklisting">
                        <li class="track group">
                            <span class="track-no">1</span>
                            <p class="track-info">
                                <span class="sub-head">Gotye Feat. Kimbra </span>
                                <span class="main-head">Somebody That I Used To Know (Tiësto Remix)</span>
                            </p>
                            <a href="#track1" class="track-listen sc">Listen</a>
                            <div id="track1" class="track-audio">
                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F25661762&show_artwork=true"></iframe>
                            </div>
                        </li><!-- /track -->
                        <li class="track group">
                            <span class="track-no">2</span>
                            <p class="track-info">
                                <span class="sub-head">This album is now available</span>
                                <span class="main-head">Purchase this album now from</span>
                            </p>
                            <a href="#track2" class="track-listen">Listen</a>
                            <div id="track2" class="track-audio jw">
                                <div id="player2">Loading the player ...</div>
                                <script type="text/javascript">
                                    setupjw('player2','audio/test.mp3');
                                </script>
                            </div>
                        </li><!-- /track -->
                        <li class="track group">
                            <span class="track-no">3</span>
                            <p class="track-info">
                                <span class="sub-head">This album is now available</span>
                            </p>
                            <a href="#track3" class="track-listen">Listen</a>
                            <div id="track3" class="track-audio jw">
                                <div id="player3">Loading the player ...</div>
                                <script type="text/javascript">
                                    setupjw('player3','audio/test.mp3');
                                </script>
                            </div>
                        </li><!-- /track -->
                        <li class="track group">
                            <span class="track-no">4</span>
                            <p class="track-info">
                                <span class="sub-head">This album is now available</span>
                                <span class="main-head">Purchase this album now from</span>
                            </p>
                            <a href="#track4" class="track-listen">Listen</a>
                            <div id="track4" class="track-audio jw">
                                <div id="player4">Loading the player ...</div>
                                <script type="text/javascript">
                                    setupjw('player4','audio/test.mp3');
                                </script>
                            </div>
                        </li><!-- /track -->
                        <li class="track group">
                            <span class="track-no">5</span>
                            <p class="track-info">
                                <span class="sub-head">This album is now available</span>
                                <span class="main-head">Purchase this album now from</span>
                            </p>
                            <a href="#track5" class="track-listen">Listen</a>
                            <div id="track5" class="track-audio jw">
                                <div id="player5">Loading the player ...</div>
                                <script type="text/javascript">
                                    setupjw('player5','audio/test.mp3');
                                </script>
                            </div>
                        </li><!-- /track -->
                        <li class="track group">
                            <span class="track-no">6</span>
                            <p class="track-info">
                                <span class="sub-head">This album is now available</span>
                                <span class="main-head">Purchase this album now from</span>
                            </p>
                            <a href="#track6" class="track-listen">Listen</a>
                            <div id="track6" class="track-audio jw">
                                <div id="player6">Loading the player ...</div>
                                <script type="text/javascript">
                                    setupjw('player6','audio/test.mp3');
                                </script>
                            </div>
                        </li><!-- /track -->
                        <li class="track group">
                            <span class="track-no">7</span>
                            <p class="track-info">
                                <span class="sub-head">This album is now available</span>
                                <span class="main-head">Purchase this album now from</span>
                            </p>
                            <a href="#track7" class="track-listen">Listen</a>
                            <div id="track7" class="track-audio jw">
                                <div id="player7">Loading the player ...</div>
                                <script type="text/javascript">
                                    setupjw('player7','audio/test.mp3');
                                </script>
                            </div>
                        </li><!-- /track -->
                    </ol><!-- /tracklisting -->

                    <h3>Description</h3>
                    <p>Pellentesque eu est a nulla placerat dignissim. Morbi a enim in magna semper bibendum. Etiam scelerisque, nunc ac egestas consequat, odio nibh euismod nulla, eget auctor orci nibh vel nisi. Aliquam erat volutpat. Mauris vel neque sit amet nunc gravida congue sed sit amet purus. Quisque lacus quam, egestas ac tincidunt a, lacinia vel velit. Aenean facilisis nulla vitae urna tincidunt congue sed ut dui. Morbi malesuada nulla nec purus convallis consequat. Vivamus id mollis quam. Morbi ac commodo nulla. In condimentum orci id nisl volutpat bibendum. Quisque commodo hendrerit lorem quis egestas. Maecenas quis tortor arcu. Vivamus rutrum nunc non neque consectetur quis placerat neque lobortis. Nam vestibulum, arcu sodales feugiat consectetur, nisl orci bibendum elit, eu euismod magna sapien ut nibh. Donec semper quam scelerisque tortor dictum gravida. In hac habitasse platea dictumst. Nam pulvinar, odio sed rhoncus suscipit, sem diam ultrices mauris, eu consequat purus metus eu velit. Proin metus odio, aliquam eget molestie nec, gravida.</p>
                    <p>Pellentesque eu est a nulla placerat dignissim. Morbi a enim in magna semper bibendum. Etiam scelerisque, nunc ac egestas consequat, odio nibh euismod nulla, eget auctor orci nibh vel nisi. Aliquam erat volutpat. Mauris vel neque sit amet nunc gravida congue sed sit amet purus. Quisque lacus quam, egestas ac tincidunt a, lacinia vel velit. Aenean facilisis nulla vitae urna tincidunt congue sed ut dui. Morbi malesuada nulla nec purus convallis consequat. Vivamus id mollis quam. Morbi ac commodo nulla. In condimentum orci id nisl volutpat bibendum. Quisque commodo hendrerit lorem quis egestas. Maecenas quis tortor arcu. Vivamus rutrum nunc non neque consectetur quis placerat neque lobortis. Nam vestibulum, arcu sodales feugiat consectetur, nisl orci bibendum elit, eu euismod magna sapien ut nibh. Donec semper quam scelerisque tortor dictum gravida. In hac habitasse platea dictumst. Nam pulvinar, odio sed rhoncus suscipit, sem diam ultrices mauris, eu consequat purus metus eu velit. Proin metus odio, aliquam eget molestie nec, gravida.</p>

                </div><!-- /twelve columns -->

            </article><!-- /album -->

        </div><!-- /sixteen columns -->
    </div><!-- /row -->
@stop
