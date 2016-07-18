<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        
        {!! Html::script(elixir('js/app.js')) !!}
        {!! Html::style(elixir('css/app.css')) !!}
        <link rel="stylesheet" href="<?php echo asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); ?>" />
        <link href='https://fonts.googleapis.com/css?family=Dosis:400,600' rel='stylesheet' type='text/css'>
        <style>
        body{
            font-family: 'Dosis', sans-serif;
        }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row bg-main">
                <div class="col-md-12" style="padding: 20px 40px 5px 40px;">
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-10">
                        <div class="col-md-8">
                            <h1 class="myBrand"><b>My Web Blog [Review Game]</b></h1>
                        </div>
                        <div class="col-md-4" style="text-align: right;">
                            <form action="" method="">
                                <input type="text" class="search_input" placeholder="search.." />
                                <button type="submit" class="search_button">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                </div>
                <div class="col-md-12"><hr /></div>
            </div>
        </div>
        <div class="container-fluid">
        <!-- menu -->
            <div class="row bg-main">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">            
                    <nav class="navbar navbar-default container-fluid">        
                        <div class="col-md-12">
                            <div class="navbar-header">
                       			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    				<span class="sr-only">Toggle navigation</span>
                    				<span class="icon-bar"></span>
                    				<span class="icon-bar"></span>
                    				<span class="icon-bar"></span>
                    			</button>
                            </div>                  
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <?php $segment = Request::segment(1);?>
                                  <li <?php if($segment=='') echo "class='active'"; ?>><a href="{{ url('') }}">Home</a></li>
                                  <li class="dropdown <?php if($segment=='article') echo "active"; ?>">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Game Category
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach($category as $data)
                                        <li><a href="{{ url('article/category/'.$data->category) }}">{{ $data->category }}</a></li>
                                        @endforeach
                                    </ul>
                                  </li>
                                  <li<?php if($segment=='about') echo "class='active'"; ?>><a href="{{ url('about') }}">About</a></li>
                                  <li<?php if($segment=='contact') echo "class='active'"; ?>><a href="{{ url('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        <!-- end menu -->
        </div>
        
        <!-- content article -->
        <div class="container-fluid">
            <div class="row" style="margin: 20px 0;">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="col-md-8 box myarticle">
                        @foreach($all as $data)
                        <div class="col-md-12">
                            <h1>{{ $data->judul }}<h6>Published by <a href="">Puji Slamet</a> | {{ $data->tanggal }}</h6></h1><br />
                            <center><img src="../../{{ $data->image }}" style="width: 60%;" /></center>
                            <h4 style="text-align: justify;"><p>{{ $data->isi }}</p></h4>
                        </div>
                        <div class="col-md-12">
                            <div class="content_category">
                                <a href="">Comments</a>
                            </div>
                            @if(Session::has('message'))
                                <center><span class="label label-success"><?php echo (Session::get('message')); ?></span></center>
                            @endif
                            
                            @foreach($comments as $comment)
                            <div class="comments paddingcomments">
                                <a>{{ $comment->nama }}</a> says:<br />
                                {{ $comment->comment }}
                                <tanggal>{{ $comment->tanggal }}</tanggal>
                            </div>
                            @endforeach
                            
                            <br />
                            <form class="paddingcomments" method="POST" action="{{ url('article/comment') }}">
                                <input type="hidden" name="id" value="{{ $id }}" />
                                <label>Nama: </label><input class="form-control" type="text" name="nama" />
                                <label>Komentar: </label><textarea class="form-control"name="comment"></textarea>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <button type="submit" class="search_button">Send Comment</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12 paddingcomments">
                            <div class="content_category">
                                <a>Related Post</a>
                            </div>
                            
                            @foreach($related as $relatedPost)
                            <div class="col-md-12">
                                <div class="col-md-5"><img src="../../{{ $relatedPost->image }}" style="width: 90%;"/></div>
                                <div class="col-md-7">
                                    <a href="{{ url('article/read/'.$relatedPost->id_article) }}">{{ $relatedPost->judul }}</a><br />
                                    <h6>{{ $relatedPost->short_desc }}</h6>
                                </div>
                                <div class="col-md-12"><hr class="full" /></div>
                            </div>
                            @endforeach
                            
                        </div>
                        
                        <div class="col-md-12 paddingcomments">
                            <div class="content_category">
                                <a>Popular Post</a>
                            </div>
                            
                            @foreach($popular as $popularPost)
                            <div class="col-md-12">
                                <div class="col-md-5"><img src="../../{{ $popularPost->image }}" style="width: 90%;"/></div>
                                <div class="col-md-7">
                                    <a href="{{ url('article/read/'.$popularPost->id_article) }}">{{ $popularPost->judul }}</a><br />
                                    <h6>{{ $popularPost->short_desc }}</h6>
                                </div>
                                <div class="col-md-12"><hr class="full" /></div>
                            </div>
                            @endforeach
                            
                        </div>
                        
                        <div class="col-md-12 paddingcomments">
                            <h2>Subscribe email:</h2>
                            <form class="paddingcomments" method="POST" action="">
                                <input class="form-control" type="text" name="email" placeholder="enter your email here" style="margin-bottom: 5px;"/>
                                <button type="submit" class="btn btn-danger">Subscribe now</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>    
        </div>
        
        <!-- footer -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="myfooter"/>
                        <a href="">Privacy Policy</a> | <a href="">FAQ</a>
                        <div style="float: right;">
                            Copyright &copy; 2016
                        </div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
        <!-- end footer -->      
    </body>
</html>
