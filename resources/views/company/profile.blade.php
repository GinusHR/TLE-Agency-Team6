<a href="{{route('company.dashboard') }}">Terug</a>
<h1>Profiel Beheren</h1>
<form method="POST" action="{{ route('company.updateProfile') }}">
    @csrf
    <div>
        <label for="name">Bedrijfsnaam:</label>
        <input type="text" name="name" value="{{ $company->name }}">
    </div>

    <div>
        <label for="homepage_url">Website url:</label>
        <input type="url" name="homepage_url" value="{{ $company->homepage_url }}">
    </div>

    <div>
        <label for="about_url">Over ons url:</label>
        <input type="url" name="about_us_url" id="about_us_url" value="{{ $company->about_us_url }}">
    </div>

    <div>
        <label for="contact_url">Contact url:</label>
        <input type="url" name="contact_url" id="contact_url" value="{{ $company->contact_url }}">
    </div>

    <div>
        <label for="description">Beschrijving:</label>
        <textarea type="text" cols="35" rows="13" id="description" name="description">{{ $company->description }} </textarea>
    </div>

    <div>
        <label for="image">Bedrijfs foto:</label>
        <input type="file" name="image" id="image" src="{{$company->image}}">
    </div>

    <div>
        <label for="logo">Bedrijfs logo:</label>
        <input type="file" name="logo" id="logo" value="{{$company->logo}}">
    </div>

    <div>
        <button type="submit">Opslaan</button>
    </div>

</form>
