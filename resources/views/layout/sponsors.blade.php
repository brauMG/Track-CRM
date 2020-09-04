@inject('sponsors', 'App\Services\SponsorsInside')
@if(count($sponsors->get()->toArray()) == 0)
@else
    <div class="sponsors-navbar-inside">
        <ul class="sponsors-ul-inside" id="c">
            @foreach($sponsors->get() as $sponsor)
                <li class="sponsors-li-inside" data-toggle="tooltip" data-placement="top" title="Ver información del patrocinador">
                    <img data-toggle="modal" data-target="#info{{$sponsor->sponsorId}}" src="{{ URL::to('/') }}/uploads/sponsors/{{ $sponsor->image }}" class="sponsors-img-inside"/>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@foreach($sponsors->get() as $sponsor)
    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="info{{$sponsor->sponsorId}}">
        <div class="modal-dialog padding-modal" role="document">
            <form target="_blank" action="https://{{$sponsor->link}}">
                <div class="modal-content"style="background-color: #ffffff;color: white;">
                    <div class="modal-header ">
                        <h5 class="modal-title"  id="exampleModalLongTitle"><img src="{{ URL::to('/') }}/uploads/sponsors/{{ $sponsor->image }}" width="75"/></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 20% !important;">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div style="background-color: white;color: black;">
                        <div class="modal-body">
                            {{$sponsor->description}}
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: white;color: black;">
                        <input type="submit" class="btn btn-primary" value="Ir a su sitio web">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    if ($(window).width() > 799) {
        var timer = 4000;

        var i = 0;
        var max = $('#c > li').length;

        $("#c > li").eq(i).addClass('sponsors-active').css('left','0');
        $("#c > li").eq(i + 1).addClass('sponsors-active').css('left','22.5%');
        $("#c > li").eq(i + 2).addClass('sponsors-active').css('left','45%');
        $("#c > li").eq(i + 3).addClass('sponsors-active').css('left','67.5%');



        setInterval(function(){

            $("#c > li").removeClass('sponsors-active');

            $("#c > li").eq(i).css('transition-delay','0.25s');
            $("#c > li").eq(i + 1).css('transition-delay','0.5s');
            $("#c > li").eq(i + 2).css('transition-delay','0.75s');
            $("#c > li").eq(i + 3).css('transition-delay','1s');

            if (i < max-4) {
                i = i+4;
            }

            else {
                i = 0;
            }

            $("#c > li").eq(i).css('left','0').addClass('sponsors-active').css('transition-delay','1.25s');
            $("#c > li").eq(i + 1).css('left','22.5%').addClass('sponsors-active').css('transition-delay','1.5s');
            $("#c > li").eq(i + 2).css('left','45%').addClass('sponsors-active').css('transition-delay','1.75s');
            $("#c > li").eq(i + 3).css('left','67.5%').addClass('sponsors-active').css('transition-delay','2s');

        }, timer);
    }

    else {
        var timer = 4000;

        var i = 0;
        var max = $('#c > li').length;

        $("#c > li").eq(i).addClass('sponsors-active').css('left','0');
        $("#c > li").eq(i + 1).addClass('sponsors-active').css('left','33%');
        $("#c > li").eq(i + 2).addClass('sponsors-active').css('left','66%');



        setInterval(function(){

            $("#c > li").removeClass('sponsors-active');

            $("#c > li").eq(i).css('transition-delay','0.25s');
            $("#c > li").eq(i + 1).css('transition-delay','0.5s');
            $("#c > li").eq(i + 2).css('transition-delay','0.75s');

            if (i < max-3) {
                i = i+3;
            }

            else {
                i = 0;
            }

            $("#c > li").eq(i).css('left','0').addClass('sponsors-active').css('transition-delay','1.25s');
            $("#c > li").eq(i + 1).css('left','33%').addClass('sponsors-active').css('transition-delay','1.5s');
            $("#c > li").eq(i + 2).css('left','66%').addClass('sponsors-active').css('transition-delay','1.75s');

        }, timer);
    }
</script>
