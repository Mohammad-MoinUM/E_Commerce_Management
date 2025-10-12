<section class="carousel-fixed-height" style="border: 1px solid black;margin: 5px;border-radius:10px;padding:5px;">
    <div id="carousel-fixed-height" class="carousel slide" data-ride="carousel" data-interval="2000">
        <div class="carousel-inner" role="listbox">
        @if(isset($categories) && count($categories) > 0)
            @foreach ($categories->take(6) as $index => $category)
                <div class="item @if ($index == 0) active @endif">
                    <div style="background:url('{{ $category->image }}') center center; background-size:contain; background-repeat: no-repeat;"
                        class="slider-size">
                    </div>
                </div>
            @endforeach
        @else
            <div class="item active">
                <div class="slider-size d-flex align-items-center justify-content-center">
                    <p>No categories available</p>
                </div>
            </div>
        @endif
        </div>
    </div>
</section>
