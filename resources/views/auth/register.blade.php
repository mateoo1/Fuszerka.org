@extends('layouts.app')

@section('content')
<div class="container auth-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="terms" class="col-md-4 col-form-label text-md-right">Akceptuj?? regulamin</label>

                            <div class="col-md-6">
                                <input id="terms" type="checkbox" class="regular-checkbox @error('name') is-invalid @enderror" name="terms" value="{{ old('terms') }}" required autocomplete="terms" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="terms">

<div class="terms-header">
    <br>Witaj!
    <br>W serwisie Fuszerka.org ujawniamy niedbalstwo, oszustwa oraz brak kompetencji w r????nych dziedzinach ??ycia.
    <br>Zauwa??y??e?? fuszerk?? w pracy, w trakcie spaceru, gdziekolwiek? Zr??b zdj??cie!  
    <br>Zap??aci??e?? jak za renesansowe dzie??o sztuki a otrzyma??e?? fuszerk??? Poka?? nam! 
    <br>Oceniamy i komentujemy fuszerki, szukamy tej najwi??kszej i wymieniamy si?? do??wiadczeniami.
</div>

<textarea readonly class="termsarea ta-left" rows="60">
                R E G U L A M I N z dnia 1.11.2019 r.

POSTANOWIENIA OG??LNE
1)	Serwis Fuszerka.org jest darmow?? us??ug?? daj??c?? mo??liwo???? tworzenia w??asnych tre??ci jego u??ytkownikom.
2)	W serwisie Fuszerka.org nale??y publikowa?? zdj??cia wraz z opisem przedstawiaj??ce efekty pracy ludzkiej w r????nych bran??ach. Serwis zach??ca u??ytkownik??w to publikowania sytuacji zabawnych, irytuj??cych jak r??wnie?? niebezpiecznych oraz opisywania kontekstu ich powstania. Dla rozrywki i ku przestrodze.
3)	Tre??ci publikowane na stronach serwisu s?? w??asno??ci?? jego u??ytkownik??w. Nie mog?? by?? one powielane bez zgody autora tre??ci.
4)	Serwis nie ponosi odpowiedzialno??ci za tre??ci publikowane przez u??ytkownik??w oraz nie weryfikuje ich autentyczno??ci ani praw autorskich. 
5)	Wszelkie zastrze??enie nale??y zg??asza?? bezpo??rednio do autora publikowanej tre??ci przy u??yciu przycisku ???zg??o????? umieszczonego pod postem.
6)	U??ytkownik po zalogowaniu mo??e tworzy?? i dodawa?? swoje tre??ci (posty), kt??re po zweryfikowaniu i zaakceptowaniu przez administracj?? serwisu pojawi?? si?? na stronie g????wnej gdzie b??d?? widoczne dla wszystkich os??b odwiedzaj??cych serwis.
7)	Zabronione jest publikowanie:
        a.	zdj???? prezentuj??cych nago????, przemoc, tre??ci obra??aj??ce inne osoby lub grupy spo??eczne oraz promuj??ce inne tre??ci zakazane polskim prawem,
        b.	reklam bez wcze??niejszej zgody tw??rcy serwisu,
        c.	zdj???? przedstawiaj??cych  wizerunek drugiej osoby bez jej zgody,
        d.	danych osobowych swoich oraz innych os??b,
        e.	tre??ci zawieraj??cych wulgaryzmy (w jakiejkolwiek formie) lub maj??ce na celu obra??anie innych u??ytkownik??w serwisu.
8)	Podczas umieszczania zdj???? pochodz??cych z innych stron nale??y w opisie poda?? ??r??d??o pochodzenia materia??u.
9)	Administracja serwisu zastrzega sobie prawo do usuni??cia posta lub jego element??w w ka??dym czasie bez podania przyczyny.


LOGOWANIE I REJESTRACJA
10)	U??ytkownik mo??e w pe??ni korzysta?? z serwisu tj. dodawa?? i usuwa?? tre??ci, od chwili zarejestrowania si?? i jednoczesnego zapoznania z niniejszym regulaminem. U??ytkownik nie mo??e zarejestrowa?? si?? w serwisie bez akceptacji regulaminu.
11)	U??ytkownik mo??e posiada?? tylko jedno konto.
12)	U??ytkownik zobowi??zuje si?? do nie udost??pniania swojego konta innym u??ytkownikom ani osobom trzecim.
13)	U??ytkownik nie mo??e korzysta?? z kont innych u??ytkownik??w.
14)	Serwis zastrzega sobie mo??liwo???? zablokowania b??d?? usuni??cia konta U??ytkownika, kt??ry nie stosuje si?? do niniejszych postanowie??, podczas rejestracji poda?? niezgodne ze stanem faktycznym, post??puje w spos??b sprzeczny z powszechnie obowi??zuj??cymi przepisami polskiego prawa lub zasadami wsp??????ycia spo??ecznego lub dzia??a na szkod?? serwisu Fuszerka.org.


POLITYKA PRYWATNO??CI
15)	Adres mailowy podany przy rejestracji jest wykorzystywany tylko do:
        a.	weryfikacji konta, 
        b.	resetowania has??a 
        c.	umo??liwienia kontaktu administracji serwisu z autorem posta je??eli kto?? zg??osi do niego zastrze??enia.
16)	U??ytkownik mo??e za????da?? usuni??cia konta wraz z przypisanymi do niego danymi w ka??dej chwili. W celu usuni??cia konta nale??y wys??a?? pro??b?? na adres info@fuszerka.org z adresu, na kt??re zarejestrowane jest konto.
17)	W celu zmiany swoich danych nale??y post??pi?? tak jak w pkt. 16.
18)	Ka??dy post wraz z obrazem, opisem i komentarzami mo??e w ka??dej chwili zosta?? usuni??ty przez jego autora. Dane s?? bezpowrotnie usuwane z serwera.
19)	Serwis wykorzystuje cookies, w zakresie wymaganym przez technologi?? u??yt?? do jego stworzenia, w szczeg??lno??ci procesu autoryzacji. Za pomoc?? plik??w cookies nie s?? przetwarzane lub przechowywane dane osobowe.
20)	??adne dane wykorzystywane przez serwis nie s?? udost??pniane podmiotom trzecim.


POSTANOWIENIA KO??COWE
21)	Niniejszy Regulamin obowi??zuje od dnia 1.11.2019 r.
22)	Regulamin jest dost??pny dla U??ytkownik??w pod adresem internetowym fuszerka.org/register
23)	W??a??ciciel serwisu ma prawo do jednostronnej zmiany postanowie?? niniejszego Regulaminu bez podania przyczyny i w ka??dej chwili. Zmiany wchodz?? w ??ycie z chwil?? opublikowania.
24)	Prawem w??a??ciwym jest prawo polskie.
</textarea>

</div>


@endsection
