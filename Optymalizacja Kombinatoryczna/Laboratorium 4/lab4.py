from z3 import *

x = Int('x')
y = Int('y')
z = Int('z')

solver = Solver()
solver.add(x < y)
solver.add(y < z)
solver.add(x > 0) 
solver.add(y > 0)
solver.add(z > 0)
solver.add(x**2 + y**2 + z**2 == x * y * z)

found_integers = 1
while(found_integers <= 3): # szukamy 3 liczb, mozna wiecej
    if solver.check() == sat:
        model = solver.model()
        print(f'Znalezione liczby: x = {model[x]}, y = {model[y]}, z = {model[z]}')
        found_integers += 1
        solver.add(Not(And(x == model[x], y == model[y], z == model[z])))

    else:
        print("Nie znaleziono rozwiązania.")
