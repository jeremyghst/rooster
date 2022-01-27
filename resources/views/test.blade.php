@foreach ($tests as $test)
    <p><span style="color:red;">de hele array:</span> {{ var_dump($test->days) }}</p>
    <p><span style="color:red;">$test->days["maandag"]["middag"]:</span> {{ $test->days["maandag"]["middag"] }}</p>
    <p><span style="color:red;">$test->days["maandag"]:</span> {{ var_dump($test->days["maandag"]) }}</p>
@endforeach
