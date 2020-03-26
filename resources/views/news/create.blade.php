@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
                <h1>Create a new news</h1>
                <p>Here you can find some example on HOW SoCrawler WORKS</p>

         </div>
    </section>
    <div class="content">
        <div class="contact_form">

            <form action="{{ route( 'static_newsStore' ) }}" accept-charset="utf-8" method="POST" class="form-news" style="color: #222;">
                <fieldset>
                    <label class="col-md-4 control-label" for="title">Title</label>  
                    <div class="col-md-4">
                    <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md">

                    <label class="col-md-4 control-label" for="message">Message</label>                 
                    <textarea class="form-control" id="message" name="message"></textarea>
                    <label class="col-md-4 control-label" for="checkboxes"></label>
                   
                        <label for="isImportant">
                            <input type="checkbox" name="isImportant" id="isImportant" value="1">
                            Is Important?

                        </label>
                    <input type="submit" name="submit" value="Submit">

                    {{ csrf_field() }}
                </fieldset>
            </form>
        </div>
    </div>
    
</main>
@endsection