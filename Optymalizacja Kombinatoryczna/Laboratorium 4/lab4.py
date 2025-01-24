# Treść zadania:
# Trzema różnymi liczbami naturalnymi spełniającymi równanie 𝑥2 + 𝑦2 + 𝑧2 = 𝑥𝑦𝑧 są 𝑥 = 3, 𝑦 = 6, 𝑧 = 15. 
# Znajdź trzy inne takie liczby naturalne, gdzie 𝑥 < 𝑦 oraz 𝑦 < 𝑧.

from z3 import *

# Tworzymy zmienne
x = Int('x')
y = Int('y')
z = Int('z')

# Tworzymy solver i dodajemy warunki do solvera, zasadę że liczby naturalne są większe od 0 oraz równanie x^2 + y^2 + z^2 = xyz
solver = Solver()
solver.add(x < y)
solver.add(y < z)
solver.add(x > 0) 
solver.add(y > 0)
solver.add(z > 0)
solver.add(x**2 + y**2 + z**2 == x * y * z)

found_integers = 1
while(found_integers <= 2): # Szukamy dwóch rozwiązań
    if solver.check() == sat:
        model = solver.model()
        print(f'Znalezione liczby: x = {model[x]}, y = {model[y]}, z = {model[z]}')
        found_integers += 1
        solver.add(x != model[x])
        solver.add(y != model[y])
        solver.add(z != model[z])
    else:
        print("Nie znaleziono rozwiązania.")

# Wynik:
# Znalezione liczby: x = 3, y = 6, z = 15
# Znalezione liczby: x = 6, y = 15, z = 87
