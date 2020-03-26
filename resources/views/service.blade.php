@extends('layouts.app')

@section('content')

    <div class="general-title">
        Social Crawler
    </div>

    <div class="general-description">
        WHAT'S IT
    </div>

    <div class="paragraph">
        The SoCrawler project which full name is Social Crawler fetches data from your Facebook pages.
    </div>
    <div class="paragraph">
        It keeps up to date automatically without any further operation and let you refresh data when you consider necessary.
    </div>

    <div class="general-description">
        WHICH DATA SERVES
    </div>
    <div class="paragraph">
        The served data are about 2 types:
        <ul>
            <li>Info data</li>
            <li>Media data</li>
        </ul>
    </div>
    <div class="paragraph">
        <div><b>INFO</b></div>
        
        The info data provided are about information on the page, in fact it fetches data about your Page like name, description, [...].
        <div></div>
        This data type is used lesser than the media one.
    </div>
    <div class="paragraph">
        <div><b>MEDIA</b></div>
        
        The media data provided are about media content of your page. The service fetches and keep up-to-date everything supported from Facebook API. Those sub types are:
        <ul>
            <li>Events</li>
            <li>Milestones</li>
            <li>Albums (and related photos)</li>
            <li>Posts</li>
            <li>Videos</li>
        </ul>
        <div></div>
    </div>

    <div class="general-description">
        WHO'S IT FOR
    </div>

    <div class="paragraph">
        The service is focussed for front-end developers and data analysts.
    </div>
    <div class="paragraph">
        <div><b>FRONT-END DEVELOPERS</b></div>
        
        The service provides to front-end developers the agility of supporting data.
        <div></div>
        In fact the service make you syncronize of events, posts, albums, videos and milestones from every Facebook page.
        <div></div>
    </div>

    <div class="paragraph">
        <div><b>DATA ANALYSTS</b></div>
        
        The service provides you Facebook page's data through a JSON.
        <div></div>
        The JSON ( JavaScript Object Notation ) is the mainly data structure used in the web.
    </div>

    <div class="general-description">WHY</div>
    <div class="paragraph">
        The purposes are centered to upgrade productivity reducing the timelines and reducing coding and problems to it linked.
    </div>
    
@endsection
