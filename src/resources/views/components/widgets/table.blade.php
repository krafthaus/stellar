<table class="table">
    <thead class="thead-inverse">
        <tr>
            @foreach ($widget->getProp('fields') as $field => $arguments)
                <th>
                    {{ $arguments['label'] }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>