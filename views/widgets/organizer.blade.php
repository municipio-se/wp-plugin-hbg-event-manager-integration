@if(!empty($event['organizers']))
    @card([
        'context' => 'widget.sidebar-right',
    ])
        <div class="c-card__body">
            @include('partials.heading', ['heading' => $eventLang->organizer])

            @if(!empty($event['organizers']))
                @foreach($event['organizers'] as $orgindex => $organizer)
                    @if(!empty($organizer['organizer']))
                        @typography
                            <strong>{!! $organizer['organizer'] !!}</strong>
                        @endtypography
                    @endif
                    @if(!empty($organizer['organizer_phone']) || !empty($organizer['organizer_email']) || !empty($organizer['organizer_link']))
                        <ul>
                            @if(!empty($organizer['organizer_phone']))
                                <li>
                                    @link(['href' => 'tel:' . $organizer['organizer_phone']])
                                        {{ $organizer['organizer_phone'] }}
                                    @endlink
                                </li>
                            @endif

                            @if(!empty($organizer['organizer_email']))
                                <li>
                                    @link(['href' => 'mailto:' . $organizer['organizer_email']])
                                        {{ $organizer['organizer_email'] }}
                                    @endlink
                                </li>
                            @endif

                            @if($parsedUrl = parse_url($organizer['organizer_link']))
                                <li>
                                    @link(['href' => $organizer['organizer_link']])
                                        {{ ucfirst($parsedUrl['host']) }}
                                    @endlink
                                </li>
                            @endif
                        </ul>
                    @endif
                @endforeach
            @endif

            @if(!empty($event['supporters']))
                @typography
                    <strong>{{ $eventLang->supporters }}</strong>
                @endtypography

                <ul>
                    @foreach($event['supporters'] as $supporter)
                        @if(!empty($supporter['post_title']))
                            <li>{{ $supporter['post_title'] }}</li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    @endcard
@endif