<form method="{{ strtoupper($widget->getProp('method', 'post')) }}" action="{{ $widget->getProp('action', '#') }}">
    {{ csrf_field() }}

    @foreach ($widget->children as $child)
        {!! $child->render() !!}
    @endforeach

</form>