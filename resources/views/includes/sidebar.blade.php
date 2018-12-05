<aside class="right-sidebar">
        <div class="search-widget">
        <form action="{{ route('index') }}">
                <div class="input-group">
                  <input type="text" name="search" value="{{request('search')}}" class="form-control input-lg" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div><!-- /input-group -->
            </form>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $category)
                        @if($category->posts()->published()->count() > 0)
                            <li>
                                <a href="{{ route('category.search', ['category' => $category->slug]) }}"><i class="fa fa-angle-right"></i> {{ $category->title }}</a>
                                <span class="badge pull-right">{{ $category->posts()->published()->count() }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach($popularPosts as $popular_post)
                        <li>
                            @if($popular_post->image_url)
                                <div class="post-image">
                                    <a href="#">
                                        <img src="{{ $popular_post->image_thumb }}" />
                                    </a>
                                </div>
                            @endif
                            <div class="post-body">
                                <h6><a href="#">{{ $popular_post->title }}</a></h6>
                                <div class="post-meta">
                                    <span>{{ $popular_post->date }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    <li><a href="#">PHP</a></li>
                    <li><a href="#">Codeigniter</a></li>
                    <li><a href="#">Yii</a></li>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">Ruby on Rails</a></li>
                    <li><a href="#">jQuery</a></li>
                    <li><a href="#">Vue Js</a></li>
                    <li><a href="#">React Js</a></li>
                </ul>
            </div>
        </div>
    </aside>