    <h2>Settle Up</h2>
    @if ( $settles && count($payers) )
        <ul>
        @foreach ($settles as $s)
        <li>{{ $payers[$s['from']] }} pays {{ $payers[$s['to']] }} {{ number_format($s['amount'], 2) }}</li>
        @endforeach
        </ul>
    @else
    <p>All square!</p>
    @endif