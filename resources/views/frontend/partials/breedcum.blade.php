<ul class="breadcrumb d-block">
    <li><a href="javascript:void(0)" onclick="loadCategories(0)">Home</a></li>
    @foreach($breed as $k=> $v)
    <li><a href="{{$v['link']}}" onclick="{{(isset($v['click'])?$v['click']:'')}}">{{$v['title']}}</a></li>
    @endforeach

</ul>
<h2 class="page-title">{{ $title }}</h2>

