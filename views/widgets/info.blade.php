@card([
    'context' => 'widget.sidebar-right',
])
    <div class="c-card__body">
        @include('partials.heading', ['heading' => get_the_title()])
        
        @if(is_array($event['occasions']))
            <ul aria-owns="single-event-all-occasions">
                @foreach(array_slice($event['occasions'], 0, 3) as $occasion)
                    <li>
                        @if($occasion->formatted !== $event['occasion']['formatted'])
                            @link([
                                'href' => $occasion->permalink
                            ])
                                @include('partials.occasion-date')
                            @endlink
                        @else
                            @include('partials.occasion-date')
                        @endif
                    </li>
                @endforeach
            </ul>

            @if(count($event['occasions']) > 3)
                @typography(['id' => 'single-event-all-occasions'])
                    @link([
                        'href' => $event['eventArchive'],
                        'attributeList' => ['aria-label' => $eventLang->occasionShowAll]
                    ])
                        {{ $eventLang->occasionShowAll }}
                    @endlink
                @endtypography
            @endif
        @endif

        <ul class="unlist u-margin__top--3">
            @if ($event['occasion']['duration_formatted'])
                <li><strong>{{ $eventLang->occasionDuration }}:</strong> <span>{{ $event['occasion']['duration_formatted'] }}</span></li>
            @endif

            @if($event['age_group'])
                <li><strong>{{ $eventLang->age }}:</strong> <span>{{ $event['age_group'] }}</span></li>
            @endif
        </ul>
        
        @if($locationInfo['accessibility'])
            <div class="u-margin__top--3">
                <strong>{{ $eventLang->locationAccessibility }}</strong>
                <ul>
                    @foreach($eventLang->accessibilityLabels as $accessibility)
                        <li>{{ $accessibility }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($event['eventLink'])
            <div class="u-margin__top--3">
                @link(['href' => $event['eventLink']])
                    {{ $eventLang->goToEventWebsite}}
                @endlink
            </div>
        @endif
        
        @include('partials.price')
    </div>
@endcard