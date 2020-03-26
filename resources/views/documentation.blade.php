@extends('layouts.app')

@section('content')
    <main class="">
        <section class="top">
            <div class="content">
                    <h1>Documentation</h1>
                    <p>Here you can find some example on HOW SoCrawler WORKS</p>

             </div>
        </section>

        <section class="middle">
            <div class="content">
                <div class="menu_doc">
                    <div class="box_doc">
                        <a class="title_button" href="#">back-end</a>

                        <ul class="content_esample">
                            <li class="firtst-element"> <a href="#php">php</a></li>
                            <li> <a href="#ruby">ruby</a></li>
                        </ul>
                    </div>
                    <div class="box_doc">
                        <a class="title_button" href="#">front-end</a>

                        <ul class="front-end content_esample">
                            <li class="firtst-element"> <a href="#jquery">jQuery</a></li>
                            <li> <a href="#javascript">Javascript</a></li>
                        </ul>
                    </div>
                </div>
                <div class="content_script" id="php">
                    <h2>PHP</h2>
                    <pre>
$request = curl_init( 'api.agileapis.ideoplayground.com/&lt;end-point&gt;' );
curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
$response = curl_exec( $request );
[...]
curl_close( $request );
                    </pre>
                </div>
                <div class="content_script" id="ruby">
                    <h2>ruby</h2>
                    <pre>
bruto colione
                    </pre>
                </div>
                <div class="content_script" id="jquery">
                    <h2>jQuery</h2>
                    <pre>
function processResponse(response) {
    if(response['success']) {
        var data = response['data'];
    }
}
$.ajax({
    'url': 'http://api.agileapis.ideoplayground.com/&lt;end-point&gt',
    'type': 'GET',
    'dataType': 'jsonp',
    'crossDomain': true,
    'jsonpCallback': 'processResponse'
});
                    </pre>
                </div>
                <div class="content_script" id="javascript">
                    <h2>javascript</h2>
                    <pre>
(function() {
    var xhr = new XMLHttpRequest();
    var URL = 'http://api.agileapis.ideoplayground.com/&lt;end-point&gt;';
    xhr.open( 'GET', URL );
    xhr.onreadystatechange = function( params ) {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = xhr.responseText;

            if(data['success']) {
                var data = response['data'];
            }
        }
    }
    xhr.send();
})();
                    </pre>
                </div>
                <div class="box_form">
                    <h2><span class="bolder">STILL HAVE QUESTIONS?</span> </h2>
                    <h3>CONTACT US</h3>
                    <div class="contact_form">
                        <form>
                            <input type="text" name="name" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                            <input type="text" name="oggetto" placeholder="Subj">
                            <textarea placeholder="Message"></textarea>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
