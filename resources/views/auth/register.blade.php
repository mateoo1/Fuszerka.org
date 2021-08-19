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
                            <label for="terms" class="col-md-4 col-form-label text-md-right">Akceptuję regulamin</label>

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
    <br>W serwisie Fuszerka.org ujawniamy niedbalstwo, oszustwa oraz brak kompetencji w różnych dziedzinach życia.
    <br>Zauważyłeś fuszerkę w pracy, w trakcie spaceru, gdziekolwiek? Zrób zdjęcie!  
    <br>Zapłaciłeś jak za renesansowe dzieło sztuki a otrzymałeś fuszerkę? Pokaż nam! 
    <br>Oceniamy i komentujemy fuszerki, szukamy tej największej i wymieniamy się doświadczeniami.
</div>

<textarea readonly class="termsarea ta-left" rows="60">
                R E G U L A M I N z dnia 1.11.2019 r.

POSTANOWIENIA OGÓLNE
1)	Serwis Fuszerka.org jest darmową usługą dającą możliwość tworzenia własnych treści jego użytkownikom.
2)	W serwisie Fuszerka.org należy publikować zdjęcia wraz z opisem przedstawiające efekty pracy ludzkiej w różnych branżach. Serwis zachęca użytkowników to publikowania sytuacji zabawnych, irytujących jak również niebezpiecznych oraz opisywania kontekstu ich powstania. Dla rozrywki i ku przestrodze.
3)	Treści publikowane na stronach serwisu są własnością jego użytkowników. Nie mogą być one powielane bez zgody autora treści.
4)	Serwis nie ponosi odpowiedzialności za treści publikowane przez użytkowników oraz nie weryfikuje ich autentyczności ani praw autorskich. 
5)	Wszelkie zastrzeżenie należy zgłaszać bezpośrednio do autora publikowanej treści przy użyciu przycisku „zgłoś” umieszczonego pod postem.
6)	Użytkownik po zalogowaniu może tworzyć i dodawać swoje treści (posty), które po zweryfikowaniu i zaakceptowaniu przez administrację serwisu pojawią się na stronie głównej gdzie będą widoczne dla wszystkich osób odwiedzających serwis.
7)	Zabronione jest publikowanie:
        a.	zdjęć prezentujących nagość, przemoc, treści obrażające inne osoby lub grupy społeczne oraz promujące inne treści zakazane polskim prawem,
        b.	reklam bez wcześniejszej zgody twórcy serwisu,
        c.	zdjęć przedstawiających  wizerunek drugiej osoby bez jej zgody,
        d.	danych osobowych swoich oraz innych osób,
        e.	treści zawierających wulgaryzmy (w jakiejkolwiek formie) lub mające na celu obrażanie innych użytkowników serwisu.
8)	Podczas umieszczania zdjęć pochodzących z innych stron należy w opisie podać źródło pochodzenia materiału.
9)	Administracja serwisu zastrzega sobie prawo do usunięcia posta lub jego elementów w każdym czasie bez podania przyczyny.


LOGOWANIE I REJESTRACJA
10)	Użytkownik może w pełni korzystać z serwisu tj. dodawać i usuwać treści, od chwili zarejestrowania się i jednoczesnego zapoznania z niniejszym regulaminem. Użytkownik nie może zarejestrować się w serwisie bez akceptacji regulaminu.
11)	Użytkownik może posiadać tylko jedno konto.
12)	Użytkownik zobowiązuje się do nie udostępniania swojego konta innym użytkownikom ani osobom trzecim.
13)	Użytkownik nie może korzystać z kont innych użytkowników.
14)	Serwis zastrzega sobie możliwość zablokowania bądź usunięcia konta Użytkownika, który nie stosuje się do niniejszych postanowień, podczas rejestracji podał niezgodne ze stanem faktycznym, postępuje w sposób sprzeczny z powszechnie obowiązującymi przepisami polskiego prawa lub zasadami współżycia społecznego lub działa na szkodę serwisu Fuszerka.org.


POLITYKA PRYWATNOŚCI
15)	Adres mailowy podany przy rejestracji jest wykorzystywany tylko do:
        a.	weryfikacji konta, 
        b.	resetowania hasła 
        c.	umożliwienia kontaktu administracji serwisu z autorem posta jeżeli ktoś zgłosi do niego zastrzeżenia.
16)	Użytkownik może zażądać usunięcia konta wraz z przypisanymi do niego danymi w każdej chwili. W celu usunięcia konta należy wysłać prośbę na adres info@fuszerka.org z adresu, na które zarejestrowane jest konto.
17)	W celu zmiany swoich danych należy postąpić tak jak w pkt. 16.
18)	Każdy post wraz z obrazem, opisem i komentarzami może w każdej chwili zostać usunięty przez jego autora. Dane są bezpowrotnie usuwane z serwera.
19)	Serwis wykorzystuje cookies, w zakresie wymaganym przez technologię użytą do jego stworzenia, w szczególności procesu autoryzacji. Za pomocą plików cookies nie są przetwarzane lub przechowywane dane osobowe.
20)	Żadne dane wykorzystywane przez serwis nie są udostępniane podmiotom trzecim.


POSTANOWIENIA KOŃCOWE
21)	Niniejszy Regulamin obowiązuje od dnia 1.11.2019 r.
22)	Regulamin jest dostępny dla Użytkowników pod adresem internetowym fuszerka.org/register
23)	Właściciel serwisu ma prawo do jednostronnej zmiany postanowień niniejszego Regulaminu bez podania przyczyny i w każdej chwili. Zmiany wchodzą w życie z chwilą opublikowania.
24)	Prawem właściwym jest prawo polskie.
</textarea>

</div>


@endsection
