 <aside>
    <div class="category-sec">
        <h3>Categories</h3>
        <ul>
            @if(session('stories'))
            @foreach(session('stories') as $story)
            <li>
                <form method="get" action="/section/{{$story->section}}">
                    <input type="hidden" name="section" value="{{$story->section}}">
                  <button class="custom_button" type="submit">{{$story->section}}</button>
                </form>
            </li>
            @endforeach
            @endif
        </ul>
    </div>


<!-- Tag section -->
    <div class="tag-sec">
        <h3>Tag Cloud</h3>
        <ul>

            @if(session('stories'))
             @foreach(session('stories') as $story)
              @foreach(explode(',', $story->tags) as $tag)
                <li>
                    <form method="get" action="/section/{{$story->section}}">
                        <input type="hidden" name="section" value="{{$tag}}">
                      <button class="custom_button" type="submit" style="background-color: #fff3e6; border-radius: 20px;">{{$tag}}</button>
                    </form>
                </li>
              @endforeach
              @endforeach
            @endif

        </ul>
    </div>
</aside>
