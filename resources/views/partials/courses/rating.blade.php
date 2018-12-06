<div>
    <ul class="list-inline">
        <li class="list list-inline-item"><i class="fa fa-star" {{ $course->rating >= 1 ? ' yellow' : ''}}></i></li>
        <li class="list list-inline-item"><i class="fa fa-star" {{ $course->rating >= 2 ? ' yellow' : ''}}></i></li>
        <li class="list list-inline-item"><i class="fa fa-star" {{ $course->rating >= 3 ? ' yellow' : ''}}></i></li>
        <li class="list list-inline-item"><i class="fa fa-star" {{ $course->rating >= 4 ? ' yellow' : ''}}></i></li>
        <li class="list list-inline-item"><i class="fa fa-star" {{ $course->rating >= 5 ? ' yellow' : ''}}></i></li>
    </ul>
</div>