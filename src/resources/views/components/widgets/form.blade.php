<form method="{{ $widget->getProp('method') }}" action="{{ $widget->getProp('action') }}">

    @foreach ($widget->children as $child)
        {!! $child->render() !!}
    @endforeach

</form>