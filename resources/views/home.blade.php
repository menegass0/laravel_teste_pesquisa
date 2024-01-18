<form action="{{route('index')}}">
    @csrf
    <select name="marca" id="">
        <option selected value> -- select an option -- </option>
        @foreach ($marcas as $marca)
            <option value="{{$marca->id_marca}}">{{$marca->nm_marca}}</option>
        @endforeach
    </select>
    <select name="user" id="">
        <option selected value> -- select an option -- </option>
        @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
    <input type="text" name="content" placeholder="conteudo">
    <button type="submit">pesquisar</button>
</form>

@foreach ($posts as $post)
    <div class="post" style="border: 1px solid black; padding: 8px 10px 20px 10px ">
        <h3>{{$post->user->name}}</h3><br><hr>
        {{$post->ds_post}}<br><hr>
        {{$post->marca->nm_marca}}
    </div>
@endforeach