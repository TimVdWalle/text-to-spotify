@extends('layouts.master')

@section('pageTitle', 'Text to spotify')
@section('title', 'Convert text to spotify playlist')

@section('content')
    @if(isset($success) && $success)
        <div class="row">
            <div class="sixteen columns">

                <article class="post album group">

                    <div class="twelve columns omega">

                        <h3>Playlist created!</h3>
                    </div>
                </article>
            </div>
        </div>
    @endif

    @if(!isset($tracks))
        <div class="sixteen columns fp-3 ">
            <form action="/v4" method="post">
                @csrf
                <textarea frows="4" name="text" id="text"
                          rows="6"
                          cols="6"
                          class="p-2 w-full box-border">{{$text ?? ''}}</textarea>

                <button type="submit" class="btn-custom">Convert</button>
            </form>

        </div>
    @endif

    @if(isset($tracks))
        <div class="row">
            <div class="sixteen columns">

                <article class="post album group">

                    <div class="twelve columns omega">

                        <h3>Tracks</h3>

                        @include('partials.tracklist')


                    </div><!-- /twelve columns -->

                </article><!-- /album -->

            </div><!-- /sixteen columns -->
        </div><!-- /row -->
    @endif

    @if(isset($tracks))
        <form action="/v4/playlist/store">
            <input type="hidden" value="{{$text}}" name="text">

            <div class="mx-auto max-w-7xl py-2 px-6 sm:py-2 lg:px-8">
                <div class="text-center">
                    <button type="submit"
                            class="btn-custom">
                        Save as playlist: {{$text}}
                    </button>
                </div>
            </div>
        </form>
    @endif
@stop
