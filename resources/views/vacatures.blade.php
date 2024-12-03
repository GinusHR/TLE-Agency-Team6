<x-main-body>
    <form action="{{route('vacatures.filter')}}" method="post">
        @csrf
        @method('PATCH')
        <div>
            <label for="search">Zoeken</label>
            <input type="text" name="search" id="search" value="{{old('search')}}">
        </div>

        <div>
            <label for=""></label>
            <select name="filter">
                <option value="" disabled selected></option>
                <option value="0">0-10</option>
                <option value="10">10-20</option>
                <option value="20">20-30</option>
                <option value="30">30-40</option>
                <option value="40">40+</option>
            </select>
        </div>

    </form>
       @foreach($vacatures as $vacature)
           <div>
               <div>
                   <h3>{{$vacature->company->name}}</h3>
                   <div>
                       <p>{{$vacature->function}}</p>
                       <p>€{{$vacature->salary}} per maand</p>
                       <img src="{{$vacature->image}}" alt="Bedrijfs foto">
                   </div>
                   <div>
                       <p>{{$vacature->workhours}} per week</p>
                       <p>{{$vacature->location}}</p>
                       <p>{{$vacature->description}}</p>
                       <p>
                           {{ $vacature->time_id ? 'Fulltime' : 'Parttime'}}
                       </p>
                   </div>
               </div>
               <button>Detail <a href="{{route('vacatures.show',$vacature->id)}}"></a></button>
           </div>
       @endforeach
</x-main-body>
