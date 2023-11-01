<h1>List of Coins</h1>

<ul>
    @foreach ($coins as $coin)
        <li>
            ID: {{ $coin->id }}<br>
            Rank: {{ $coin->rank }}<br>
            Name: {{ $coin->name }}<br>
            Symbol: {{ $coin->symbol }}<br>
            Slug: {{ $coin->slug }}<br>
            Is Active: {{ $coin->is_active }}<br>
            First Historical Data: {{ $coin->first_historical_data }}<br>
            Last Historical Data: {{ $coin->last_historical_data }}<br>
            Platform: {{ $coin->platform->id ?? "null" }}<br>
        </li>
    @endforeach
</ul>


{{ $coins->links() }}
