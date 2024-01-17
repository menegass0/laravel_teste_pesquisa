<form action="">
    <select name="marca" id="">
        <option disabled selected value> -- select an option -- </option>
        @foreach ($marcas as $marca)
            <option value="{{$marca->id_marca}}">{{$marca->nm_marca}}</option>
        @endforeach
    </select>
</form>

@foreach ($posts as $post)
    <div class="post" style="border: 1px solid black; padding: 8px 10px 20px 10px ">
        <h3>{{$post->user->name}}</h3><br><hr>
        {{$post->ds_post}}<br><hr>
        {{$post->marca->nm_marca}}
    </div>
@endforeach