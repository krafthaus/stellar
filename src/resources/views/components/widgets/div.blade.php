<div>

    <h3>My awesome {{ $widget->getProp('title') }}</h3>

    @foreach ($widget->children as $child)
        {!! $child->render() !!}
    @endforeach

</div>