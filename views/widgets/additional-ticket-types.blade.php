@if(!empty($bookingInfo['additional_ticket_types']))
    @card([
        'context' => 'widget.sidebar-right',
    ])
        <div class="c-card__body">
            @include('partials.heading', ['heading' => $eventLang->ticketTypes])

            @if(is_array($bookingInfo['additional_ticket_types']))
                @foreach ($bookingInfo['additional_ticket_types'] as $index => $ticketType)
                    @if(!empty($ticketType['ticket_name']))
                        @typography
                            <strong>{{ $ticketType['ticket_name'] }}</strong>
                        @endtypography
                    @endif

                    <ul>
                        @if(!empty($ticketType['ticket_type']))
                            <li>
                                <span hidden>{{ $eventLang->ticketType }}:</span>
                                <strong>{{ strtolower($ticketType['ticket_type']) === 'seated' ? $eventLang->ticketSeated : $eventLang->ticketStanding }}</strong>
                            </li>
                        @endif

                       @if($ticketType['minimum_price'] && is_array($ticketType['minimum_price']) && array_key_exists('formatted_price', $ticketType['minimum_price']))
                            <li>
                                <strong>{{ $eventLang->priceMin }}:</strong>
                                <span>{{ $ticketType['minimum_price']['formatted_price'] }}</span>
                            </li>
                        @endif

                        @if($ticketType['maximum_price'] && is_array($ticketType['maximum_price']) && array_key_exists('formatted_price', $ticketType['maximum_price']))
                            <li>
                                <strong>{{ $eventLang->priceMax }}:</strong>
                                <span>{{ $ticketType['maximum_price']['formatted_price'] }}</span>
                            </li>
                        @endif

                    </ul>
                @endforeach
            @endif
        </div>
    @endcard
@endif
