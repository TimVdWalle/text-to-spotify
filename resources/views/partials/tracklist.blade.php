
    @foreach($tracks as $track)
        <ol class="tracklisting">
            <li class="track group">
                <span class="track-no">{{$loop->iteration}}</span>
                <p class="track-info">
                    <span class="sub-head">{{$track['name']}}</span>
                    <span class="main-head">{{implode(',', $track['artist'])}}</span>
                </p>
                <a href="#track1" class="track-listen sc">Listen</a>
                <div id="track1" class="track-audio">
                    <iframe width="100%" height="166" scrolling="no" frameborder="no"
                            src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F25661762&show_artwork=true"></iframe>
                </div>
            </li><!-- /track -->
        </ol><!-- /tracklisting -->
    @endforeach

