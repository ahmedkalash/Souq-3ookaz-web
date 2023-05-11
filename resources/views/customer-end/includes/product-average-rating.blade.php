@for($i=1;$i<=5;$i++)
    @if($i<=$product->average_rating)
        <li>
            <i data-feather="star" class="fill"></i>
        </li>
    @else
        <li>
            <i data-feather="star"></i>
        </li>
    @endif
@endfor
