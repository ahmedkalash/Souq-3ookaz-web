{{--@for($i=1;$i<=5;$i++)
    @if($i<=$reviews->average_rating)
        <li>
            <i data-feather="star" class="fill"></i>
        </li>
    @else
        <li>
            <i data-feather="star"></i>
        </li>
    @endif
@endfor--}}

@for($i=1;$i<=5;$i++)
    @if($i<=$product->reviews->average_rating)
        <li>
            <i data-feather="star" class="fill"></i>
        </li>
    @else
        <li>
            <i data-feather="star"></i>
        </li>
    @endif
@endfor
