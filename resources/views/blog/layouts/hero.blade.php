<section id="cta" class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 align-self-center">
                <h2>A digital marketing blog</h2>
                <p class="lead"> Aenean ut hendrerit nibh. Duis non nibh id tortor consequat cursus at mattis felis. Praesent sed lectus et neque auctor dapibus in non velit. Donec faucibus odio semper risus rhoncus rutrum. Integer et ornare mauris.</p>
                <a href="{{ route('category.all') }}" class="btn btn-primary">Try for free</a>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Subscribe Today!</h3>
                    <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                    {!! Form::open(['route' => 'subscribe', 'method' => 'post', 'class' => 'form-inline']) !!}
                        {{ Form::email('email', null, [
                            'class'         => 'form-control', 
                            'placeholder'   => 'Add your email here..',
                            'required'      => 'true'
                        ]) }}
                        {{ Form::submit('Subscribe', ['class' => 'btn btn-default btn-block']) }}
                    {!! Form::close() !!}
                </div><!-- end newsletter -->
            </div>
        </div>
    </div>
</section>
