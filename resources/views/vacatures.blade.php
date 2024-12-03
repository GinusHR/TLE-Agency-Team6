<x-main-body>
    <form action="{{route('vacatures.filter')}}" method="post">
        @csrf
        @method('PATCH')
        <div>
            <label for="search">Zoeken</label>
            <input type="text" name="search" id="search" value="{{$previousSearch->search}}">
        </div>
        <div>
            <label for="uren">Uren</label>
            <select name="uren" id="uren">
                <option value="" disabled selected>Kies aantal uur</option>
                <option value="0" >0-10</option>
                <option value="10" >10-20</option>
                <option value="20" >20-30</option>
                <option value="30" >30-40</option>
                <option value="40" >40+</option>
            </select>
        </div>
        <div>
            <label for="salaris">Salaris</label>
            <select name="salaris" id="salaris">
                <option value="" disabled selected>Kies een salaris</option>
                <option value="1" >0-500 </option>
                <option value="2" >500-1000 </option>
                <option value="3" >1000-1500 </option>
                <option value="4" >1500-2000 </option>
                <option value="5" >2500-3000 </option>
                <option value="6" >2500-3000</option>
                <option value="7" >3000+</option>
            </select>
        </div>

        <div>
            <label for="sort">Sorteren</label>
            <select name="sort" id="sort">
                <option value="newest" {{ $previousSearch->sort === 'newest' ? 'selected' : '' }}>Meest recent</option>
                <option value="oldest" {{ $previousSearch->sort === 'oldest' ? 'selected' : '' }}>Minst recent</option>
                <option value="highest" {{ $previousSearch->sort === 'highest' ? 'selected' : '' }}>Salaris Hoogst-Minst</option>
                <option value="lowest" {{ $previousSearch->sort === 'lowest' ? 'selected' : '' }}>Salaris Minst-Hoogst</option>
            </select>
        </div>
        <div>
            <label for="demands">Eisen</label>
            <select name="demands[]" id="demands" multiple >
                <option disabled selected>Mogelijke eisen</option>
                @foreach($demands as $demand)
                <option value="{{$demand->name}}">{{$demand->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Zoeken</button>
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
