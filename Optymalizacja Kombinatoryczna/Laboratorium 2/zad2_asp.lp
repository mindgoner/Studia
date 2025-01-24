% Definiujemy zawodnikow (argument 1) i ich punkty (argument 3) w danej dyscyplinie (argument 2):
zawodnik("Miroslaw", 1, 75). zawodnik("Miroslaw", 2, 25). zawodnik("Miroslaw", 3, 202). zawodnik("Miroslaw", 4, 130). zawodnik("Miroslaw", 5, 165).
zawodnik("Szymon", 1, 91). zawodnik("Szymon", 2, 20). zawodnik("Szymon", 3, 207). zawodnik("Szymon", 4, 122). zawodnik("Szymon", 5, 182).
zawodnik("Pawel", 1, 80). zawodnik("Pawel", 2, 28). zawodnik("Pawel", 3, 215). zawodnik("Pawel", 4, 125). zawodnik("Pawel", 5, 172).
zawodnik("Tomasz", 1, 78). zawodnik("Tomasz", 2, 22). zawodnik("Tomasz", 3, 197). zawodnik("Tomasz", 4, 125). zawodnik("Tomasz", 5, 180).
zawodnik("Mateusz", 1, 75). zawodnik("Mateusz", 2, 25). zawodnik("Mateusz", 3, 205). zawodnik("Mateusz", 4, 127). zawodnik("Mateusz", 5, 178).
zawodnik("Jacek", 1, 87). zawodnik("Jacek", 2, 24). zawodnik("Jacek", 3, 198). zawodnik("Jacek", 4, 127). zawodnik("Jacek", 5, 173).
zawodnik("Piotr", 1, 68). zawodnik("Piotr", 2, 19). zawodnik("Piotr", 3, 195). zawodnik("Piotr", 4, 121). zawodnik("Piotr", 5, 164).
zawodnik("Lukasz", 1, 81). zawodnik("Lukasz", 2, 23). zawodnik("Lukasz", 3, 211). zawodnik("Lukasz", 4, 131). zawodnik("Lukasz", 5, 165).

% Zakres dyscyplin
dyscyplina(1..5).

% Tylko jeden zawodnik dla kazdej dyscypliny:
1 { wybrany(Kandydat, D) : zawodnik(Kandydat, D, _) } 1 :- dyscyplina(D).

% Kandydat moze byc wybrany tylko raz
:- wybrany(Kandydat, D1), wybrany(Kandydat, D2), D1 != D2.

% Maksymalizujemy wynik zawodnikow:
#maximize { Wynik, Kandydat, D : wybrany(Kandydat, D), zawodnik(Kandydat, D, Wynik) }.

% Wyswietl najlepszy wybor (lub wybory)
#show wybrany/2.

% Wyniki zawarte w tym zrozwiazaniu znajduja sie rowniez jako wynik 
% w optymalnym rozwiazaniu w jezyku Python, co potwierdza ich poprawnosc
% Wspolne rozwiazanie zostalo zaznaczone na zrzutach ekranow z wynikami