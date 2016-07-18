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
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-10">
                        <div class="content_category">
                            <a>{{ $name }}</a>
                        </div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                </div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    
                <?php $count = 0; ?>
                @foreach($all as $dataAll)
                <?php $count++; ?>
                    <div class="col-md-3 box wow slideInRight" data-wow-duration="{{$count}}s">
                        <img src="../../{{ $dataAll->image }}" style="width: 100%;"/><br />
                        <center>
                        <h4><a href="{{ url('article/read/'.$dataAll->id_article) }}">{{ $dataAll->judul }}</a><h6>{{ $dataAll->short_desc }}<br /><br /><a href="{{ url('article/read/'.$dataAll->id_article) }}" class="link">Read Article <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></h6></h4>
                        </center>
                    </div>
                <!-- enter after 4 -->
                <?php if($count%4==0) {
                    $count = 0;
                ?>
                </div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-12">&nbsp;</div>
            </div>
            
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                <?php } ?>
                @endforeach                    
                                        
                </div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-12">&nbsp;</div>
            </div>
        </div>     
        <!-- end content article -->
        
        <!-- pagination -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="mypagination">
                        <a href=""><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>  Previous</a>
                        <a href="">1</a>
                        <span class="active">2</span>
                        <a href="">3</a>
                        <a href="">4</a>
                        <a href="">Next  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
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
<script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
</script>
</html>
