{{-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
    @if($available_locale === $current_locale)
    <span class="ml-2 mr-2 text-gray-700">{{ $locale_name }}</span>
@else
<a class="ml-1 underline ml-2 mr-2" href="{{ route('language.switch', $available_locale) }}">

    <span>{{ $locale_name }}</span>

</a>
@endif
@endforeach
</div> --}}

{{-- {{ dd($available_locales) }} --}}

<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
    @if($available_locale === $current_locale)
    <span class="ml-2 mr-2 text-gray-700 text-success">{{ $locale_name }}</span>
    @else
    <a class="ml-1 underline ml-2 mr-2" href="#">

        <span>{{ $locale_name }}</span>

    </a>

    {{-- {{ dd($locale_name) }} --}}
    @endif
    @endforeach
</div>
