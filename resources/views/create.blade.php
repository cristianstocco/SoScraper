@extends( 'layouts.app' )

@section( 'content' )
    <form action="{{ route( 'noAuth_news_store' ) }}" accept-charset="utf-8" method="POST" class="form-horizontal">
        <fieldset>

            <legend>Create a new news</legend>

            <div class="form-group">
                <label class="col-md-4 control-label" for="title">Title</label>  
                <div class="col-md-4">
                    <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="message">Message</label>
                <div class="col-md-4">                     
                    <textarea class="form-control" id="message" name="message"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes"></label>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label for="isImportant">
                            <input type="checkbox" name="isImportant" id="isImportant" value="1">
                            Is Important?
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            {{ csrf_field() }}
        </fieldset>
    </form>
@endsection