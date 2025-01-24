import pulp

# Utworzenie problemu
problem = pulp.LpProblem("Wypelnianie_Tabeli", pulp.LpMinimize)

# Zmienne decyzyjne
x11 = pulp.LpVariable('x11', lowBound=1, upBound=12, cat='Integer')
x12 = pulp.LpVariable('x12', lowBound=1, upBound=12, cat='Integer')
x13 = pulp.LpVariable('x13', lowBound=1, upBound=12, cat='Integer')
x21 = pulp.LpVariable('x21', lowBound=1, upBound=12, cat='Integer')
x22 = pulp.LpVariable('x22', lowBound=1, upBound=12, cat='Integer')
x23 = pulp.LpVariable('x23', lowBound=1, upBound=12, cat='Integer')
x31 = pulp.LpVariable('x31', lowBound=1, upBound=12, cat='Integer')
x32 = pulp.LpVariable('x32', lowBound=1, upBound=12, cat='Integer')
x33 = pulp.LpVariable('x33', lowBound=1, upBound=12, cat='Integer')

# Funkcja celu
problem += 0

# Równania dla wierszy
problem += (x11 + 6 + x12 + x13 == 30)
problem += (8 + x21 + x22 + x23 == 18)
problem += (x31 + x32 + 3 + x33 == 30)

# Równania dla kolumn
problem += (x11 + 8 + x31 == 27)
problem += (6 + x21 + x32 == 16)
problem += (x12 + x22 + 3 == 10)
problem += (x13 + x23 + x33 == 25)

# Rozwiązanie problemu
problem.solve()

# Wypisanie wyników
result = {
    'x11': x11.varValue,
    'x12': x12.varValue,
    'x13': x13.varValue,
    'x21': x21.varValue,
    'x22': x22.varValue,
    'x23': x23.varValue,
    'x31': x31.varValue,
    'x32': x32.varValue,
    'x33': x33.varValue,
}

print(result)

# Output: {'x11': 7.0, 'x12': 6.0, 'x13': 11.0, 'x21': 1.0, 'x22': 1.0, 'x23': 8.0, 'x31': 12.0, 'x32': 9.0, 'x33': 6.0}
# Wynik jest poprawny, jednak zależy nam na unikalności liczb, więc musimy dodać dodatkowe ograniczenia.
# Zdefiniowanie ograniczeń typu "problem += (x11 != 3) & (x11 != 6) & (x11 != 8)" nic nie da, ponieważ początkowo są one wartościami "null". Dopiero przy solve() są przypisywane wartości.
# Dla unikalnych wartości, wariant wykonano w pliku zad10_metoda_unikalnych_liczb.py