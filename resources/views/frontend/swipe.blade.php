@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
  <div id="viewport">
        <ul class="stack">
            @foreach($ringforts as $ringfort)
            <li>
                <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$ringfort->lat}},{{$ringfort->long}}&zoom=17&size=400x400&&maptype=satellite&markers=icon:http%3A%2F%2Fvool.ie%2Fcrosshairs.png|anchor:center|{{$ringfort->lat}},{{$ringfort->long}}&key={{Config::get('services.google.maps_api_key')}}"/>
            </li>
            @endforeach
        </ul>
    </div>
    <div id="source">
        <p>Drag the playing cards out of the stack and let go. Dragging them beyond the desk will throw them out of the stack. If you drag too little and let go, the cards will spring back into place. You can throw cards back into the stack after you have thrown them out.</p>
        <p>Open the <a href="https://developer.chrome.com/devtools/docs/console">Console</a> to view the associated events.</p>
        <p>Demonstration of <a href="https://github.com/gajus/swing">https://github.com/gajus/swing</a> implementation.</p>
</div>

@endsection

@push('after-scripts')
<script src"https://cdnjs.cloudflare.com/ajax/libs/swing/3.0.2/swing.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    var stack;

    stack = window.swing.Stack();

    [].forEach.call(document.querySelectorAll('.stack li'), function (targetElement) {
        stack.createCard(targetElement);

        targetElement.classList.add('in-deck');
    });

    stack.on('throwout', function (e) {
        console.log(e.target.innerText || e.target.textContent, 'has been thrown out of the stack to the', e.throwDirection, 'direction.');

        e.target.classList.remove('in-deck');
         console.log(stack);
        if(stack.length < 2){
           
            getNew();
        }
    });

    stack.on('throwin', function (e) {
        console.log(e.target.innerText || e.target.textContent, 'has been thrown into the stack from the', e.throwDirection, 'direction.');

        e.target.classList.add('in-deck');
    });
    
    function getNew(){
            
    
            var el = $("<li id='foo'>sadasd</li>");
        
        $( ".stack" ).prepend(el);
        
        el.addClass('in-deck');
        
        stack.createCard(document.getElementById('foo'));

    }
    

});


</script>
@endpush

@push('after-styles')
<style>

html,
body,
ul,
li {
    margin: 0; padding: 0;
}

body {
    background: #FCD424; font: normal 16px/24px 'Helvetica Neue', Helvetica, Arial, freesans, sans-serif;
}

button,
input,
code {
    display: inline-block; outline: none; font: inherit; border: none; background: #FDE991; padding: 0;
}

button {
    color: #C7433E; cursor: pointer;
}

input {
    width: 50px;
}

#viewport {
    width: 800px; height: 800px;  margin: 100px auto 0; position: relative;
}



#viewport li {
    width: 420px; height: 420px; list-style: none; background: #fff; border-radius: 5px; position: absolute; top: 0; left: 0; box-shadow: 0 0 2px rgba(0,0,0,.2), 1px 1px 1px rgba(0,0,0,.2); line-height: 300px; text-align: center; font-size: 100px; border: 10px solid #ECECEC; box-sizing: border-box; cursor: default;
}

#viewport li.in-deck:nth-child(3) {
    top: 2px; transform: translate(2px, 2px) rotate(0.4deg);
}

#viewport li.in-deck:nth-child(2) {
    top: 4px; transform: translate(-4px, -2px) rotate(-1deg);
}

#control {
    position: absolute; bottom: 30px; left: 0; right: 0; text-align: center; font-size: 0;
}

#control button {
    background: #FFFFFF; color: #373737; font-weight: bold; border: none; font: normal 18px/24px 'Helvetica Neue', Helvetica, Arial, freesans, sans-serif; margin: 0 5px; padding: 10px 15px; cursor: pointer; box-shadow: 0 2px 0 #63211F; outline: none; position: relative;
}
#control button:active {
    background: #63211F; color: #FFFFFF; bottom: -2px; box-shadow: none;
}

#source {
    width: 500px; margin: 20px auto;
}

#source a {
    color: #C7433E;
}

</style>
@endpush
